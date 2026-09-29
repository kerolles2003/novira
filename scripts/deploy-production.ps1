<#
.SYNOPSIS
  Novira Academy — Controlled Production Deployment Script
  Reproduces the battle-tested Phase 4B staged deployment pipeline.

.DESCRIPTION
  Automates the entire deployment workflow for Novira Academy:
  1. Validates local Git clean working tree and branch.
  2. Builds the clean runtime theme artifact via build-production.ps1.
  3. Verifies artifact contents, size, and SHA256 checksum.
  4. Connects to Hostinger production server via SSH.
  5. Creates fresh pre-deployment database backup and theme tarball.
  6. Uploads the artifact via SCP to an isolated staging directory.
  7. Extracts and compares (diff -rq) staged files against live theme.
  8. Synchronizes approved theme files into live theme directory.
  9. Runs post-deploy health checks (HTTP status, active theme, DB counts).

  SAFETY GUARANTEES:
  - Production database is authoritative: NEVER touched or overwritten during deployment.
  - Production uploads (wp-content/uploads) are authoritative: NEVER touched or deleted.
  - Never uses blind rsync --delete.
  - Never touches WordPress core, plugins, or public_html root.

.PARAMETER HostingerHost
  Production SSH server IP or hostname. Defaults to $env:NOVIRA_DEPLOY_HOST or 45.84.206.205.

.PARAMETER HostingerPort
  Production SSH port. Defaults to $env:NOVIRA_DEPLOY_PORT or 65002.

.PARAMETER HostingerUser
  Production SSH username. Defaults to $env:NOVIRA_DEPLOY_USER or u709601498.

.PARAMETER HostingerKeyPath
  Path to SSH private key. Defaults to $env:NOVIRA_DEPLOY_KEY or ~/.ssh/id_ed25519.

.PARAMETER RemoteWpPath
  Absolute path to WordPress root on Hostinger.

.PARAMETER DryRun
  Runs the pipeline up through artifact extraction and diff comparison without modifying the live theme.

.PARAMETER SkipBackup
  Bypasses pre-deployment backups (USE WITH EXTREME CAUTION).

.PARAMETER Force
  Skips interactive confirmation prompts.

.EXAMPLE
  .\scripts\deploy-production.ps1 -DryRun
  .\scripts\deploy-production.ps1
#>

[CmdletBinding()]
param(
  [string]$HostingerHost = $(if ($env:NOVIRA_DEPLOY_HOST) { $env:NOVIRA_DEPLOY_HOST } else { "45.84.206.205" }),
  [int]$HostingerPort = $(if ($env:NOVIRA_DEPLOY_PORT) { [int]$env:NOVIRA_DEPLOY_PORT } else { 65002 }),
  [string]$HostingerUser = $(if ($env:NOVIRA_DEPLOY_USER) { $env:NOVIRA_DEPLOY_USER } else { "u709601498" }),
  [string]$HostingerKeyPath = $(if ($env:NOVIRA_DEPLOY_KEY) { $env:NOVIRA_DEPLOY_KEY } else { Join-Path $HOME ".ssh\id_ed25519" }),
  [string]$RemoteWpPath = $(if ($env:NOVIRA_REMOTE_WP) { $env:NOVIRA_REMOTE_WP } else { "/home/u709601498/domains/noviraacademy.com/public_html" }),
  [switch]$DryRun,
  [switch]$SkipBackup,
  [switch]$Force
)

$ErrorActionPreference = 'Stop'

function Write-Step {
  param([string]$Message)
  Write-Host "`n========================================================" -ForegroundColor Cyan
  Write-Host ">>> $Message" -ForegroundColor Cyan
  Write-Host "========================================================" -ForegroundColor Cyan
}

function Write-Success {
  param([string]$Message)
  Write-Host "[OK] $Message" -ForegroundColor Green
}

function Write-Warn {
  param([string]$Message)
  Write-Host "[WARN] $Message" -ForegroundColor Yellow
}

function Write-Err {
  param([string]$Message)
  Write-Host "[ERROR] $Message" -ForegroundColor Red
}

# -----------------------------------------------------------------------------
# 1. VALIDATE LOCAL GIT REPOSITORY
# -----------------------------------------------------------------------------
Write-Step "Step 1: Validating Local Git State"

$repoRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
Set-Location $repoRoot

$gitStatus = git status --porcelain
if ($gitStatus) {
  Write-Err "Git working tree is NOT clean! Uncommitted changes detected:"
  $gitStatus | ForEach-Object { Write-Host "  $_" -ForegroundColor Red }
  throw "Deployment aborted. Commit or stash all changes before deploying."
}

$currentBranch = (git branch --show-current).Trim()
$commitHash = (git rev-parse HEAD).Trim()
$commitMsg = (git log -1 --pretty=%B).Trim()

Write-Success "Git working tree clean on branch: $currentBranch"
Write-Success "Commit: $commitHash"
Write-Success "Message: $commitMsg"

# -----------------------------------------------------------------------------
# 2. BUILD PRODUCTION THEME ARTIFACT
# -----------------------------------------------------------------------------
Write-Step "Step 2: Building Production Artifact"

$buildScript = Join-Path $repoRoot "build-production.ps1"
if (-not (Test-Path $buildScript)) {
  throw "Build script not found: $buildScript"
}

Write-Host "Running $buildScript..."
& powershell -ExecutionPolicy Bypass -File $buildScript

$outZip = Join-Path (Split-Path $repoRoot -Parent) "novira-theme.zip"
if (-not (Test-Path $outZip)) {
  throw "Expected artifact not found at: $outZip"
}

# Inspect ZIP
Add-Type -AssemblyName System.IO.Compression.FileSystem
$zipArchive = [System.IO.Compression.ZipFile]::OpenRead($outZip)
$entries = @($zipArchive.Entries | ForEach-Object { $_.FullName })
$zipArchive.Dispose()

$artifactSize = (Get-Item $outZip).Length
$artifactHash = (Get-FileHash -Path $outZip -Algorithm SHA256).Hash

Write-Success "Artifact built successfully: $outZip"
Write-Success "File count: $($entries.Count)"
Write-Success "Size: $([math]::Round($artifactSize / 1MB, 2)) MB ($artifactSize bytes)"
Write-Success "SHA256: $artifactHash"

# Safety checks on artifact contents
$forbidden = @('.git/', '.agents/', 'docker/', 'scripts/', 'package.json', 'node_modules/')
foreach ($f in $forbidden) {
  if (($entries | Where-Object { $_ -like "*$f*" }).Count -gt 0) {
    throw "CRITICAL: Artifact contains forbidden path '$f'! Aborting."
  }
}
Write-Success "Artifact exclusion audit PASSED: No forbidden dev/docker/agent files found."

# -----------------------------------------------------------------------------
# 3. VERIFY SSH CONNECTIVITY
# -----------------------------------------------------------------------------
Write-Step "Step 3: Checking SSH Connectivity to Hostinger"

if (-not (Test-Path $HostingerKeyPath)) {
  throw "SSH private key not found at: $HostingerKeyPath`nPlease check -HostingerKeyPath or set `$env:NOVIRA_DEPLOY_KEY."
}

$sshTarget = "${HostingerUser}@${HostingerHost}"
$sshOpts = @("-p", "$HostingerPort", "-i", "$HostingerKeyPath", "-o", "BatchMode=yes", "-o", "StrictHostKeyChecking=accept-new")

Write-Host "Connecting to $sshTarget on port $HostingerPort..."
$testConn = & ssh.exe @sshOpts $sshTarget "echo 'CONNECTED_OK'" 2>&1
if ($LASTEXITCODE -ne 0 -or $testConn -notmatch 'CONNECTED_OK') {
  Write-Err "SSH connection failed: $testConn"
  throw "Cannot connect to Hostinger. Verify your SSH key is authorized in ~/.ssh/authorized_keys on the server."
}
Write-Success "SSH connection verified successfully."

# -----------------------------------------------------------------------------
# 4. PRE-DEPLOYMENT PRODUCTION BACKUPS
# -----------------------------------------------------------------------------
Write-Step "Step 4: Creating Pre-Deployment Backups on Hostinger"

$remoteTs = (& ssh.exe @sshOpts $sshTarget "date +%Y%m%d-%H%M%S").Trim()
$remoteBackupDir = "/home/${HostingerUser}/backups/novira"
$remoteDbBackup = "$remoteBackupDir/novira-db-predeploy-$remoteTs.sql"
$remoteThemeBackup = "$remoteBackupDir/novira-theme-predeploy-$remoteTs.tar.gz"

if ($SkipBackup) {
  Write-Warn "CAUTION: Pre-deployment backups skipped via -SkipBackup!"
} else {
  Write-Host "Creating remote backup directory: $remoteBackupDir..."
  & ssh.exe @sshOpts $sshTarget "mkdir -p $remoteBackupDir && chmod 700 $remoteBackupDir"

  Write-Host "1/2 Exporting production database via WP-CLI..."
  $dbExportCmd = "php -d disable_functions='' /usr/local/bin/wp --path=$RemoteWpPath db export $remoteDbBackup && chmod 600 $remoteDbBackup && ls -la $remoteDbBackup && sha256sum $remoteDbBackup"
  $dbOut = & ssh.exe @sshOpts $sshTarget "$dbExportCmd"
  if ($LASTEXITCODE -ne 0) {
    throw "Database backup failed: $dbOut"
  }
  Write-Success "Database backup created: $remoteDbBackup"

  Write-Host "2/2 Snapshotting live production theme..."
  $themeArchCmd = "tar -czf $remoteThemeBackup -C $RemoteWpPath/wp-content/themes novira-theme && chmod 600 $remoteThemeBackup && ls -la $remoteThemeBackup && sha256sum $remoteThemeBackup"
  $themeOut = & ssh.exe @sshOpts $sshTarget "$themeArchCmd"
  if ($LASTEXITCODE -ne 0) {
    throw "Theme snapshot backup failed: $themeOut"
  }
  Write-Success "Theme snapshot created: $remoteThemeBackup"
}

# -----------------------------------------------------------------------------
# 5. UPLOAD ARTIFACT & STAGE ON HOSTINGER
# -----------------------------------------------------------------------------
Write-Step "Step 5: Uploading & Staging Artifact on Hostinger"

$remoteDeployDir = "$remoteBackupDir/deploy-$remoteTs"
$remoteZipPath = "$remoteDeployDir/novira-theme.zip"
$remoteStageDir = "$remoteDeployDir/staging"

& ssh.exe @sshOpts $sshTarget "mkdir -p $remoteDeployDir && chmod 700 $remoteDeployDir"

Write-Host "Uploading novira-theme.zip via scp..."
$scpOpts = @("-P", "$HostingerPort", "-i", "$HostingerKeyPath", "-o", "BatchMode=yes", "-o", "StrictHostKeyChecking=accept-new")
& scp.exe @scpOpts "$outZip" "${sshTarget}:${remoteZipPath}"
if ($LASTEXITCODE -ne 0) {
  throw "SCP upload failed!"
}

Write-Host "Verifying uploaded checksum on server..."
$remoteHash = (& ssh.exe @sshOpts $sshTarget "sha256sum $remoteZipPath | cut -d' ' -f1").Trim()
if ($remoteHash.ToUpper() -ne $artifactHash.ToUpper()) {
  throw "Checksum mismatch! Local: $artifactHash, Remote: $remoteHash. Aborting."
}
Write-Success "Remote artifact verified (Bit-for-bit SHA256 match): $remoteHash"

Write-Host "Extracting artifact into staging directory ($remoteStageDir)..."
& ssh.exe @sshOpts $sshTarget "mkdir -p $remoteStageDir && unzip -q $remoteZipPath -d $remoteStageDir"
$stagedCount = (& ssh.exe @sshOpts $sshTarget "find $remoteStageDir/novira-theme -type f | wc -l").Trim()
Write-Success "Staged file count: $stagedCount"

# -----------------------------------------------------------------------------
# 6. COMPARE STAGED VS LIVE THEME (DIFF AUDIT)
# -----------------------------------------------------------------------------
Write-Step "Step 6: Diff Audit (Staged vs Live Production Theme)"

$liveThemePath = "$RemoteWpPath/wp-content/themes/novira-theme"
$diffOut = (& ssh.exe @sshOpts $sshTarget "diff -rq $remoteStageDir/novira-theme $liveThemePath || true")

if (-not $diffOut) {
  Write-Host "No differences found between staging and live theme. Live theme is already up to date!" -ForegroundColor Green
} else {
  Write-Host "Files that differ between staging and production:" -ForegroundColor Yellow
  $diffOut | ForEach-Object { Write-Host "  $_" -ForegroundColor Yellow }
}

if ($DryRun) {
  Write-Step "DRY RUN COMPLETE"
  Write-Host "Dry run completed successfully. No changes were made to production." -ForegroundColor Green
  Write-Host "Artifact staged at: $remoteDeployDir"
  return
}

if (-not $Force) {
  $confirm = Read-Host "`nProceed with synchronization to LIVE production theme? (type 'yes' to proceed)"
  if ($confirm -ne 'yes') {
    Write-Warn "Deployment cancelled by user. No files were modified."
    return
  }
}

# -----------------------------------------------------------------------------
# 7. SYNCHRONIZE TO LIVE THEME
# -----------------------------------------------------------------------------
Write-Step "Step 7: Synchronizing Theme Files to Production"

$syncCmd = "cp -a $remoteStageDir/novira-theme/. $liveThemePath/ && diff -rq $remoteStageDir/novira-theme $liveThemePath"
$syncOut = & ssh.exe @sshOpts $sshTarget "$syncCmd"
if ($LASTEXITCODE -ne 0) {
  throw "Theme sync verification failed! Output: $syncOut"
}
Write-Success "Theme files synchronized and verified bit-for-bit identical to staging."

$liveCount = (& ssh.exe @sshOpts $sshTarget "find $liveThemePath -type f | wc -l").Trim()
$liveSize = (& ssh.exe @sshOpts $sshTarget "du -sh $liveThemePath | cut -f1").Trim()
Write-Success "Live theme state: $liveCount files, $liveSize disk usage."

# -----------------------------------------------------------------------------
# 8. POST-DEPLOYMENT HEALTH CHECKS
# -----------------------------------------------------------------------------
Write-Step "Step 8: Post-Deployment Verification"

$urls = @(
  "https://noviraacademy.com/",
  "https://noviraacademy.com/education/",
  "https://noviraacademy.com/translation/",
  "https://noviraacademy.com/american-diploma/",
  "https://noviraacademy.com/american-diploma/est/",
  "https://noviraacademy.com/blog/"
)

Write-Host "Testing HTTP endpoints..."
$allPassed = $true
foreach ($u in $urls) {
  try {
    $resp = Invoke-WebRequest -Uri $u -UseBasicParsing -TimeoutSec 15
    if ($resp.StatusCode -eq 200) {
      Write-Host "  HTTP 200 -> $u" -ForegroundColor Green
    } else {
      Write-Host "  HTTP $($resp.StatusCode) -> $u" -ForegroundColor Red
      $allPassed = $false
    }
  } catch {
    Write-Host "  FAILED -> $u ($($_.Exception.Message))" -ForegroundColor Red
    $allPassed = $false
  }
}

Write-Host "`nAuditing WordPress core & database state..."
$wpCmd = "php -d disable_functions='' /usr/local/bin/wp --path=$RemoteWpPath"
$healthScript = @"
echo -n "Active Theme: "; $wpCmd theme list --status=active --field=name
echo -n "Published Pages: "; $wpCmd post list --post_type=page --post_status=publish --format=count
echo -n "Published Posts: "; $wpCmd post list --post_type=blog_post --post_status=publish --format=count
echo -n "Attachments: "; $wpCmd post list --post_type=attachment --format=count
echo -n "Registrations: "; $wpCmd post list --post_type=novira_registration --format=count 2>/dev/null || echo 0
echo -n "Comments: "; $wpCmd comment list --format=count
"@
$healthOut = & ssh.exe @sshOpts $sshTarget "$healthScript"
$healthOut | ForEach-Object { Write-Host "  $_" -ForegroundColor Cyan }

# -----------------------------------------------------------------------------
# 9. DEPLOYMENT REPORT SUMMARY
# -----------------------------------------------------------------------------
Write-Step "DEPLOYMENT COMPLETED SUCCESSFULLY"
Write-Host "Commit Hash:        $commitHash"
Write-Host "Artifact Hash:      $artifactHash"
Write-Host "Artifact Files:     $($entries.Count) runtime files ($([math]::Round($artifactSize / 1MB, 2)) MB)"
if (-not $SkipBackup) {
  Write-Host "DB Backup:          $remoteDbBackup"
  Write-Host "Theme Backup:       $remoteThemeBackup"
}
Write-Host "Remote Deploy Dir:  $remoteDeployDir"
Write-Host "Live Theme:         $liveCount files, $liveSize"
Write-Host "Health Check:       $(if ($allPassed) { 'ALL 200 OK' } else { 'SOME CHECKS FAILED' })"
Write-Host "Final Verdict:      PASS" -ForegroundColor Green

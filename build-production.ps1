<#
.SYNOPSIS
  Build a clean production theme zip for Hostinger deployment.

.DESCRIPTION
  Stages only the files WordPress needs at runtime — excluding dev tooling,
  design sources (PNG mockups), build scripts, internal docs, node_modules,
  the inert bundled plugin, and the CLI language scripts — then zips them.
  Output: ..\novira-theme.zip

.EXAMPLE
  powershell -ExecutionPolicy Bypass -File build-production.ps1
#>

$ErrorActionPreference = 'Stop'
$ThemeSlug = 'novira-theme'
$Src       = $PSScriptRoot
$Parent    = Split-Path $Src -Parent
$Stage     = Join-Path $Parent ".novira-build\$ThemeSlug"
$OutZip    = Join-Path $Parent "$ThemeSlug.zip"

Write-Host "Staging clean theme from: $Src"
if (Test-Path (Split-Path $Stage -Parent)) { Remove-Item (Split-Path $Stage -Parent) -Recurse -Force }
New-Item -ItemType Directory -Path $Stage -Force | Out-Null

# Directories that must never ship.
$excludeDirs = @('.git','.agents','.claude','.opencode','.specify','specs','docs','scripts','docker','node_modules','plugins','.novira-build')
# Files that must never ship (wildcards allowed).
$excludeFiles = @(
  '.gitignore',
  '*.png','*.html','stitch-contact*','extract-images.js','fix-animated-js.js',
  'make-placeholders.js','rewrite-*.js','tailwind.config.js','tailwind-source.css',
  'package.json','package-lock.json','docker-compose.yml','skills-lock.json',
  'AGENTS.md','DESIGN.md','PRODUCT.md','t.md','README.md','*.txt','build-production.sh',
  'build-production.ps1','*.bak','*.old','*.orig','.DS_Store','Thumbs.db'
)
# Verified-dead assets removed by EXACT path after staging (a bare filename in
# robocopy /XF also matches substrings, e.g. 'homepage.css' -> stitch-homepage.css).
$deadExact = @(
  'assets\css\homepage.css','assets\css\animated-results.css',
  'assets\js\animated-results.js','assets\css\rtl.css'
)

# robocopy mirrors the tree honouring exclusions. /XD dirs, /XF files.
# Exit codes 0-7 are success for robocopy; anything >=8 is a real error.
$rc = Start-Process robocopy -ArgumentList (@("`"$Src`"","`"$Stage`"",'/E','/NFL','/NDL','/NJH','/NJS','/NP','/XD') + $excludeDirs + @('/XF') + $excludeFiles) -Wait -PassThru -NoNewWindow
if ($rc.ExitCode -ge 8) { throw "robocopy failed with code $($rc.ExitCode)" }

# Restore required WP metadata + the raster assets the *.png sweep removed but
# the site actually references (education hero + logo variants + runtime favicons).
Copy-Item (Join-Path $Src 'readme.txt') (Join-Path $Stage 'readme.txt') -Force -ErrorAction SilentlyContinue
# hero.png was replaced by hero.jpg / hero@2x.jpg (which ship automatically —
# they aren't .png). logo_horizontal.png is kept only as a legacy fallback;
# the site now references logo_horizontal.webp.
foreach ($keep in @(
  'assets\images\logo.jpg',
  'assets\images\logo_horizontal.webp',
  'assets\images\favicon\apple-touch-icon.png',
  'assets\images\favicon\favicon-16x16.png',
  'assets\images\favicon\favicon-32x32.png',
  'assets\images\favicon\favicon-48x48.png',
  'assets\images\favicon\icon-192.png',
  'assets\images\favicon\icon-512.png'
)) {
  $from = Join-Path $Src $keep
  if (Test-Path $from) {
    $to = Join-Path $Stage $keep
    New-Item -ItemType Directory -Path (Split-Path $to -Parent) -Force | Out-Null
    Copy-Item $from $to -Force
  }
}
# Language build scripts are CLI-only; drop them from the artifact (belt and
# braces on top of their PHP_SAPI guards). Keep the .mo/.po runtime files.
Get-ChildItem (Join-Path $Stage 'languages') -Filter '*.php' -ErrorAction SilentlyContinue | Remove-Item -Force
Get-ChildItem (Join-Path $Stage 'languages') -Filter '*.pot' -ErrorAction SilentlyContinue | Remove-Item -Force
# Stray design PNGs under template-parts.
Remove-Item (Join-Path $Stage 'template-parts\sections\about-us.png') -Force -ErrorAction SilentlyContinue
Remove-Item (Join-Path $Stage 'template-parts\sections\contact.png') -Force -ErrorAction SilentlyContinue
# Verified-dead assets, removed by exact path.
foreach ($d in $deadExact) { Remove-Item (Join-Path $Stage $d) -Force -ErrorAction SilentlyContinue }

Write-Host "Zipping -> $OutZip"
if (Test-Path $OutZip) { Remove-Item $OutZip -Force }

# Build the zip manually so entry paths use forward slashes (the ZIP spec
# separator). Compress-Archive on Windows PowerShell 5.1 writes backslashes,
# which strict Linux unzip tools (as on Hostinger) extract as flat files.
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem
$stageRoot = Split-Path $Stage -Parent
$zip = [System.IO.Compression.ZipFile]::Open($OutZip, [System.IO.Compression.ZipArchiveMode]::Create)
try {
  Get-ChildItem $Stage -Recurse -File | ForEach-Object {
    $rel = $_.FullName.Substring($stageRoot.Length + 1) -replace '\\','/'
    [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $_.FullName, $rel, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
  }
} finally {
  $zip.Dispose()
}
Remove-Item $stageRoot -Recurse -Force

$sizeMB = [math]::Round((Get-Item $OutZip).Length / 1MB, 2)
Write-Host "Done. Production theme: $OutZip ($sizeMB MB)"

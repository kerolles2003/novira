# Novira Academy — Production Deployment & Rollback Guide

This document outlines the standard production deployment workflow, safety invariants, and rollback procedures for the Novira Academy WordPress theme hosted on Hostinger.

---

## 1. Core Principles & Safety Invariants

Before any deployment, remember the five immutable rules:

1. **Production Database is Authoritative:**
   * Never overwrite, import, or restore a local database over the production database.
   * Never run `wp db import` or database migrations during theme deployments.
   * Real student registrations, quotes, and customer inquiries live in the production database.

2. **Production Uploads are Authoritative:**
   * `wp-content/uploads/` belongs to the client and live website.
   * Never overwrite, sync local uploads, or delete files from `wp-content/uploads/`.

3. **Theme Code Only:**
   * The scope of deployment is strictly:
     `/home/u709601498/domains/noviraacademy.com/public_html/wp-content/themes/novira-theme/`
   * Never modify WordPress core files, `wp-config.php`, `wp-content/plugins/`, `wp-content/mu-plugins/`, or `object-cache.php`.

4. **Never Use Blind `rsync --delete`:**
   * All deployments use staged artifact extraction and verified replacement (`cp -a`).

5. **Always Create Pre-Deployment Backups:**
   * An automated database dump and theme snapshot must be taken immediately before modifying any live file.

---

## 2. Automated Deployment Pipeline

The repository includes a dedicated, battle-tested deployment script:
`scripts/deploy-production.ps1`

### Prerequisites
1. **PowerShell 5.1+ or PowerShell 7+** (on Windows).
2. **OpenSSH client** (`ssh.exe` and `scp.exe` installed and in your PATH).
3. **Authorized SSH Key:**
   * Your public key (`~/.ssh/id_ed25519.pub`) must be added to `/home/u709601498/.ssh/authorized_keys` on Hostinger.
   * Test connection:
     ```bash
     ssh -p 65002 u709601498@45.84.206.205 "echo 'Connected successfully'"
     ```

### Standard Deployment Procedure

1. **Verify your local Git working tree is clean:**
   ```powershell
   git status --short
   git log -1 --oneline
   ```

2. **Execute a Dry-Run (Recommended first):**
   ```powershell
   .\scripts\deploy-production.ps1 -DryRun
   ```
   This will build the artifact, upload it to the remote staging directory, extract it, and output the exact list of files that differ between staging and production without modifying the live theme.

3. **Execute Live Deployment:**
   ```powershell
   .\scripts\deploy-production.ps1
   ```
   The script will:
   * Build `novira-theme.zip` (247 runtime files, ~2.5 MB).
   * Verify SHA256 checksum and asset exclusions.
   * Connect to Hostinger via SSH.
   * Create a timestamped SQL backup in `~/backups/novira/novira-db-predeploy-<timestamp>.sql`.
   * Create a timestamped theme archive in `~/backups/novira/novira-theme-predeploy-<timestamp>.tar.gz`.
   * Upload and verify the artifact on the server.
   * Extract into `~/backups/novira/deploy-<timestamp>/staging`.
   * Display the `diff` and prompt for confirmation (`type 'yes' to proceed`).
   * Synchronize files into the live theme.
   * Run automated post-deploy health checks (verifying HTTP 200 on key landing pages, active theme, and database counts).

---

## 3. Configuration Parameters & Environment Variables

`scripts/deploy-production.ps1` supports parameters and environment variables:

| Parameter | Environment Variable | Default Value | Description |
| :--- | :--- | :--- | :--- |
| `-HostingerHost` | `NOVIRA_DEPLOY_HOST` | `45.84.206.205` | Hostinger server IP or hostname |
| `-HostingerPort` | `NOVIRA_DEPLOY_PORT` | `65002` | SSH port |
| `-HostingerUser` | `NOVIRA_DEPLOY_USER` | `u709601498` | Hostinger SSH username |
| `-HostingerKeyPath` | `NOVIRA_DEPLOY_KEY` | `~/.ssh/id_ed25519` | Path to private SSH key |
| `-RemoteWpPath` | `NOVIRA_REMOTE_WP` | `/home/u709601498/.../public_html` | WordPress web root |
| `-DryRun` | — | `false` | Audit differences without syncing |
| `-Force` | — | `false` | Skip interactive prompt |

Example using custom key path:
```powershell
.\scripts\deploy-production.ps1 -HostingerKeyPath "C:\Keys\my_key"
```

---

## 4. Manual Fallback Deployment (Emergency Procedure)

If SSH access is temporarily unavailable, you can deploy manually through the WordPress Admin:

1. **Build the production artifact locally:**
   ```powershell
   powershell -ExecutionPolicy Bypass -File build-production.ps1
   ```
   This generates `..\novira-theme.zip` in the parent directory.

2. **Log into WordPress Admin:**
   Navigate to `https://noviraacademy.com/wp-admin`

3. **Navigate to Appearance → Themes:**
   * Click **Add New Theme** → **Upload Theme**.
   * Choose `novira-theme.zip`.
   * Click **Install Now**.
   * When prompted that the destination folder already exists, select **Replace active with uploaded**.

4. **Verify Live Site:**
   * Check `/american-diploma/`, `/education/`, `/translation/`, and home page.
   * Check browser console for errors.

---

## 5. Rollback Procedures

If an unexpected regression occurs in production, rollback is immediate and deterministic.

Every deployment creates immutable pre-deploy backups on Hostinger under:
`/home/u709601498/backups/novira/`

### A. Theme Rollback (Restore previous theme files)
1. SSH into the server:
   ```bash
   ssh -p 65002 u709601498@45.84.206.205
   ```
2. Locate the pre-deployment theme snapshot:
   ```bash
   ls -la ~/backups/novira/novira-theme-predeploy-*.tar.gz
   ```
3. Extract the snapshot directly back into the themes directory:
   ```bash
   tar -xzf ~/backups/novira/novira-theme-predeploy-<TIMESTAMP>.tar.gz -C /home/u709601498/domains/noviraacademy.com/public_html/wp-content/themes/
   ```
4. Verify file count and size:
   ```bash
   find /home/u709601498/domains/noviraacademy.com/public_html/wp-content/themes/novira-theme -type f | wc -l
   ```

### B. Database Rollback (Emergency Only)
> [!CAUTION]
> Restoring a database backup will revert any student registrations or form submissions submitted since the backup timestamp. Only execute if database corruption occurred.

1. SSH into the server:
   ```bash
   ssh -p 65002 u709601498@45.84.206.205
   ```
2. Run WP-CLI to import the pre-deployment database dump:
   ```bash
   php -d disable_functions='' /usr/local/bin/wp --path=/home/u709601498/domains/noviraacademy.com/public_html db import /home/u709601498/backups/novira/novira-db-predeploy-<TIMESTAMP>.sql
   ```

---

## 6. Post-Deployment Verification Checklist

After every production update, verify:
- [ ] `https://noviraacademy.com/` returns HTTP 200.
- [ ] `https://noviraacademy.com/american-diploma/` returns HTTP 200 and loads study materials.
- [ ] `https://noviraacademy.com/education/` returns HTTP 200.
- [ ] `https://noviraacademy.com/translation/` returns HTTP 200.
- [ ] `https://noviraacademy.com/blog/` returns HTTP 200.
- [ ] No PHP fatal errors in `/home/u709601498/domains/noviraacademy.com/public_html/wp-content/debug.log`.
- [ ] Database counts remain unchanged:
  - Pages: 18
  - Published blog posts: 23
  - Attachments: 23
  - Comments: 1

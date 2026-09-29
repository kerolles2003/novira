# Novira Academy — WordPress Theme & Infrastructure

[![WordPress](https://img.shields.io/badge/WordPress-7.0%2B-21759B?logo=wordpress&logoColor=white)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.4-38B2AC?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker&logoColor=white)](https://www.docker.com)

Welcome to the **Novira Academy** theme repository. This codebase powers the flagship educational platform for Novira Academy ([noviraacademy.com](https://noviraacademy.com)), featuring specialized landing hubs for the American Diploma, International Exams (EST, Digital SAT, ACT), Teacher Education Programs, and Certified Translation Services.

This guide provides everything a new developer needs to clone the repository, run the project locally in Docker, understand the architecture, build clean production artifacts, and safely deploy updates to Hostinger.

---

## 1. Project Overview

Novira Academy is a bilingual (Arabic-first, RTL-native with English translation layer) WordPress web application.

Key pillars:
* **American Diploma Hub (`/american-diploma/`):** Flagship multi-section landing with curriculum breakdown, accreditation trust signals, and Google Drive study materials for Biology, English, and Mathematics.
* **Exam Landing Spokes (`/american-diploma/est/`, `/exams/`):** Custom high-conversion examination pages.
* **Education & Training (`/education/`):** Educational courses and teacher preparation pathways.
* **Certified Translation Services (`/translation/`):** Certified document translation quote request engine.
* **Blog & Resources (`/blog/`):** Custom Post Type (`blog_post`) architecture with structured categories.

---

## 2. Technology Stack

* **CMS:** WordPress Core 7.0+
* **Backend Runtime:** PHP 8.3 (Strict types, native WordPress APIs, no Composer overhead)
* **Frontend Styles:** Vanilla CSS + utility-compiled Tailwind CSS v3 (RTL-first)
* **Local Development:** Docker & Docker Compose (WordPress + MySQL 8.0)
* **Production Hosting:** Hostinger Cloud Linux (PHP 8.3, LiteSpeed/OpenLiteSpeed, WP-CLI 2.12+)
* **Build & Deploy Tooling:** PowerShell 5.1+ / 7+ & Bash scripts

---

## 3. Repository Structure

```
novira-theme/
├── assets/                  # Production static assets (CSS, JS, images, icons, fonts)
│   ├── css/                 # Page-specific & component stylesheets
│   ├── images/              # SVGs, WebP/AVIF graphics, favicons, accreditations
│   └── js/                  # Vanilla interactive scripts (modals, navigations, counters)
├── docker/                  # Local development Docker fixtures
│   └── local-dev-seed.sql   # Sanitized MySQL seed for instant local onboarding
├── docs/                    # Technical architecture & deployment documentation
│   ├── ARCHITECTURE.md      # Deep dive into theme architecture and routing
│   └── DEPLOYMENT.md        # Comprehensive deployment & rollback manual
├── inc/                     # Modular theme backend logic
│   ├── custom-post-types.php# CPT definitions (blog_post, event, etc.)
│   ├── form-handling.php    # Nonce-protected form handlers (Registration, Quote)
│   ├── nav-walkers.php      # Custom navigation walker implementations
│   └── seo.php              # OpenGraph, Twitter Cards, and schema markup
├── languages/               # Translation runtime files (.mo / .po)
├── scripts/                 # Operational automation scripts
│   └── deploy-production.ps1# Controlled Hostinger staged deployment automation
├── template-parts/          # Reusable template components & sections
├── build-production.ps1     # Production artifact packaging pipeline (Windows/PS)
├── build-production.sh      # Production artifact packaging pipeline (Linux/macOS)
├── docker-compose.yml       # Local Docker container definition
├── functions.php            # Theme bootstrapper, asset enqueues, theme support
├── package.json             # Tailwind CSS development build dependencies
├── style.css                # WordPress theme header metadata
└── README.md                # Master onboarding guide (this file)
```

---

## 4. Resource Classification: What Lives Where

To avoid security leaks and maintain data integrity, resources are strictly categorized:

| Category | Location | In Git? | Description |
| :--- | :--- | :---: | :--- |
| **Theme Code** | `novira-theme/` | **YES** | PHP templates, styles, scripts, theme assets |
| **Local DB Seed** | `docker/local-dev-seed.sql` | **YES** | Sanitized development database (0 customer PII) |
| **Build Scripts** | `build-production.*` | **YES** | Pipelines to package production zip |
| **Deploy Tool** | `scripts/deploy-*.ps1` | **YES** | Staged deployment automation |
| **Local Uploads** | `wp-content/uploads/` | **NO** | Kept in Docker volume `wp_data` |
| **SSH Private Keys**| `~/.ssh/id_ed25519` | **NEVER** | Kept on developer's machine only |
| **Production DB** | Hostinger MySQL | **NEVER** | Authoritative database. Never committed. |
| **Production Uploads** | Hostinger `uploads/` | **NEVER** | Authoritative media library. Never overwritten. |

---

## 5. Prerequisites

Before starting, install on your workstation:
1. **Git:** [git-scm.com](https://git-scm.com/)
2. **Docker Desktop:** [docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
3. **PowerShell 5.1+ or PowerShell 7+** (built into Windows 10/11)
4. **Node.js (v18+) & npm** (Optional, only needed if modifying Tailwind styles)
5. **OpenSSH Client:** Standard Windows OpenSSH (`ssh.exe`, `scp.exe`)

---

## 6. Local Setup & Quickstart (Under 2 Minutes)

### Step 1: Clone the Repository
```bash
git clone <GITHUB_REPOSITORY_URL> novira-theme
cd novira-theme
```

### Step 2: Boot Docker Environment
```bash
docker compose up -d
```
* The MySQL container boots and **automatically executes** `docker/local-dev-seed.sql` to initialize all 18 pages, categories, blog posts, permalinks, and theme options.
* The WordPress container boots and mounts the theme directly into `/var/www/html/wp-content/themes/novira-theme`.

### Step 3: Access the Site
Open your browser:
* **Frontend:** [http://localhost:8889](http://localhost:8889)
* **WordPress Admin:** [http://localhost:8889/wp-admin](http://localhost:8889/wp-admin)

**Local Admin Credentials:**
* **Username:** `admin`
* **Password:** `admin123`

---

## 7. Local Development Workflow

### Modifying Theme Templates & CSS
* Edits to PHP templates and files inside `assets/css/` reflect **instantly** on reload at `http://localhost:8889`.
* The local Docker container mounts the working tree live.

### Rebuilding Tailwind CSS (Optional)
If you add new Tailwind classes:
```bash
npm install
npm run build:css   # Compiles to assets/css/tailwind-compiled.css
# or for live watch:
npm run watch:css
```

---

## 8. Git Workflow & Best Practices

1. **Work in Topic Branches:**
   ```bash
   git checkout -b feat/your-feature-name
   ```
2. **Validate Clean Working Tree:**
   ```bash
   git diff --check
   ```
3. **Commit with Conventional Commits:**
   ```bash
   git commit -m "feat: description of change"
   ```
4. **Merge into `main`:**
   Deployments are strictly made from the `main` branch.

---

## 9. Production Artifact Packaging

Never upload the working repository directly to production. The repository contains development configs, specs, Docker definitions, and uncompiled assets that must never ship.

To package a clean, production-ready ZIP archive:

```powershell
powershell -ExecutionPolicy Bypass -File build-production.ps1
```
*(On macOS/Linux, run `bash build-production.sh`)*

### What the Build Pipeline Does:
1. Copies theme files to a clean temporary staging directory.
2. Strips all non-runtime files:
   * `.git/`, `.agents/`, `docker/`, `scripts/`, `node_modules/`, `specs/`, `docs/`, `plugins/`
   * Development configs: `package.json`, `tailwind.config.js`, `docker-compose.yml`
   * Root mockups (`*.png`) and prototypes (`stitch-contact*`, `*.html`)
   * CLI tools in `languages/`
3. Restores verified runtime favicons and logos.
4. Generates a clean archive: `..\novira-theme.zip` (247 files, ~2.5 MB).

---

## 10. Production Deployment to Hostinger

Novira Academy uses an automated, staged deployment pipeline that guarantees **zero database risk** and **zero downtime**.

### Deployment Architecture:
```
Local Git (main)
  │
  ├── 1. Run build-production.ps1 -> novira-theme.zip (247 files, 2.5 MB)
  │
  ├── 2. SSH Connection to Hostinger (45.84.206.205:65002)
  │
  ├── 3. Pre-Deploy Backups:
  │      ├── wp db export -> ~/backups/novira/novira-db-predeploy-<ts>.sql
  │      └── tar -czf     -> ~/backups/novira/novira-theme-predeploy-<ts>.tar.gz
  │
  ├── 4. SCP Upload -> ~/backups/novira/deploy-<ts>/novira-theme.zip
  │
  ├── 5. Extract to Staging & Run diff -rq against live theme
  │
  ├── 6. Synchronize approved files (cp -a) into wp-content/themes/novira-theme/
  │
  └── 7. Automated Health Check (HTTP 200 on all landing hubs + DB audit)
```

### Running the Deployment:

1. **Dry-Run (Audit differences without touching live site):**
   ```powershell
   .\scripts\deploy-production.ps1 -DryRun
   ```

2. **Live Production Deployment:**
   ```powershell
   .\scripts\deploy-production.ps1
   ```

*(See [docs/DEPLOYMENT.md](file:///d:/novira/final_site/novira-theme/docs/DEPLOYMENT.md) for full configuration parameters and emergency rollback steps).*

---

## 11. Rollback Procedure

If any issue arises post-deployment:
1. SSH into Hostinger:
   ```bash
   ssh -p 65002 u709601498@45.84.206.205
   ```
2. Restore the previous theme archive:
   ```bash
   tar -xzf ~/backups/novira/novira-theme-predeploy-<TIMESTAMP>.tar.gz -C /home/u709601498/domains/noviraacademy.com/public_html/wp-content/themes/
   ```

---

## 12. Required External Accounts & Access Handover

To manage this project in production, obtain these credentials from the project owner:

1. **Hostinger SSH Access:**
   * Generate your own personal SSH key pair locally (`ssh-keygen -t ed25519`). The previous developer's private SSH key must **NEVER** be shared or transferred.
   * Provide your public key (`~/.ssh/id_ed25519.pub`) to the project owner to be authorized in Hostinger `~/.ssh/authorized_keys`.
   * Connection info: Host `45.84.206.205`, Port `65002`, User `u709601498`.
2. **Hostinger hPanel Account:** For domain DNS, SSL certificates, and server renewals.
3. **WordPress Production Admin:** Administrator user account on `https://noviraacademy.com/wp-admin`.
4. **Google Drive Shared Folder:** Access to manage American Diploma student materials.

---

## 13. Critical Security & Invariant Rules

> [!IMPORTANT]
> **1. Production DB is Authoritative:** Real user data (inquiries, registrations) lives in production. Never overwrite the production database with local data.
>
> **2. Production Uploads are Authoritative:** `wp-content/uploads/` belongs to the live website. Never delete or overwrite the uploads directory.
>
> **3. Never Commit Secrets:** Never commit SSH private keys (`id_ed25519`), `.env` files with live passwords, or production database exports containing user PII.
>
> **4. Never Use Blind `rsync --delete`:** Always use the staged deployment pipeline (`scripts/deploy-production.ps1`).

---

## 14. Troubleshooting

### Port 8889 or 3308 already in use locally
Edit `docker-compose.yml` to change the host port bindings (e.g. `"8890:80"` or `"3309:3306"`). Update `wp_options` `siteurl` and `home` accordingly.

### Permalinks returning 404 locally
In local WordPress Admin: Go to **Settings → Permalinks** and click **Save Changes** once. This writes the `.htaccess` rewrite rules.

### SSH connection fails during deployment
Verify your SSH key is added to the ssh-agent or pass your key path explicitly:
```powershell
.\scripts\deploy-production.ps1 -HostingerKeyPath "C:\Users\<user>\.ssh\id_ed25519"
```

---

## 15. License & Ownership
Copyright © 2026 Novira Academy. All rights reserved. Private and confidential proprietary software.

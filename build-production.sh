#!/usr/bin/env bash
#
# Build a clean production theme zip for Hostinger deployment.
#
# Produces ../novira-theme.zip containing ONLY the files WordPress needs at
# runtime — excluding dev tooling, design sources, build scripts, internal
# docs, and anything that would leak information or bloat the upload.
#
# Usage:  bash build-production.sh
#
set -euo pipefail

THEME_SLUG="novira-theme"
SRC_DIR="$(cd "$(dirname "$0")" && pwd)"
OUT_ZIP="$(dirname "$SRC_DIR")/${THEME_SLUG}.zip"
STAGE="$(dirname "$SRC_DIR")/.novira-build/${THEME_SLUG}"

echo "Staging clean theme from: $SRC_DIR"
rm -rf "$(dirname "$STAGE")"
mkdir -p "$STAGE"

# Copy the whole theme, then prune. rsync keeps this readable and auditable.
rsync -a \
  --exclude '.git/' \
  --exclude '.agents/' \
  --exclude '.claude/' \
  --exclude '.opencode/' \
  --exclude '.specify/' \
  --exclude 'specs/' \
  --exclude 'docs/' \
  --exclude 'node_modules/' \
  --exclude 'plugins/' \
  --exclude '.novira-build/' \
  --exclude '*.png' \
  --exclude '*.html' \
  --exclude 'stitch-*' \
  --exclude 'extract-images.js' \
  --exclude 'fix-animated-js.js' \
  --exclude 'make-placeholders.js' \
  --exclude 'rewrite-*.js' \
  --exclude 'tailwind.config.js' \
  --exclude 'tailwind-source.css' \
  --exclude 'package.json' \
  --exclude 'package-lock.json' \
  --exclude 'docker-compose.yml' \
  --exclude 'skills-lock.json' \
  --exclude 'AGENTS.md' \
  --exclude 'DESIGN.md' \
  --exclude 'PRODUCT.md' \
  --exclude 't.md' \
  --exclude '*.txt' \
  --exclude 'build-production.sh' \
  --exclude 'languages/*.pot' \
  --exclude 'languages/*.php' \
  --exclude '*.bak' --exclude '*.old' --exclude '*.orig' \
  --exclude '.DS_Store' --exclude 'Thumbs.db' \
  "$SRC_DIR"/ "$STAGE"/

# readme.txt and style.css are required WP theme metadata — restore them
# (the blanket *.txt exclude above would otherwise drop readme.txt).
[ -f "$SRC_DIR/readme.txt" ] && cp "$SRC_DIR/readme.txt" "$STAGE/readme.txt"

# Re-include the referenced raster assets that the *.png sweep removed but the
# site actually uses (education hero + logo). Keeping the sweep broad and
# whitelisting is safer than trying to name every design mockup.
mkdir -p "$STAGE/assets/images"
for keep in \
  "assets/images/hero.png" \
  "assets/images/logo.jpg" \
  "assets/images/logo_horizontal.png" \
  "assets/images/logo_horizontal.webp" ; do
  if [ -f "$SRC_DIR/$keep" ]; then
    mkdir -p "$STAGE/$(dirname "$keep")"
    cp "$SRC_DIR/$keep" "$STAGE/$keep"
  fi
done
# Drop the two stray design PNGs that live under template-parts/sections/.
rm -f "$STAGE/template-parts/sections/about-us.png" "$STAGE/template-parts/sections/contact.png"

echo "Zipping -> $OUT_ZIP"
rm -f "$OUT_ZIP"
( cd "$(dirname "$STAGE")" && zip -r -q "$OUT_ZIP" "$THEME_SLUG" )
rm -rf "$(dirname "$STAGE")"

echo "Done. Production theme: $OUT_ZIP"
du -h "$OUT_ZIP" | cut -f1 | xargs echo "Zip size:"

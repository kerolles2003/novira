/**
 * Generate replaceable placeholder assets for Development Visual Mode (Sprint U1.5).
 *
 * Produces real raster images under assets/placeholders/ so sections always
 * render their final intended layout. Each file is meant to be replaced 1:1 by
 * real content later — same filename, no PHP edits required.
 *
 * Run:  node make-placeholders.js
 * Tools: sharp (SVG -> JPG/WebP rasterization).
 */
const fs = require('fs');
const path = require('path');
const sharp = require('sharp');

const OUT = path.join(__dirname, 'assets', 'placeholders');
fs.mkdirSync(OUT, { recursive: true });

const PURPLE = '#5B14E6';
const INDIGO = '#1E1B4B';
const GOLD = '#d4af37';

// Small helper: a "replace me" filename tag used on every placeholder.
const tag = (txt, x, y, size = 22, fill = '#8a86a0') =>
  `<text x="${x}" y="${y}" font-family="Arial, sans-serif" font-size="${size}" fill="${fill}" text-anchor="middle">${txt}</text>`;

const assets = [
  {
    file: 'founder-placeholder.jpg',
    fmt: 'jpeg',
    w: 800, h: 800,
    svg: `
      <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800">
        <defs><linearGradient id="g" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0" stop-color="#eef0f4"/><stop offset="1" stop-color="#e1e5ee"/>
        </linearGradient></defs>
        <rect width="800" height="800" fill="url(#g)"/>
        <circle cx="400" cy="360" r="210" fill="#ffffff" opacity="0.55"/>
        <circle cx="400" cy="305" r="105" fill="${PURPLE}" opacity="0.85"/>
        <path d="M250 520 a150 150 0 0 1 300 0 v40 h-300 z" fill="${PURPLE}" opacity="0.85"/>
        <text x="400" y="650" font-family="Arial, sans-serif" font-size="40" font-weight="700" fill="#2a2540" text-anchor="middle">FOUNDER PORTRAIT</text>
        ${tag('replace: founder-placeholder.jpg', 400, 700)}
      </svg>`,
  },
  {
    file: 'student-story-poster.jpg',
    fmt: 'jpeg',
    w: 720, h: 1280,
    svg: `
      <svg xmlns="http://www.w3.org/2000/svg" width="720" height="1280">
        <defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0" stop-color="${PURPLE}"/><stop offset="1" stop-color="${INDIGO}"/>
        </linearGradient></defs>
        <rect width="720" height="1280" fill="url(#g)"/>
        <circle cx="360" cy="560" r="120" fill="#ffffff" opacity="0.12"/>
        <path d="M330 510 l80 50 l-80 50 z" fill="#ffffff" opacity="0.9"/>
        <text x="360" y="760" font-family="Arial, sans-serif" font-size="46" font-weight="800" fill="#ffffff" text-anchor="middle">STUDENT STORY</text>
        ${tag('replace: student-story-poster.jpg', 360, 810, 22, '#d9d3f5')}
      </svg>`,
  },
  {
    file: 'certificate-placeholder.webp',
    fmt: 'webp',
    w: 1000, h: 707,
    svg: `
      <svg xmlns="http://www.w3.org/2000/svg" width="1000" height="707">
        <rect width="1000" height="707" fill="#f7f6fb"/>
        <rect x="40" y="40" width="920" height="627" fill="#ffffff" stroke="${GOLD}" stroke-width="6" rx="10"/>
        <text x="500" y="160" font-family="Arial, sans-serif" font-size="52" font-weight="800" fill="#2a2540" text-anchor="middle">CERTIFICATE</text>
        <text x="500" y="210" font-family="Arial, sans-serif" font-size="26" fill="${GOLD}" text-anchor="middle" letter-spacing="4">(PLACEHOLDER)</text>
        <rect x="250" y="290" width="500" height="14" fill="#e6e3f0" rx="7"/>
        <rect x="320" y="330" width="360" height="14" fill="#e6e3f0" rx="7"/>
        <circle cx="500" cy="470" r="60" fill="none" stroke="${GOLD}" stroke-width="4"/>
        <circle cx="500" cy="470" r="40" fill="none" stroke="${GOLD}" stroke-width="2"/>
        ${tag('replace: certificate-placeholder.webp', 500, 640)}
      </svg>`,
  },
  {
    file: 'video-thumbnail-placeholder.jpg',
    fmt: 'jpeg',
    w: 1280, h: 720,
    svg: `
      <svg xmlns="http://www.w3.org/2000/svg" width="1280" height="720">
        <defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0" stop-color="${PURPLE}"/><stop offset="1" stop-color="${INDIGO}"/>
        </linearGradient></defs>
        <rect width="1280" height="720" fill="url(#g)"/>
        <circle cx="640" cy="330" r="80" fill="#ffffff" opacity="0.9"/>
        <path d="M615 290 l60 40 l-60 40 z" fill="${PURPLE}"/>
        <text x="640" y="500" font-family="Arial, sans-serif" font-size="44" font-weight="800" fill="#ffffff" text-anchor="middle">VIDEO PLACEHOLDER</text>
        ${tag('replace: video-thumbnail-placeholder.jpg', 640, 550, 22, '#d9d3f5')}
      </svg>`,
  },
  {
    file: 'review-placeholder.webp',
    fmt: 'webp',
    w: 400, h: 400,
    svg: `
      <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400">
        <rect width="400" height="400" fill="#faf9ff"/>
        <circle cx="200" cy="165" r="70" fill="${PURPLE}" opacity="0.9"/>
        <text x="200" y="185" font-family="Georgia, serif" font-size="80" font-weight="800" fill="#ffffff" text-anchor="middle">&#8220;</text>
        <text x="200" y="290" font-family="Arial, sans-serif" font-size="26" font-weight="700" fill="#2a2540" text-anchor="middle">REVIEW</text>
        ${tag('review-placeholder.webp', 200, 330, 16)}
      </svg>`,
  },
];

(async () => {
  for (const a of assets) {
    const buf = Buffer.from(a.svg);
    let img = sharp(buf);
    if (a.fmt === 'jpeg') img = img.jpeg({ quality: 82 });
    else if (a.fmt === 'webp') img = img.webp({ quality: 85 });
    await img.toFile(path.join(OUT, a.file));
    console.log('created', a.file, `(${a.w}x${a.h})`);
  }
  console.log('DONE ->', OUT);
})().catch((e) => { console.error('FAILED:', e.message); process.exit(1); });

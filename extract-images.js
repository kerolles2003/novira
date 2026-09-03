const fs = require('fs');
const path = require('path');
const https = require('https'); // For fetching remote image sizes/headers if needed, though we can skip full remote inspection if not necessary, but size is good. We'll just look at extensions.

const themeDir = 'D:/novira/final_site/novira-theme';

function getAllFiles(dir) {
  let results = [];
  const list = fs.readdirSync(dir);
  list.forEach(file => {
    file = path.join(dir, file);
    const stat = fs.statSync(file);
    if (stat && stat.isDirectory() && !file.includes('node_modules') && !file.includes('.git')) {
      results = results.concat(getAllFiles(file));
    } else {
      if (file.endsWith('.php') || file.endsWith('.html') || file.endsWith('.css')) {
        results.push(file);
      }
    }
  });
  return results;
}

const files = getAllFiles(themeDir);
const imgRegex = /<img[^>]+src=["']([^"']+)["'][^>]*>/gi;
const classRegex = /class=["']([^"']+)["']/i;
const altRegex = /alt=["']([^"']*)["']/i;
const loadingRegex = /loading=["']([^"']+)["']/i;
const srcsetRegex = /srcset=["']([^"']+)["']/i;
const widthRegex = /width=["']([^"']+)["']/i;

const cssUrlRegex = /url\(['"]?([^'"\)]+\.(?:png|jpg|jpeg|webp|svg|gif|avif))['"]?\)/gi;
const tailwindBgUrlRegex = /bg-\[url\(['"]?([^'"\)]+\.(?:png|jpg|jpeg|webp|svg|gif|avif))['"]?\)\]/gi;

const images = [];
const seenUrls = new Set();

files.forEach(file => {
  const content = fs.readFileSync(file, 'utf8');
  const shortPath = file.replace(themeDir, '').replace(/\\/g, '/');
  
  let match;
  // Parse <img>
  while ((match = imgRegex.exec(content)) !== null) {
    const fullTag = match[0];
    let src = match[1];
    
    // PHP variables might be in src. E.g. <?php echo get_template_directory_uri(); ?>/assets...
    if (src.includes('<?php')) {
        src = src.replace(/<\?php[^>]+>/g, '').trim();
    }
    
    const hasSrcset = srcsetRegex.test(fullTag);
    const loadingMatch = loadingRegex.exec(fullTag);
    const loading = loadingMatch ? loadingMatch[1] : 'eager (default)';
    
    const imgObj = {
      src,
      type: 'img',
      file: shortPath,
      hasSrcset,
      loading,
      originalTag: fullTag
    };
    
    images.push(imgObj);
  }
  
  // Parse CSS url()
  while ((match = cssUrlRegex.exec(content)) !== null) {
    images.push({
      src: match[1],
      type: 'css-bg',
      file: shortPath,
      hasSrcset: false,
      loading: 'css (render-blocking)'
    });
  }
  
  // Parse Tailwind bg-[url()]
  while ((match = tailwindBgUrlRegex.exec(content)) !== null) {
    images.push({
      src: match[1],
      type: 'tailwind-bg',
      file: shortPath,
      hasSrcset: false,
      loading: 'css (render-blocking)'
    });
  }
});

// Since the server is local, we might not have `image-size` package installed. 
// We will output the list of images to analyze them manually or guess based on typical URLs.
console.log(JSON.stringify(images, null, 2));

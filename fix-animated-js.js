const fs = require('fs');

const html = fs.readFileSync('d:/novira/final_site/novira-theme/animated-results.html', 'utf8');

// Extract the main HTML from body
const bodyMatch = html.match(/<body[^>]*>([\s\S]*?)<\/body>/);
if (!bodyMatch) throw new Error("Could not extract body HTML");

let htmlContent = bodyMatch[1];
// Remove any script tags from the html content to avoid duplicate scripts
htmlContent = htmlContent.replace(/<script[\s\S]*?<\/script>/g, '');

// Extract CSS
const cssMatch = html.match(/<style data-purpose="custom-styles">([\s\S]*?)<\/style>/);
if (!cssMatch) throw new Error("Could not extract CSS");
let css = cssMatch[1];
css = css.replace(/body\s*\{[^}]*\}/g, '');

// Extract JS correctly - get all script tags and use the one that DOES NOT contain tailwind.config
const scriptMatches = [...html.matchAll(/<script>([\s\S]*?)<\/script>/g)];
let js = '';
for (const match of scriptMatches) {
    if (!match[1].includes('tailwind.config')) {
        js = match[1];
        break;
    }
}
if (!js) throw new Error("Could not extract animation JS");

// Update JS DOMContentLoaded logic
js = js.replace(/document\.addEventListener\('DOMContentLoaded',\s*\(\)\s*=>\s*\{/, 'const initAnimatedResults = () => {');
js = js.replace(/\}\);\s*$/, '};\nif (document.readyState === "loading") { document.addEventListener("DOMContentLoaded", initAnimatedResults); } else { initAnimatedResults(); }');

const phpContent = `<?php
/**
 * Template Part: Animated Results Section
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="animated-results-section relative">
${htmlContent}

<style>
${css}
</style>

<script>
${js}
</script>
</section>`;

fs.writeFileSync('d:/novira/final_site/novira-theme/template-parts/sections/animated-results.php', phpContent, 'utf8');
console.log("Successfully fixed animated-results.php HTML layout!");

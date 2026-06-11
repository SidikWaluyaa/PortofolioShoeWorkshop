import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const buildDir = path.resolve(__dirname, 'public/build');
const publicDir = path.resolve(__dirname, 'public');

const files = ['sw.js', 'registerSW.js', 'manifest.webmanifest'];

console.log('[PWA] Running post-build copy...');

files.forEach(file => {
    const srcPath = path.join(buildDir, file);
    if (fs.existsSync(srcPath)) {
        fs.copyFileSync(srcPath, path.join(publicDir, file));
        console.log(`[PWA] Copied ${file} to public/`);
    } else {
        console.log(`[PWA] Warning: ${file} not found in build directory.`);
    }
});

if (fs.existsSync(buildDir)) {
    fs.readdirSync(buildDir).forEach(file => {
        if (file.startsWith('workbox-') && file.endsWith('.js')) {
            fs.copyFileSync(path.join(buildDir, file), path.join(publicDir, file));
            console.log(`[PWA] Copied ${file} to public/`);
        }
    });
}

console.log('[PWA] Post-build copy completed.');

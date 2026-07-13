const fs = require('fs');
const path = require('path');

const directory = path.join(__dirname, 'resources', 'views');

const pattern_success = /^\s*@if\(session\('success'\)\)[\s\S]*?@endif\s*$/gm;
const pattern_error = /^\s*@if\(\$errors->any\(\)\)[\s\S]*?@endif\s*$/gm;
const pattern_session_error = /^\s*@if\(session\('error'\)\)[\s\S]*?@endif\s*$/gm;

let count = 0;

function walk(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const filepath = path.join(dir, file);
        const stat = fs.statSync(filepath);
        if (stat.isDirectory()) {
            walk(filepath);
        } else if (file.endsWith('.blade.php')) {
            // Exclude the components folder to not delete our new component
            if (filepath.includes('components\\flash-messages.blade.php') || filepath.includes('components/flash-messages.blade.php')) {
                continue;
            }

            const content = fs.readFileSync(filepath, 'utf8');
            let newContent = content.replace(pattern_success, '');
            newContent = newContent.replace(pattern_error, '');
            newContent = newContent.replace(pattern_session_error, '');

            if (newContent !== content) {
                fs.writeFileSync(filepath, newContent, 'utf8');
                console.log(`Cleaned ${filepath}`);
                count++;
            }
        }
    }
}

walk(directory);
console.log(`\nFinished cleaning ${count} files.`);

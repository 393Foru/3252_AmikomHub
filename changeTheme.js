const fs = require("fs");
const path = require("path");

const args = process.argv.slice(2);
if (args.length < 2) {
    console.log("Usage: node changeTheme.js <theme> <file1> <file2> ...");
    process.exit(1);
}

const theme = args[0];
const files = args.slice(1);

const themes = {
    "orange": { primary: "orange", secondary: "rose" },
    "blue": { primary: "blue", secondary: "cyan" },
    "teal": { primary: "teal", secondary: "emerald" },
    "indigo": { primary: "indigo", secondary: "purple" }
};

const target = themes[theme];
if (!target) {
    console.log("Unknown theme: " + theme);
    process.exit(1);
}

// Current base themes we might be replacing from
const colorsToReplace = ["indigo", "purple", "orange", "rose", "blue", "cyan", "teal", "emerald"];

files.forEach(file => {
    let content = fs.readFileSync(file, "utf8");
    let newContent = content;

    // We assume the current state is one of the themes. To be safe, we replace ALL possible primary colors with the target primary,
    // and ALL possible secondary colors with the target secondary. 
    // Wait, it is better to just replace the exact classes.
    // A regex to match any of the colors followed by a hyphen and a number or word.
    
    // For primary colors
    const primaryRegex = new RegExp(`\\b(?:indigo|orange|blue|teal)(-)(50|100|200|300|400|500|600|700|800|900)\\b`, "g");
    newContent = newContent.replace(primaryRegex, `${target.primary}$1$2`);

    // For secondary colors
    const secondaryRegex = new RegExp(`\\b(?:purple|rose|cyan|emerald)(-)(50|100|200|300|400|500|600|700|800|900)\\b`, "g");
    newContent = newContent.replace(secondaryRegex, `${target.secondary}$1$2`);
    
    if (content !== newContent) {
        fs.writeFileSync(file, newContent, "utf8");
        console.log(`Updated ${file}`);
    }
});


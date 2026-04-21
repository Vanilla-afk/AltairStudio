import fs from 'node:fs/promises';
import path from 'node:path';
import sharp from 'sharp';

const projectRoot = process.cwd();
const inputDir = path.join(projectRoot, 'public', 'images');
const outputDir = path.join(inputDir, 'optimized');

const targets = [
    { file: 'background.WebP', width: 1600, quality: 68 },
    { file: 'background2.WebP', width: 1920, quality: 65 },
    { file: 'background3.WebP', width: 1920, quality: 62 },
    { file: 'pic1.WebP', width: 1200, quality: 68 },
    { file: 'pic2.WebP', width: 1200, quality: 68 },
    { file: 'pic3.WebP', width: 1200, quality: 66 },
    { file: 'pic4.WebP', width: 1200, quality: 66 },
    { file: 'pic5.WebP', width: 1200, quality: 68 },
];

const formatSize = (bytes) => {
    if (bytes < 1024) return `${bytes} B`;
    const kb = bytes / 1024;
    if (kb < 1024) return `${kb.toFixed(1)} KB`;
    return `${(kb / 1024).toFixed(2)} MB`;
};

const optimizeOne = async ({ file, width, quality }) => {
    const inputPath = path.join(inputDir, file);
    const outputName = file.replace(/\.[^.]+$/, '.webp');
    const outputPath = path.join(outputDir, outputName);

    try {
        const sourceStats = await fs.stat(inputPath);

        await sharp(inputPath)
            .rotate()
            .resize({ width, withoutEnlargement: true })
            .webp({ quality, effort: 5 })
            .toFile(outputPath);

        const outputStats = await fs.stat(outputPath);
        const saved = sourceStats.size - outputStats.size;
        const pct = sourceStats.size > 0 ? (saved / sourceStats.size) * 100 : 0;

        console.log(
            `${file} -> optimized/${outputName} | ${formatSize(sourceStats.size)} -> ${formatSize(outputStats.size)} | saved ${formatSize(saved)} (${pct.toFixed(1)}%)`
        );
    } catch (error) {
        console.error(`Failed to optimize ${file}:`, error.message);
        process.exitCode = 1;
    }
};

await fs.mkdir(outputDir, { recursive: true });

for (const target of targets) {
    await optimizeOne(target);
}

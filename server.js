#!/usr/bin/env node
/**
 * Simple HTTP Server for Car Rental Frontend
 * Run with: node server.js
 */

const http = require('http');
const fs = require('fs');
const path = require('path');
const { exec } = require('child_process');

// Configuration
const PORT = 8000;
const HOST = 'localhost';

// MIME types
const mimeTypes = {
    '.html': 'text/html',
    '.css': 'text/css',
    '.js': 'application/javascript',
    '.json': 'application/json',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.gif': 'image/gif',
    '.svg': 'image/svg+xml',
    '.ico': 'image/x-icon',
    '.woff': 'font/woff',
    '.woff2': 'font/woff2',
    '.ttf': 'font/ttf',
    '.eot': 'application/vnd.ms-fontobject'
};

const server = http.createServer((req, res) => {
    // Handle root path
    let filePath = req.url === '/' ? '/simple-index.html' : req.url;
    
    // Remove query parameters
    filePath = filePath.split('?')[0];
    
    // Build full file path
    const fullPath = path.join(__dirname, filePath);
    
    // Get file extension
    const ext = path.extname(filePath).toLowerCase();
    const contentType = mimeTypes[ext] || 'application/octet-stream';
    
    // Check if file exists
    fs.access(fullPath, fs.constants.F_OK, (err) => {
        if (err) {
            // File not found
            res.writeHead(404, { 'Content-Type': 'text/html' });
            res.end(`
                <html>
                    <head><title>404 - Not Found</title></head>
                    <body>
                        <h1>404 - File Not Found</h1>
                        <p>The requested file <code>${filePath}</code> was not found.</p>
                        <p><a href="/">Go to Homepage</a></p>
                    </body>
                </html>
            `);
            return;
        }
        
        // Read and serve file
        fs.readFile(fullPath, (err, data) => {
            if (err) {
                res.writeHead(500, { 'Content-Type': 'text/html' });
                res.end('<h1>500 - Internal Server Error</h1>');
                return;
            }
            
            // Set headers
            res.writeHead(200, {
                'Content-Type': contentType,
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers': 'Content-Type'
            });
            
            res.end(data);
        });
    });
});

// Start server
server.listen(PORT, HOST, () => {
    const serverUrl = `http://${HOST}:${PORT}`;
    
    console.log('='.repeat(60));
    console.log('🚗 Car Rental Frontend Server');
    console.log('='.repeat(60));
    console.log(`Server running at: ${serverUrl}`);
    console.log(`Main page: ${serverUrl}/simple-index.html`);
    console.log(`Test page: ${serverUrl}/test.html`);
    console.log(`Original: ${serverUrl}/index.html`);
    console.log('='.repeat(60));
    console.log('Press Ctrl+C to stop the server');
    console.log('='.repeat(60));
    
    // Try to open browser automatically
    const openCommand = process.platform === 'win32' ? 'start' : 
                       process.platform === 'darwin' ? 'open' : 'xdg-open';
    
    exec(`${openCommand} ${serverUrl}/simple-index.html`, (err) => {
        if (err) {
            console.log('⚠️  Please open your browser manually');
        } else {
            console.log('✅ Browser opened automatically');
        }
    });
});

// Handle server shutdown
process.on('SIGINT', () => {
    console.log('\n🛑 Server stopped');
    process.exit(0);
});
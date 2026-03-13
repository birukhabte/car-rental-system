#!/bin/bash

echo "🚗 Car Rental Frontend Server Launcher"
echo "======================================"

# Check if Python is available
if command -v python3 &> /dev/null; then
    echo "✅ Python 3 found"
    echo "Starting Python server on port 8000..."
    python3 server.py
elif command -v python &> /dev/null; then
    echo "✅ Python found"
    echo "Starting Python server on port 8000..."
    python server.py
elif command -v node &> /dev/null; then
    echo "✅ Node.js found"
    echo "Starting Node.js server on port 8000..."
    node server.js
else
    echo "❌ Neither Python nor Node.js found"
    echo "Please install Python or Node.js to run the server"
    echo ""
    echo "Alternative: Use PHP if available:"
    echo "php -S localhost:8000"
    echo ""
    echo "Or use any other local server and open simple-index.html"
    exit 1
fi
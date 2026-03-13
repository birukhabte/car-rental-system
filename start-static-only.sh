#!/bin/bash

echo "🚗 Starting Car Rental Portal - Static Frontend Only"
echo "===================================================="

# Check if we're in the right directory
if [ ! -f "simple-index.html" ]; then
    echo "❌ Error: simple-index.html not found"
    echo "Please run this script from the project root directory"
    exit 1
fi

echo "🌐 Starting static frontend server..."
echo ""
echo "Choose your preferred server:"
echo "1) Python 3 (recommended)"
echo "2) Node.js"
echo "3) PHP built-in server"
echo ""
read -p "Enter choice (1-3): " choice

case $choice in
    1)
        echo "🐍 Starting Python server on port 8000..."
        python3 -m http.server 8000
        ;;
    2)
        if command -v node &> /dev/null; then
            echo "📗 Starting Node.js server on port 8000..."
            node server.js
        else
            echo "❌ Node.js not found. Using Python instead..."
            python3 -m http.server 8000
        fi
        ;;
    3)
        echo "🐘 Starting PHP server on port 8001..."
        php -S localhost:8001
        ;;
    *)
        echo "Invalid choice. Using Python server..."
        python3 -m http.server 8000
        ;;
esac
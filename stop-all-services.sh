#!/bin/bash

echo "🛑 Stopping Car Rental Portal Services"
echo "======================================"

echo "🔧 Stopping XAMPP services..."
sudo /opt/lampp/lampp stop

echo "🌐 Stopping any running web servers on common ports..."

# Kill processes on port 8000
if lsof -Pi :8000 -sTCP:LISTEN -t >/dev/null ; then
    echo "   Stopping server on port 8000..."
    sudo kill -9 $(lsof -t -i:8000) 2>/dev/null || true
fi

# Kill processes on port 8001
if lsof -Pi :8001 -sTCP:LISTEN -t >/dev/null ; then
    echo "   Stopping server on port 8001..."
    sudo kill -9 $(lsof -t -i:8001) 2>/dev/null || true
fi

# Kill any Python HTTP servers
pkill -f "python.*http.server" 2>/dev/null || true

# Kill any Node.js servers from this project
pkill -f "node server.js" 2>/dev/null || true

echo ""
echo "✅ All services stopped!"
echo ""
echo "📊 Current port status:"
echo "Port 80 (Apache): $(lsof -Pi :80 -sTCP:LISTEN -t >/dev/null && echo 'In use' || echo 'Free')"
echo "Port 3306 (MySQL): $(lsof -Pi :3306 -sTCP:LISTEN -t >/dev/null && echo 'In use' || echo 'Free')"
echo "Port 8000: $(lsof -Pi :8000 -sTCP:LISTEN -t >/dev/null && echo 'In use' || echo 'Free')"
echo "Port 8001: $(lsof -Pi :8001 -sTCP:LISTEN -t >/dev/null && echo 'In use' || echo 'Free')"
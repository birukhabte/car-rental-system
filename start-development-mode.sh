#!/bin/bash

echo "🚗 Starting Car Rental Portal - Development Mode"
echo "================================================"

# Check if we're in the right directory
if [ ! -d "carrental" ]; then
    echo "❌ Error: Please run this script from the project root directory"
    exit 1
fi

echo "🔧 Starting XAMPP services..."
sudo /opt/lampp/lampp start

echo ""
echo "⏳ Waiting for XAMPP to start..."
sleep 3

echo "🌐 Starting static frontend server..."
echo "   This will run in the background..."

# Start Python server in background
python3 -m http.server 8000 > /dev/null 2>&1 &
PYTHON_PID=$!

echo "   Static server PID: $PYTHON_PID"

echo ""
echo "✅ Development environment started!"
echo ""
echo "🌐 Access URLs:"
echo "   PHP Frontend:    http://localhost/carrental/"
echo "   Static Frontend: http://localhost:8000/"
echo "   Admin Panel:     http://localhost/carrental/admin/"
echo "   Database:        http://localhost/phpmyadmin/"
echo ""
echo "🔑 Login Credentials:"
echo "   User:  test@gmail.com / Test@123"
echo "   Admin: admin / Test@12345"
echo ""
echo "🛑 To stop:"
echo "   XAMPP: sudo /opt/lampp/lampp stop"
echo "   Static server: kill $PYTHON_PID"
echo ""
echo "💡 Tip: Use Ctrl+C to stop this script and the static server"

# Wait for user to stop
trap "echo ''; echo '🛑 Stopping static server...'; kill $PYTHON_PID; echo '✅ Static server stopped'; exit 0" INT

echo "Press Ctrl+C to stop the static server..."
wait $PYTHON_PID
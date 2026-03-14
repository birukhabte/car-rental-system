#!/bin/bash

echo "🚗 Starting Car Rental Portal - Full System"
echo "==========================================="

# Check if we're in the right directory
if [ ! -d "carrental" ]; then
    echo "❌ Error: Please run this script from the project root directory"
    exit 1
fi

echo "🔧 Starting XAMPP services..."
sudo /opt/lampp/lampp start

echo ""
echo "⏳ Waiting for services to start..."
sleep 3

echo "📊 Checking XAMPP status..."
sudo /opt/lampp/lampp status

echo ""
echo "✅ System started successfully!"
echo ""
echo "🌐 Access URLs:"
echo "   Frontend (PHP):  http://localhost/carrental/"
echo "   Admin Panel:     http://localhost/carrental/admin/"
echo "   Database:        http://localhost/phpmyadmin/"
echo "   XAMPP Dashboard: http://localhost/dashboard/"
echo ""
echo "🔑 Login Credentials:"
echo "   User:  test@gmail.com / Test@123"
echo "   Admin: admin / Test@12345"
echo ""
echo "🛑 To stop: sudo /opt/lampp/lampp stop"
#!/bin/bash

echo "🚗 Starting XAMPP for Car Rental Portal"
echo "======================================"

# Check if XAMPP is installed
if [ ! -d "/opt/lampp" ]; then
    echo "❌ XAMPP not found at /opt/lampp"
    echo "Please install XAMPP first: https://www.apachefriends.org/"
    exit 1
fi

echo "✅ XAMPP found"
echo ""

# Start XAMPP
echo "🚀 Starting XAMPP services..."
sudo /opt/lampp/lampp start

echo ""
echo "📋 XAMPP Status:"
sudo /opt/lampp/lampp status

echo ""
echo "🌐 Access URLs:"
echo "   - XAMPP Control: http://localhost/dashboard/"
echo "   - phpMyAdmin: http://localhost/phpmyadmin/"
echo "   - Car Rental: http://localhost/carrental/"
echo ""
echo "📝 Next steps:"
echo "1. Setup database in phpMyAdmin"
echo "2. Import SQL File/carrental.sql"
echo "3. Access the application"
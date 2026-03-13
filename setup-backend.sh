#!/bin/bash

echo "🚗 Car Rental Portal - Backend Setup"
echo "===================================="

# Check if we're in the right directory
if [ ! -d "carrental" ]; then
    echo "❌ Error: carrental directory not found"
    echo "Please run this script from the project root directory"
    exit 1
fi

# Check if XAMPP is installed
if [ -d "/opt/lampp" ]; then
    echo "✅ XAMPP detected"
    WEBROOT="/opt/lampp/htdocs"
    SERVICE_CMD="sudo /opt/lampp/lampp"
elif [ -d "/var/www/html" ]; then
    echo "✅ Apache detected"
    WEBROOT="/var/www/html"
    SERVICE_CMD="sudo systemctl"
else
    echo "❌ No web server detected"
    echo "Please install XAMPP or Apache first"
    exit 1
fi

echo ""
echo "Setting up backend..."

# Create backup if exists
if [ -d "$WEBROOT/carrental" ]; then
    echo "📦 Backing up existing installation..."
    sudo mv "$WEBROOT/carrental" "$WEBROOT/carrental.backup.$(date +%Y%m%d_%H%M%S)"
fi

# Copy files
echo "📁 Copying files to web directory..."
sudo cp -r carrental "$WEBROOT/"

# Set permissions
echo "🔐 Setting permissions..."
sudo chown -R www-data:www-data "$WEBROOT/carrental" 2>/dev/null || sudo chown -R apache:apache "$WEBROOT/carrental" 2>/dev/null || echo "⚠️  Could not set ownership (may need manual setup)"
sudo chmod -R 755 "$WEBROOT/carrental"
sudo chmod -R 777 "$WEBROOT/carrental/admin/img/vehicleimages" 2>/dev/null || echo "⚠️  Could not set image directory permissions"

echo ""
echo "✅ Files copied successfully!"
echo ""
echo "Next steps:"
echo "1. Start your web server:"

if [ -d "/opt/lampp" ]; then
    echo "   sudo /opt/lampp/lampp start"
else
    echo "   sudo systemctl start apache2"
    echo "   sudo systemctl start mysql"
fi

echo ""
echo "2. Setup database:"
echo "   - Open: http://localhost/phpmyadmin"
echo "   - Create database: carrental"
echo "   - Import: SQL File/carrental.sql"
echo ""
echo "3. Access your application:"
echo "   - Frontend: http://localhost/carrental/"
echo "   - Admin: http://localhost/carrental/admin/"
echo ""
echo "4. Default login credentials:"
echo "   User: test@gmail.com / Test@123"
echo "   Admin: admin / Test@12345"
echo ""
echo "🎉 Setup complete! Follow the steps above to finish."
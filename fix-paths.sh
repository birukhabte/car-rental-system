#!/bin/bash

echo "🔧 Fixing Car Rental Portal Paths"
echo "================================="

# Check current location
echo "Current directory: $(pwd)"
echo "Contents:"
ls -la carrental/ | head -5

echo ""
echo "Copying carrental folder to XAMPP web directory..."
echo "You'll need to enter your sudo password:"

# Copy the carrental folder to the correct location
sudo cp -r carrental /opt/lampp/htdocs/

# Set proper permissions
echo "Setting permissions..."
sudo chown -R daemon:daemon /opt/lampp/htdocs/carrental/
sudo chmod -R 755 /opt/lampp/htdocs/carrental/
sudo chmod -R 777 /opt/lampp/htdocs/carrental/admin/img/vehicleimages/

echo ""
echo "✅ Setup complete!"
echo ""
echo "Now you can access:"
echo "🌐 Frontend: http://localhost/carrental/"
echo "🔧 Admin: http://localhost/carrental/admin/"
echo ""
echo "Login credentials:"
echo "👤 User: test@gmail.com / Test@123"
echo "👨‍💼 Admin: admin / Test@12345"
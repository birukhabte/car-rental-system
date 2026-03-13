<?php
// Simple Database Test
echo "Car Rental Database Test\n";
echo "========================\n";

// Database credentials
$host = 'localhost';
$dbname = 'carrental';
$username = 'root';
$password = '';

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n";
    
    // Test admin table
    $stmt = $pdo->query("SELECT COUNT(*) FROM admin");
    $count = $stmt->fetchColumn();
    echo "✅ Admin table: $count records\n";
    
    // Test if default admin exists
    $stmt = $pdo->prepare("SELECT UserName FROM admin WHERE UserName = 'admin'");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "✅ Default admin user exists\n";
    } else {
        echo "❌ Default admin user not found\n";
    }
    
    // Test vehicles table
    $stmt = $pdo->query("SELECT COUNT(*) FROM tblvehicles");
    $count = $stmt->fetchColumn();
    echo "✅ Vehicles table: $count records\n";
    
    echo "\n🎉 Database is ready!\n";
    echo "Frontend: http://localhost/carrental/\n";
    echo "Admin: http://localhost/carrental/admin/\n";
    
} catch(PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "1. Check if MySQL is running\n";
    echo "2. Verify database 'carrental' exists\n";
    echo "3. Ensure SQL file was imported\n";
}
?>
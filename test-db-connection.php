<?php
// Database Connection Test for Car Rental Portal
echo "<h2>🚗 Car Rental Portal - Database Connection Test</h2>";
echo "<hr>";

// Include the config file
if (file_exists('carrental/includes/config.php')) {
    include('carrental/includes/config.php');
    echo "✅ Config file found<br>";
} else {
    echo "❌ Config file not found at carrental/includes/config.php<br>";
    exit;
}

// Test database connection
try {
    echo "<h3>Testing Database Connection...</h3>";
    
    // Check if $dbh is defined (from config.php)
    if (isset($dbh)) {
        echo "✅ Database connection object exists<br>";
        
        // Test a simple query
        $sql = "SELECT COUNT(*) as total FROM admin";
        $query = $dbh->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        echo "✅ Database query successful<br>";
        echo "📊 Admin records found: " . $result->total . "<br>";
        
        // Test other tables
        $tables = ['tblvehicles', 'tblbrands', 'tblusers', 'tblbooking'];
        echo "<h3>Testing Tables:</h3>";
        
        foreach ($tables as $table) {
            try {
                $sql = "SELECT COUNT(*) as count FROM $table";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);
                echo "✅ Table '$table': " . $result->count . " records<br>";
            } catch (Exception $e) {
                echo "❌ Table '$table': Error - " . $e->getMessage() . "<br>";
            }
        }
        
        echo "<h3>Database Info:</h3>";
        echo "🏠 Host: " . DB_HOST . "<br>";
        echo "👤 User: " . DB_USER . "<br>";
        echo "🗄️ Database: " . DB_NAME . "<br>";
        echo "🔐 Password: " . (empty(DB_PASS) ? "Empty" : "Set") . "<br>";
        
    } else {
        echo "❌ Database connection failed<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "❌ General Error: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li>If all tests pass: <a href='carrental/'>Visit Frontend</a> | <a href='carrental/admin/'>Visit Admin</a></li>";
echo "<li>If errors: Check database import and XAMPP services</li>";
echo "</ul>";
?>
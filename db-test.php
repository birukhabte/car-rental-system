<!DOCTYPE html>
<html>
<head>
    <title>Database Connection Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        .box { border: 1px solid #ddd; padding: 20px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🚗 Car Rental Portal - Database Test</h1>
    
    <?php
    // Database credentials
    $host = 'localhost';
    $dbname = 'carrental';
    $username = 'root';
    $password = '';
    
    echo "<div class='box'>";
    echo "<h3>Connection Details:</h3>";
    echo "<p><strong>Host:</strong> $host</p>";
    echo "<p><strong>Database:</strong> $dbname</p>";
    echo "<p><strong>Username:</strong> $username</p>";
    echo "<p><strong>Password:</strong> " . (empty($password) ? "Empty" : "Set") . "</p>";
    echo "</div>";
    
    try {
        // Test connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "<div class='box success'>";
        echo "<h3>✅ Database Connection Successful!</h3>";
        
        // Test tables
        $tables = [
            'admin' => 'Admin users',
            'tblvehicles' => 'Vehicles',
            'tblbrands' => 'Car brands',
            'tblusers' => 'Registered users',
            'tblbooking' => 'Bookings'
        ];
        
        echo "<h4>Table Status:</h4>";
        foreach ($tables as $table => $description) {
            try {
                $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
                $count = $stmt->fetchColumn();
                echo "<p class='success'>✅ $description ($table): $count records</p>";
            } catch (Exception $e) {
                echo "<p class='error'>❌ $description ($table): Error</p>";
            }
        }
        
        // Test admin login
        echo "<h4>Admin Account Test:</h4>";
        $stmt = $pdo->prepare("SELECT UserName, Password FROM admin WHERE UserName = 'admin'");
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($admin) {
            echo "<p class='success'>✅ Admin account found</p>";
            echo "<p class='info'>Username: admin</p>";
            echo "<p class='info'>Password Hash: " . substr($admin->Password, 0, 10) . "...</p>";
        } else {
            echo "<p class='error'>❌ Admin account not found</p>";
        }
        
        echo "</div>";
        
        echo "<div class='box info'>";
        echo "<h3>🎉 Ready to Use!</h3>";
        echo "<p><a href='carrental/' target='_blank'>🌐 Open Frontend</a></p>";
        echo "<p><a href='carrental/admin/' target='_blank'>🔧 Open Admin Panel</a></p>";
        echo "<h4>Login Credentials:</h4>";
        echo "<p><strong>User:</strong> test@gmail.com / Test@123</p>";
        echo "<p><strong>Admin:</strong> admin / Test@12345</p>";
        echo "</div>";
        
    } catch(PDOException $e) {
        echo "<div class='box error'>";
        echo "<h3>❌ Database Connection Failed</h3>";
        echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
        
        echo "<h4>Troubleshooting Steps:</h4>";
        echo "<ol>";
        echo "<li>Check if XAMPP MySQL is running: <code>sudo /opt/lampp/lampp status</code></li>";
        echo "<li>Verify database exists in <a href='/phpmyadmin' target='_blank'>phpMyAdmin</a></li>";
        echo "<li>Ensure SQL file was imported correctly</li>";
        echo "<li>Check database credentials in config.php</li>";
        echo "</ol>";
        echo "</div>";
    }
    ?>
    
    <div class="box">
        <h3>Quick Actions:</h3>
        <p><a href="/phpmyadmin" target="_blank">📊 Open phpMyAdmin</a></p>
        <p><a href="/dashboard" target="_blank">🎛️ XAMPP Dashboard</a></p>
        <p><a href="javascript:location.reload()">🔄 Refresh Test</a></p>
    </div>
</body>
</html>
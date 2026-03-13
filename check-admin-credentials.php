<?php
// Check Admin Credentials
echo "<h2>🔑 Admin Credentials Checker</h2>";
echo "<hr>";

try {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=carrental", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>Current Admin Accounts:</h3>";
    
    // Get all admin accounts
    $stmt = $pdo->query("SELECT id, UserName, Password FROM admin");
    $admins = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    if (count($admins) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password Hash</th><th>Test Password</th></tr>";
        
        foreach ($admins as $admin) {
            echo "<tr>";
            echo "<td>{$admin->id}</td>";
            echo "<td><strong>{$admin->UserName}</strong></td>";
            echo "<td>" . substr($admin->Password, 0, 20) . "...</td>";
            
            // Test common passwords
            $testPasswords = ['Test@12345', 'admin', 'password', '123456', 'admin123'];
            $matchFound = false;
            
            foreach ($testPasswords as $testPass) {
                if (md5($testPass) === $admin->Password) {
                    echo "<td style='color: green;'><strong>✅ {$testPass}</strong></td>";
                    $matchFound = true;
                    break;
                }
            }
            
            if (!$matchFound) {
                echo "<td style='color: red;'>❌ Unknown</td>";
            }
            
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<h3>🚀 How to Login:</h3>";
        echo "<ol>";
        echo "<li><strong>Go to:</strong> <a href='http://localhost/carrental/admin/' target='_blank'>http://localhost/carrental/admin/</a></li>";
        echo "<li><strong>Username:</strong> " . $admins[0]->UserName . "</li>";
        
        // Check if we found the password
        foreach ($testPasswords as $testPass) {
            if (md5($testPass) === $admins[0]->Password) {
                echo "<li><strong>Password:</strong> {$testPass}</li>";
                break;
            }
        }
        
        echo "</ol>";
        
    } else {
        echo "<p style='color: red;'>❌ No admin accounts found!</p>";
        
        echo "<h3>Creating Default Admin Account:</h3>";
        
        // Create default admin
        $username = 'admin';
        $password = 'Test@12345';
        $hashedPassword = md5($password);
        
        $stmt = $pdo->prepare("INSERT INTO admin (UserName, Password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            echo "<p style='color: green;'>✅ Default admin account created!</p>";
            echo "<p><strong>Username:</strong> {$username}</p>";
            echo "<p><strong>Password:</strong> {$password}</p>";
        } else {
            echo "<p style='color: red;'>❌ Failed to create admin account</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database Error: " . $e->getMessage() . "</p>";
    echo "<p>Make sure XAMPP MySQL is running and database is imported.</p>";
}

echo "<hr>";
echo "<h3>📋 Admin Login Steps:</h3>";
echo "<ol>";
echo "<li>Make sure XAMPP is running: <code>sudo /opt/lampp/lampp start</code></li>";
echo "<li>Go to: <a href='http://localhost/carrental/admin/' target='_blank'>Admin Login Page</a></li>";
echo "<li>Enter the username and password shown above</li>";
echo "<li>Click LOGIN button</li>";
echo "</ol>";

echo "<h3>🔧 Troubleshooting:</h3>";
echo "<ul>";
echo "<li>If login fails, check database connection</li>";
echo "<li>Password is case-sensitive</li>";
echo "<li>Make sure there are no extra spaces</li>";
echo "<li>Check browser console for JavaScript errors</li>";
echo "</ul>";
?>
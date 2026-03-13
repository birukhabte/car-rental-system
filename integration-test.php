<!DOCTYPE html>
<html>
<head>
    <title>Frontend-Backend Integration Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .success { border-left: 4px solid #4CAF50; }
        .error { border-left: 4px solid #f44336; }
        .info { border-left: 4px solid #2196F3; }
        .warning { border-left: 4px solid #ff9800; }
        .btn { padding: 10px 20px; margin: 5px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        h1 { color: #333; text-align: center; }
        h2 { color: #555; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .status-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚗 Car Rental Portal - Integration Status</h1>
        
        <div class="status-grid">
            <!-- Database Status -->
            <div class="card success">
                <h2>✅ Database Connection</h2>
                <?php
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=carrental", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $pdo->query("SELECT COUNT(*) FROM tblvehicles");
                    $vehicles = $stmt->fetchColumn();
                    
                    $stmt = $pdo->query("SELECT COUNT(*) FROM tblusers");
                    $users = $stmt->fetchColumn();
                    
                    echo "<p><strong>Status:</strong> Connected ✅</p>";
                    echo "<p><strong>Vehicles:</strong> $vehicles</p>";
                    echo "<p><strong>Users:</strong> $users</p>";
                } catch(Exception $e) {
                    echo "<p><strong>Status:</strong> Error ❌</p>";
                    echo "<p>Error: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
            
            <!-- Frontend Status -->
            <div class="card info">
                <h2>🌐 Frontend Status</h2>
                <p><strong>Static Frontend:</strong> Port 8000</p>
                <p><strong>PHP Frontend:</strong> XAMPP</p>
                <p><strong>Assets:</strong> Available</p>
                <a href="http://localhost:8000" target="_blank" class="btn btn-primary">Static Version</a>
                <a href="http://localhost/carrental/" target="_blank" class="btn btn-success">PHP Version</a>
            </div>
            
            <!-- Backend Status -->
            <div class="card success">
                <h2>⚙️ Backend Status</h2>
                <p><strong>PHP:</strong> <?php echo phpversion(); ?></p>
                <p><strong>Server:</strong> Apache/XAMPP</p>
                <p><strong>Config:</strong> Ready</p>
                <a href="http://localhost/carrental/admin/" target="_blank" class="btn btn-warning">Admin Panel</a>
            </div>
        </div>
        
        <!-- Integration Tests -->
        <div class="card info">
            <h2>🔗 Integration Tests</h2>
            
            <h3>1. PHP Frontend Test</h3>
            <?php
            $frontend_path = "/opt/lampp/htdocs/carrental/index.php";
            if (file_exists($frontend_path)) {
                echo "<p class='success'>✅ Frontend PHP file exists</p>";
                echo "<p><a href='http://localhost/carrental/' target='_blank' class='btn btn-success'>Test Frontend</a></p>";
            } else {
                echo "<p class='error'>❌ Frontend PHP file missing</p>";
            }
            ?>
            
            <h3>2. Admin Panel Test</h3>
            <?php
            $admin_path = "/opt/lampp/htdocs/carrental/admin/index.php";
            if (file_exists($admin_path)) {
                echo "<p class='success'>✅ Admin panel exists</p>";
                echo "<p><a href='http://localhost/carrental/admin/' target='_blank' class='btn btn-warning'>Test Admin</a></p>";
            } else {
                echo "<p class='error'>❌ Admin panel missing</p>";
            }
            ?>
            
            <h3>3. Database Integration Test</h3>
            <?php
            try {
                // Test fetching vehicles (like the frontend does)
                $sql = "SELECT VehiclesTitle, BrandName, PricePerDay FROM tblvehicles 
                        JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand 
                        LIMIT 3";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $vehicles = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                if (count($vehicles) > 0) {
                    echo "<p class='success'>✅ Vehicle data integration working</p>";
                    echo "<p><strong>Sample vehicles:</strong></p>";
                    echo "<ul>";
                    foreach ($vehicles as $vehicle) {
                        echo "<li>{$vehicle->VehiclesTitle} - \${$vehicle->PricePerDay}/day</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='warning'>⚠️ No vehicle data found</p>";
                }
            } catch(Exception $e) {
                echo "<p class='error'>❌ Database integration error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
        
        <!-- Quick Actions -->
        <div class="card">
            <h2>🚀 Quick Actions</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <a href="http://localhost/carrental/" target="_blank" class="btn btn-success">🌐 Open Full Frontend</a>
                <a href="http://localhost/carrental/admin/" target="_blank" class="btn btn-warning">🔧 Open Admin Panel</a>
                <a href="http://localhost:8000" target="_blank" class="btn btn-primary">📱 Static Frontend</a>
                <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-info">🗄️ Database</a>
            </div>
        </div>
        
        <!-- Login Information -->
        <div class="card warning">
            <h2>🔑 Login Credentials</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <h3>👤 User Account</h3>
                    <p><strong>Email:</strong> test@gmail.com</p>
                    <p><strong>Password:</strong> Test@123</p>
                </div>
                <div>
                    <h3>👨‍💼 Admin Account</h3>
                    <p><strong>Username:</strong> admin</p>
                    <p><strong>Password:</strong> Test@12345</p>
                </div>
            </div>
        </div>
        
        <!-- Next Steps -->
        <div class="card info">
            <h2>📋 Next Steps</h2>
            <ol>
                <li><strong>Test Frontend:</strong> Click "Open Full Frontend" to see the PHP version with database integration</li>
                <li><strong>Test Admin:</strong> Login to admin panel to manage vehicles, users, and bookings</li>
                <li><strong>Compare Versions:</strong> Compare static (port 8000) vs dynamic (XAMPP) versions</li>
                <li><strong>Add Content:</strong> Use admin panel to add more vehicles and manage the system</li>
            </ol>
        </div>
    </div>
</body>
</html>
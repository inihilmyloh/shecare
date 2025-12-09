<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Database Connection Test</h3>";

// Test langsung dengan kredensial
$host = 'localhost';
$db = 'mifmyho2_shecare';
$user = 'mifmyho2_shecare';
$pass = 'MIF@2025';

echo "Trying to connect to:<br>";
echo "Host: $host<br>";
echo "Database: $db<br>";
echo "User: $user<br>";
echo "Password: " . str_repeat('*', strlen($pass)) . "<br><br>";

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ <b>Connection Successful!</b><br>";

    // Test query
    $stmt = $conn->query("SELECT DATABASE() as db_name, VERSION() as version");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Connected to: " . $result['db_name'] . "<br>";
    echo "MySQL Version: " . $result['version'] . "<br>";

    // List tables
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<br>Tables found: " . count($tables) . "<br>";
    if (count($tables) > 0) {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
    }
} catch (PDOException $e) {
    echo "❌ <b>Connection Failed!</b><br>";
    echo "Error Code: " . $e->getCode() . "<br>";
    echo "Error Message: " . $e->getMessage() . "<br>";

    // Common errors
    if ($e->getCode() == 1045) {
        echo "<br><b>Suggestion:</b> Username atau password salah.<br>";
    } elseif ($e->getCode() == 1049) {
        echo "<br><b>Suggestion:</b> Database tidak ditemukan.<br>";
    } elseif ($e->getCode() == 2002) {
        echo "<br><b>Suggestion:</b> MySQL server tidak running atau host salah.<br>";
    }
}

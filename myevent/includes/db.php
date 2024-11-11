<?php
$host = 'localhost';
$dbname = 'myevent_db'; // Your database name
$username = 'root'; // Your username (default is 'root' for XAMPP)
$password = ''; // Your password (default is empty for XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>

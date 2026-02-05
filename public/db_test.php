<?php
header('Content-Type: text/plain');

$host = 'mysql-19fd1f7a-shajinsajeev33-9959.g.aivencloud.com';
$port = '26596';
$user = 'avnadmin';
$pass = 'AVNS_jIiB9S_WSZbP7Rr8NwK';
$db   = 'defaultdb';

echo "Testing connection to $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "SUCCESS: Connected to the database successfully!\n";

    $stmt = $pdo->query("SELECT VERSION() as version");
    $row = $stmt->fetch();
    echo "MySQL Version: " . $row['version'] . "\n";
} catch (\PDOException $e) {
    echo "ERROR: Connection failed!\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}

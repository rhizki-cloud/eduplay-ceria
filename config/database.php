<?php
require_once __DIR__ . '/config.php';

function db(): ?PDO
{
    static $pdo = false;

    if ($pdo !== false) {
        return $pdo;
    }

    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: '3306';
    $name = getenv('DB_NAME') ?: 'eduplay_ceria';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';

    try {
        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => 10,
        ]);
    } catch (Throwable $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}

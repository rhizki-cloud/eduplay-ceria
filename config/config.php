<?php
$documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
$projectRoot = realpath(__DIR__ . '/..');
$baseUrl = '';
if ($documentRoot && $projectRoot && str_starts_with(str_replace('\\', '/', $projectRoot), str_replace('\\', '/', $documentRoot))) {
    $baseUrl = str_replace('\\', '/', substr($projectRoot, strlen($documentRoot)));
}
define('BASE_URL', rtrim($baseUrl, '/'));
define('APP_NAME', 'EduPlay Ceria');
define('APP_TAGLINE', 'Belajar, Bermain, Bertumbuh');
date_default_timezone_set('Asia/Jakarta');

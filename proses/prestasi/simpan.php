<?php
require_once __DIR__.'/../../config/config.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../config/session.php';
require_once __DIR__.'/../../config/helper.php';
require_once __DIR__.'/../../config/auth.php';
header('Content-Type: application/json; charset=utf-8');

$user = current_user();
if (!$user) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'message'=>'Silakan login terlebih dahulu.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?: [];
$type = trim((string)($data['type'] ?? 'Permainan'));
$score = max(0, min(100, (int)($data['score'] ?? 0)));
$pdo = db();

if (!$pdo) {
    http_response_code(503);
    echo json_encode(['ok'=>false,'message'=>'Database belum terhubung.']);
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO nilai (user_id,jenis,skor,created_at) VALUES (?,?,?,NOW())');
    $stmt->execute([(int)$user['id'], mb_substr($type, 0, 120), $score]);
    log_activity($pdo, (int)$user['id'], 'Menyelesaikan '.$type.' dengan skor '.$score);
    echo json_encode(['ok'=>true]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok'=>false,'message'=>'Nilai gagal disimpan.']);
}

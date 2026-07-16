<?php
function e(mixed $value): string { return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8'); }
function url(string $path=''): string { return BASE_URL . '/' . ltrim($path, '/'); }
function redirect(string $path): never { header('Location: ' . url($path)); exit; }
function flash(string $key, ?string $value=null): ?string {
    if ($value !== null) { $_SESSION['_flash'][$key]=$value; return null; }
    $out=$_SESSION['_flash'][$key]??null; unset($_SESSION['_flash'][$key]); return $out;
}
function csrf_token(): string {
    if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['_csrf'];
}
function csrf_field(): string {
    return '<input type="hidden" name="_csrf" value="'.e(csrf_token()).'">';
}
function verify_csrf(): void {
    $token = (string)($_POST['_csrf'] ?? '');
    if ($token === '' || !hash_equals((string)($_SESSION['_csrf'] ?? ''), $token)) {
        http_response_code(419);
        exit('Permintaan kedaluwarsa atau tidak valid. Muat ulang halaman lalu coba lagi.');
    }
}
function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text) ?? '';
    return trim($text, '-') ?: 'item-'.time();
}
function format_date_id(?string $date): string {
    if (!$date) return '-';
    $timestamp = strtotime($date);
    return $timestamp ? date('d/m/Y H:i', $timestamp) : $date;
}
function log_activity(?PDO $pdo, ?int $userId, string $activity): void {
    if (!$pdo) return;
    try {
        $stmt = $pdo->prepare('INSERT INTO log_aktivitas(user_id,aktivitas,created_at) VALUES(?,?,NOW())');
        $stmt->execute([$userId, mb_substr($activity, 0, 255)]);
    } catch (Throwable $e) {
        // Logging tidak boleh menggagalkan proses utama.
    }
}

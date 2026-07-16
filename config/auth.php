<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helper.php';

function current_user(): ?array {
    if (!empty($_SESSION['user']) && is_array($_SESSION['user'])) return $_SESSION['user'];

    // Kompatibilitas sesi versi lama saat proyek diperbarui tanpa logout lebih dahulu.
    if (!empty($_SESSION['admin']) && is_array($_SESSION['admin'])) {
        $_SESSION['user'] = [
            'id' => (int)($_SESSION['admin']['id'] ?? 0),
            'name' => (string)($_SESSION['admin']['name'] ?? 'Administrator'),
            'username' => (string)($_SESSION['admin']['username'] ?? 'admin'),
            'role' => 'admin',
        ];
        unset($_SESSION['admin']);
        return $_SESSION['user'];
    }
    return null;
}

function login_user(array $row): void {
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int)$row['id'],
        'name' => (string)$row['nama'],
        'username' => (string)$row['username'],
        'role' => (string)$row['role'],
    ];
}

function is_logged_in(): bool { return current_user() !== null; }
function is_admin(): bool { return (current_user()['role'] ?? '') === 'admin'; }
function is_student(): bool { return (current_user()['role'] ?? '') === 'siswa'; }

function require_login(array $roles = []): void {
    $user = current_user();
    if (!$user) {
        $next = $_SERVER['REQUEST_URI'] ?? '';
        $query = $next !== '' ? '?next='.rawurlencode($next) : '';
        header('Location: ' . url('login.php') . $query);
        exit;
    }
    if ($roles && !in_array($user['role'], $roles, true)) {
        redirect($user['role'] === 'admin' ? 'admin/dashboard.php' : 'index.php');
    }
}

function require_admin(): void { require_login(['admin']); }
function require_student(): void { require_login(['siswa']); }

function safe_next_path(?string $next, string $fallback): string {
    $next = trim((string)$next);
    if ($next === '' || str_contains($next, '://') || str_starts_with($next, '//')) return $fallback;
    $base = BASE_URL ?: '';
    if ($base !== '' && str_starts_with($next, $base.'/')) return ltrim(substr($next, strlen($base)), '/');
    if (str_starts_with($next, '/')) return ltrim($next, '/');
    return ltrim($next, '/');
}

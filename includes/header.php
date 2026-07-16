<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/helper.php';
require_once __DIR__ . '/../config/auth.php';
require_login(['siswa','admin']);
$currentUser = current_user();
$pageTitle = $pageTitle ?? APP_NAME;
$activeNav = $activeNav ?? '';
$showBack = $showBack ?? false;
$backUrl = $backUrl ?? 'index.php';
$pageKicker = $pageKicker ?? 'Petualangan Belajar';
$bodyClass = $bodyClass ?? '';
if (!preg_match('~^(?:https?:)?/~', $backUrl)) $backUrl = url($backUrl);
$learningActive = in_array($activeNav, ['materi', 'numerasi', 'sehat', 'karakter'], true);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#ffca3a">
<meta name="description" content="EduPlay Ceria — belajar numerasi, hidup sehat, dan karakter melalui materi serta permainan interaktif.">
<title><?= e($pageTitle) ?> · <?= APP_NAME ?></title>
<link rel="manifest" href="<?= url('manifest.json') ?>">
<link rel="icon" href="<?= url('assets/icon/app-icon.svg') ?>">
<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= url('assets/css/responsive.css') ?>">
</head>
<body class="<?= e($bodyClass) ?>">
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
<div class="app-shell">
<aside class="desktop-sidebar" aria-label="Navigasi utama desktop">
    <a class="brand" href="<?= url('index.php') ?>" aria-label="EduPlay Ceria, kembali ke beranda">
        <span class="brand-mark" aria-hidden="true">🚀</span>
        <span><strong>EduPlay</strong><small>Ceria</small></span>
    </a>

    <nav class="side-nav">
        <a class="<?= $activeNav === 'home' ? 'active' : '' ?>" href="<?= url('index.php') ?>"><span>🏠</span><b>Beranda</b></a>
        <a class="<?= $learningActive ? 'active' : '' ?>" href="<?= url('materi/index.php') ?>"><span>📚</span><b>Ruang Belajar</b></a>
        <div class="side-subnav" aria-label="Kategori pelajaran">
            <a class="<?= $activeNav === 'numerasi' ? 'active' : '' ?>" href="<?= url('materi/numerasi/index.php') ?>">🔢 Numerasi</a>
            <a class="<?= $activeNav === 'sehat' ? 'active' : '' ?>" href="<?= url('materi/sehat/index.php') ?>">🥗 Hidup Sehat</a>
            <a class="<?= $activeNav === 'karakter' ? 'active' : '' ?>" href="<?= url('materi/karakter/index.php') ?>">🌟 Karakter</a>
        </div>
        <a class="<?= $activeNav === 'permainan' ? 'active' : '' ?>" href="<?= url('permainan/index.php') ?>"><span>🎮</span><b>Zona Bermain</b></a>
        <a class="<?= $activeNav === 'prestasi' ? 'active' : '' ?>" href="<?= url('prestasi/index.php') ?>"><span>🏆</span><b>Prestasi</b></a>
        <a class="<?= $activeNav === 'tentang' ? 'active' : '' ?>" href="<?= url('tentang/index.php') ?>"><span>💡</span><b>Tentang</b></a>
        <?php if (is_admin()): ?><a href="<?= url('admin/dashboard.php') ?>"><span>🧑‍💻</span><b>Panel Admin</b></a><?php endif; ?>
    </nav>

    <div class="side-motivation">
        <span class="motivation-stars" aria-hidden="true">✨ ⭐ ✨</span>
        <strong>Hebat hari ini!</strong>
        <p>Selesaikan 3 aktivitas untuk membuka bintang harian.</p>
        <div class="mini-progress" aria-label="Target aktivitas harian"><span data-daily-progress></span></div>
        <small><b data-daily-count>0</b>/3 aktivitas</small>
    </div>

    <div class="student-account">
      <a class="student-account-card" href="<?= url('prestasi/index.php') ?>">
        <span class="avatar"><?= is_admin() ? '🧑‍💻' : '🧒' ?></span>
        <span><strong><?= e($currentUser['name'] ?? '') ?></strong><small><?= e(ucfirst($currentUser['role'] ?? 'siswa')) ?> · @<?= e($currentUser['username'] ?? '') ?></small></span>
      </a>
      <a class="student-logout" href="<?= url('logout.php') ?>">Keluar dari akun</a>
    </div>
</aside>

<div class="app-main">
<header class="topbar">
    <div class="topbar-leading">
        <?php if ($showBack): ?>
            <a class="icon-btn back-btn" href="<?= e($backUrl) ?>" aria-label="Kembali">←</a>
        <?php else: ?>
            <a class="mobile-brand" href="<?= url('index.php') ?>" aria-label="EduPlay Ceria"><span>🚀</span></a>
        <?php endif; ?>
        <div class="page-heading">
            <small><?= e($pageKicker) ?></small>
            <h1><?= e($pageTitle) ?></h1>
        </div>
    </div>
    <div class="topbar-actions">
        <button class="icon-btn sound-btn" type="button" data-sound-toggle aria-label="Aktifkan atau nonaktifkan suara">🔊</button>
        <a class="profile-pill" href="<?= is_admin() ? url('admin/dashboard.php') : url('prestasi/index.php') ?>" aria-label="Lihat akun">
            <span class="profile-avatar"><?= is_admin() ? '🧑‍💻' : '🧒' ?></span>
            <span><small><?= is_admin() ? 'Admin' : 'Siswa' ?></small><b class="topbar-user-name"><?= e($currentUser['name'] ?? '') ?></b></span>
            <span class="profile-star">⭐</span>
        </a>
    </div>
</header>
<main class="app-content" id="main-content">

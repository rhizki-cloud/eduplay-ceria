<?php
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../config/session.php';
require_once __DIR__.'/../config/helper.php';
require_once __DIR__.'/../config/auth.php';
require_admin();
$adminPageTitle = $adminPageTitle ?? 'Panel Admin';
$adminPageDescription = $adminPageDescription ?? 'Kelola EduPlay Ceria.';
$adminActive = $adminActive ?? '';
$adminUser = current_user();
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#27345d">
<title><?= e($adminPageTitle) ?> · Admin EduPlay Ceria</title>
<link rel="icon" href="<?= url('assets/icon/app-icon.svg') ?>">
<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= url('assets/css/admin.css') ?>">
<link rel="stylesheet" href="<?= url('assets/css/responsive.css') ?>">
</head>
<body class="admin-body">
<div class="admin-app">
  <?php include __DIR__.'/admin_sidebar.php'; ?>
  <div class="admin-main">
    <header class="admin-topbar">
      <div class="admin-mobile-brand"><span>🚀</span><b>EduPlay Admin</b></div>
      <div class="admin-topbar-copy"><small>Panel Pengelola</small><h1><?= e($adminPageTitle) ?></h1><p><?= e($adminPageDescription) ?></p></div>
      <div class="admin-topbar-actions">
        <a class="admin-icon-link" href="<?= url('index.php') ?>" title="Lihat sisi siswa">🌈</a>
        <a class="admin-profile-chip" href="<?= url('admin/profile/index.php') ?>"><span>🧑‍💻</span><span><small>Admin</small><b><?= e($adminUser['name'] ?? '') ?></b></span></a>
      </div>
    </header>
    <details class="admin-mobile-menu">
      <summary>☰ Menu Admin</summary>
      <div class="admin-mobile-menu-panel"><?php include __DIR__.'/admin_sidebar.php'; ?></div>
    </details>
    <main class="admin-content">
      <?php if ($success = flash('success')): ?><div class="notice success" role="status"><?= e($success) ?></div><?php endif; ?>
      <?php if ($error = flash('error')): ?><div class="notice" role="alert"><?= e($error) ?></div><?php endif; ?>

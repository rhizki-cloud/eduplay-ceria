<?php
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/config/session.php';
require_once __DIR__.'/config/helper.php';
require_once __DIR__.'/config/auth.php';

if (is_logged_in()) {
    redirect(is_admin() ? 'admin/dashboard.php' : 'index.php');
}

$error = '';
$username = '';
$selectedRole = ($_GET['role'] ?? 'siswa') === 'admin' ? 'admin' : 'siswa';
$next = (string)($_GET['next'] ?? $_POST['next'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = strtolower(trim((string)($_POST['username'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    $selectedRole = ($_POST['role'] ?? 'siswa') === 'admin' ? 'admin' : 'siswa';
    $pdo = db();

    if (!$pdo) {
        $error = 'Database belum terhubung. Impor file database/database.sql melalui phpMyAdmin terlebih dahulu.';
    } elseif ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare('SELECT id,nama,username,password,role FROM users WHERE username=? AND role=? LIMIT 1');
        $stmt->execute([$username, $selectedRole]);
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password'])) {
            login_user($row);
            log_activity($pdo, (int)$row['id'], 'Login sebagai '.$row['role']);
            $fallback = $row['role'] === 'admin' ? 'admin/dashboard.php' : 'index.php';
            redirect(safe_next_path($next, $fallback));
        }
        $error = 'Akun tidak ditemukan atau password salah. Periksa juga jenis akun yang dipilih.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#ffca3a">
<title>Masuk · EduPlay Ceria</title>
<link rel="icon" href="<?= url('assets/icon/app-icon.svg') ?>">
<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= url('assets/css/responsive.css') ?>">
</head>
<body class="login-page">
<main class="login-shell auth-shell">
  <section class="login-visual">
    <a class="brand" href="<?= url('login.php') ?>"><span class="brand-mark">🚀</span><span><strong>EduPlay</strong><small>Ceria</small></span></a>
    <div class="login-illustration" aria-hidden="true"><?= $selectedRole === 'admin' ? '🧑‍💻' : '🧒' ?></div>
    <div><h2>Belajar dan mengelola dalam satu ruang ceria.</h2><p>Siswa dapat belajar serta menyimpan nilai. Admin dapat mengelola akun, materi, dan laporan.</p></div>
  </section>
  <section class="login-form">
    <span class="eyebrow">🔐 Masuk ke EduPlay</span>
    <h1>Selamat Datang</h1>
    <p>Pilih jenis akun lalu masukkan username dan password.</p>

    <?php if ($error): ?><div class="notice" role="alert"><?= e($error) ?></div><?php endif; ?>
    <?php if ($message = flash('success')): ?><div class="notice success" role="status"><?= e($message) ?></div><?php endif; ?>

    <form method="post" autocomplete="on">
      <?= csrf_field() ?>
      <input type="hidden" name="next" value="<?= e($next) ?>">
      <div class="role-picker" aria-label="Pilih jenis akun">
        <label class="role-option">
          <input type="radio" name="role" value="siswa" <?= $selectedRole === 'siswa' ? 'checked' : '' ?>>
          <span><b>🧒 Siswa</b><small>Belajar dan bermain</small></span>
        </label>
        <label class="role-option">
          <input type="radio" name="role" value="admin" <?= $selectedRole === 'admin' ? 'checked' : '' ?>>
          <span><b>🧑‍💻 Admin</b><small>Kelola aplikasi</small></span>
        </label>
      </div>

      <label for="username">Username</label>
      <input id="username" name="username" value="<?= e($username) ?>" autocomplete="username" required maxlength="80" placeholder="Masukkan username">

      <label for="password">Password</label>
      <div class="password-wrap">
        <input id="password" type="password" name="password" autocomplete="current-password" required placeholder="Masukkan password">
        <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Tampilkan password">👁️</button>
      </div>

      <button class="big-btn blue" style="width:100%;margin-top:18px" type="submit">Masuk Sekarang</button>
    </form>

    <div class="login-help student-register-help">
      Belum punya akun siswa? <a href="<?= url('register.php') ?>"><strong>Daftar akun siswa</strong></a>.<br>
      Akun admin baru hanya dapat dibuat oleh admin yang sudah masuk.
    </div>
  </section>
</main>
<script>
document.querySelectorAll('[data-password-toggle]').forEach(btn=>btn.addEventListener('click',()=>{
  const input=document.getElementById(btn.dataset.passwordToggle);
  input.type=input.type==='password'?'text':'password';
  btn.textContent=input.type==='password'?'👁️':'🙈';
}));
document.querySelectorAll('input[name="role"]').forEach(r=>r.addEventListener('change',()=>{
  document.querySelector('.login-illustration').textContent=r.value==='admin'?'🧑‍💻':'🧒';
}));
</script>
</body>
</html>

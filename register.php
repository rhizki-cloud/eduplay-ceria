<?php
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/config/session.php';
require_once __DIR__.'/config/helper.php';
require_once __DIR__.'/config/auth.php';

if (is_logged_in()) redirect(is_admin() ? 'admin/dashboard.php' : 'index.php');

$errors = [];
$data = ['nama'=>'','username'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $data['nama'] = trim((string)($_POST['nama'] ?? ''));
    $data['username'] = strtolower(trim((string)($_POST['username'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['password_confirmation'] ?? '');
    $pdo = db();

    if (!$pdo) $errors[] = 'Database belum terhubung. Impor database/database.sql terlebih dahulu.';
    if (mb_strlen($data['nama']) < 3 || mb_strlen($data['nama']) > 120) $errors[] = 'Nama harus terdiri dari 3 sampai 120 karakter.';
    if (!preg_match('/^[a-z0-9._-]{4,30}$/', $data['username'])) $errors[] = 'Username harus 4–30 karakter dan hanya boleh berisi huruf kecil, angka, titik, garis bawah, atau tanda minus.';
    if (strlen($password) < 8) $errors[] = 'Password minimal 8 karakter.';
    if ($password !== $confirm) $errors[] = 'Konfirmasi password tidak sama.';

    if (!$errors && $pdo) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username=? LIMIT 1');
        $check->execute([$data['username']]);
        if ($check->fetch()) {
            $errors[] = 'Username sudah digunakan. Pilih username lain.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO users(nama,username,password,role,created_at) VALUES(?,?,?,'siswa',NOW())");
            $stmt->execute([$data['nama'], $data['username'], password_hash($password, PASSWORD_DEFAULT)]);
            $userId = (int)$pdo->lastInsertId();
            log_activity($pdo, $userId, 'Mendaftar sebagai siswa');
            flash('success', 'Pendaftaran berhasil. Silakan masuk menggunakan akun siswa yang baru dibuat.');
            redirect('login.php?role=siswa');
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#ffca3a">
<title>Daftar Siswa · EduPlay Ceria</title>
<link rel="icon" href="<?= url('assets/icon/app-icon.svg') ?>">
<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= url('assets/css/responsive.css') ?>">
</head>
<body class="login-page">
<main class="login-shell auth-shell register-shell">
  <section class="login-visual register-visual">
    <a class="brand" href="<?= url('login.php') ?>"><span class="brand-mark">🚀</span><span><strong>EduPlay</strong><small>Ceria</small></span></a>
    <div class="login-illustration" aria-hidden="true">🌟</div>
    <div><h2>Buat akun dan mulai petualangan belajar.</h2><p>Nilai permainan dan aktivitas belajar akan tersimpan berdasarkan akun siswa.</p></div>
  </section>
  <section class="login-form">
    <span class="eyebrow">📝 Pendaftaran Siswa</span>
    <h1>Buat Akun Baru</h1>
    <p>Formulir ini hanya membuat akun dengan peran siswa.</p>

    <?php if ($errors): ?>
      <div class="notice" role="alert"><strong>Pendaftaran belum berhasil.</strong><ul class="error-list"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>

    <form method="post" autocomplete="on">
      <?= csrf_field() ?>
      <label for="nama">Nama Lengkap</label>
      <input id="nama" name="nama" value="<?= e($data['nama']) ?>" required maxlength="120" placeholder="Contoh: Budi Santoso">

      <label for="username">Username</label>
      <input id="username" name="username" value="<?= e($data['username']) ?>" required minlength="4" maxlength="30" pattern="[a-z0-9._-]+" placeholder="Contoh: budi.santoso">
      <small class="field-help">Gunakan huruf kecil, angka, titik, garis bawah, atau tanda minus.</small>

      <label for="password">Password</label>
      <div class="password-wrap">
        <input id="password" type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter">
        <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Tampilkan password">👁️</button>
      </div>

      <label for="password_confirmation">Ulangi Password</label>
      <div class="password-wrap">
        <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" placeholder="Ketik ulang password">
        <button type="button" class="password-toggle" data-password-toggle="password_confirmation" aria-label="Tampilkan password">👁️</button>
      </div>

      <button class="big-btn blue" style="width:100%;margin-top:18px" type="submit">Daftar sebagai Siswa</button>
    </form>
    <a class="login-back" href="<?= url('login.php?role=siswa') ?>">← Sudah punya akun? Masuk</a>
  </section>
</main>
<script>
document.querySelectorAll('[data-password-toggle]').forEach(btn=>btn.addEventListener('click',()=>{
  const input=document.getElementById(btn.dataset.passwordToggle);
  input.type=input.type==='password'?'text':'password';
  btn.textContent=input.type==='password'?'👁️':'🙈';
}));
</script>
</body>
</html>

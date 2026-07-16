<?php
require_once __DIR__.'/../../config/auth.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../config/helper.php';
require_admin();
$pdo = db();
$errors = [];
$data = ['nama'=>'','username'=>'','role'=>in_array($_GET['role'] ?? '', ['admin','siswa'], true) ? $_GET['role'] : 'siswa'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $data['nama'] = trim((string)($_POST['nama'] ?? ''));
    $data['username'] = strtolower(trim((string)($_POST['username'] ?? '')));
    $data['role'] = in_array($_POST['role'] ?? '', ['admin','siswa'], true) ? $_POST['role'] : 'siswa';
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['password_confirmation'] ?? '');
    if (!$pdo) $errors[] = 'Database belum terhubung.';
    if (mb_strlen($data['nama']) < 3 || mb_strlen($data['nama']) > 120) $errors[] = 'Nama harus 3–120 karakter.';
    if (!preg_match('/^[a-z0-9._-]{4,30}$/', $data['username'])) $errors[] = 'Username harus 4–30 karakter dengan huruf kecil, angka, titik, garis bawah, atau tanda minus.';
    if (strlen($password) < 8) $errors[] = 'Password minimal 8 karakter.';
    if ($password !== $confirm) $errors[] = 'Konfirmasi password tidak sama.';
    if (!$errors && $pdo) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username=?');$check->execute([$data['username']]);
        if ($check->fetch()) $errors[] = 'Username sudah digunakan.';
        else {
            $stmt = $pdo->prepare('INSERT INTO users(nama,username,password,role,created_at) VALUES(?,?,?,?,NOW())');
            $stmt->execute([$data['nama'],$data['username'],password_hash($password,PASSWORD_DEFAULT),$data['role']]);
            log_activity($pdo, (int)current_user()['id'], 'Menambahkan akun '.$data['role'].' @'.$data['username']);
            flash('success', 'Akun '.ucfirst($data['role']).' berhasil ditambahkan.');
            redirect('admin/user/index.php');
        }
    }
}
$adminPageTitle = 'Tambah Pengguna';
$adminPageDescription = 'Buat akun siswa atau administrator baru.';
$adminActive = 'user';
include __DIR__.'/../../includes/admin_header.php';
?>
<section class="admin-card admin-form-card">
  <div class="admin-card-head"><div><h2>Data Akun Baru</h2><p>Administrator dapat membuat akun siswa maupun admin.</p></div></div>
  <?php if ($errors): ?><div class="notice"><ul class="error-list"><?php foreach($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
  <form class="admin-form" method="post" autocomplete="off">
    <?= csrf_field() ?>
    <div class="admin-form-grid">
      <div class="field-full"><label for="nama">Nama Lengkap</label><input id="nama" name="nama" value="<?= e($data['nama']) ?>" required maxlength="120"></div>
      <div><label for="username">Username</label><input id="username" name="username" value="<?= e($data['username']) ?>" required maxlength="30" pattern="[a-z0-9._-]+"><small class="field-help">Huruf kecil, angka, titik, garis bawah, atau minus.</small></div>
      <div><label for="role">Jenis Akun</label><select id="role" name="role"><option value="siswa" <?= $data['role']==='siswa'?'selected':'' ?>>Siswa</option><option value="admin" <?= $data['role']==='admin'?'selected':'' ?>>Administrator</option></select></div>
      <div><label for="password">Password</label><input id="password" type="password" name="password" required minlength="8" autocomplete="new-password"></div>
      <div><label for="password_confirmation">Ulangi Password</label><input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password"></div>
    </div>
    <div class="admin-form-note">Akun admin memiliki akses penuh ke panel pengelolaan. Berikan peran administrator hanya kepada pengguna yang berwenang.</div>
    <div class="admin-form-actions"><button class="btn" type="submit">Simpan Pengguna</button><a class="btn ghost" href="<?= url('admin/user/index.php') ?>">Batal</a></div>
  </form>
</section>
<?php include __DIR__.'/../../includes/admin_footer.php'; ?>

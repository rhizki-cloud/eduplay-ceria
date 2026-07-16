<?php
require_once __DIR__.'/../../config/auth.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../config/helper.php';
require_admin();
$pdo = db();
$id = max(0, (int)($_GET['id'] ?? $_POST['id'] ?? 0));
if (!$pdo || !$id) { flash('error','Pengguna tidak ditemukan.'); redirect('admin/user/index.php'); }
$stmt = $pdo->prepare('SELECT id,nama,username,role,created_at FROM users WHERE id=?');$stmt->execute([$id]);$row=$stmt->fetch();
if (!$row) { flash('error','Pengguna tidak ditemukan.'); redirect('admin/user/index.php'); }
$errors=[];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    verify_csrf();
    $nama=trim((string)($_POST['nama']??''));$username=strtolower(trim((string)($_POST['username']??'')));
    $role=in_array($_POST['role']??'', ['admin','siswa'], true)?$_POST['role']:'siswa';
    if (mb_strlen($nama)<3 || mb_strlen($nama)>120) $errors[]='Nama harus 3–120 karakter.';
    if (!preg_match('/^[a-z0-9._-]{4,30}$/',$username)) $errors[]='Format username tidak valid.';
    $check=$pdo->prepare('SELECT id FROM users WHERE username=? AND id<>?');$check->execute([$username,$id]);if($check->fetch())$errors[]='Username sudah digunakan.';
    if ((int)$id === (int)current_user()['id'] && $role!=='admin') $errors[]='Anda tidak dapat mengubah peran akun sendiri menjadi siswa.';
    if ($row['role']==='admin' && $role!=='admin') {
        $adminCount=(int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
        if($adminCount<=1)$errors[]='Administrator terakhir tidak dapat diubah menjadi siswa.';
    }
    if(!$errors){$up=$pdo->prepare('UPDATE users SET nama=?,username=?,role=? WHERE id=?');$up->execute([$nama,$username,$role,$id]);
      if($id===(int)current_user()['id']){$_SESSION['user']['name']=$nama;$_SESSION['user']['username']=$username;}
      log_activity($pdo,(int)current_user()['id'],'Mengubah akun @'.$username);flash('success','Data pengguna berhasil diperbarui.');redirect('admin/user/index.php');}
    $row=array_merge($row,['nama'=>$nama,'username'=>$username,'role'=>$role]);
}
$adminPageTitle='Edit Pengguna';$adminPageDescription='Perbarui identitas dan peran akun.';$adminActive='user';include __DIR__.'/../../includes/admin_header.php';
?>
<section class="admin-card admin-form-card"><div class="admin-card-head"><div><h2>Edit <?= e($row['nama']) ?></h2><p>Akun dibuat <?= e(format_date_id($row['created_at'])) ?>.</p></div></div>
<?php if($errors):?><div class="notice"><ul class="error-list"><?php foreach($errors as $error):?><li><?=e($error)?></li><?php endforeach;?></ul></div><?php endif;?>
<form class="admin-form" method="post"><?=csrf_field()?><input type="hidden" name="id" value="<?=$id?>"><div class="admin-form-grid"><div class="field-full"><label>Nama Lengkap</label><input name="nama" value="<?=e($row['nama'])?>" required></div><div><label>Username</label><input name="username" value="<?=e($row['username'])?>" required pattern="[a-z0-9._-]+"></div><div><label>Jenis Akun</label><select name="role"><option value="siswa" <?=$row['role']==='siswa'?'selected':''?>>Siswa</option><option value="admin" <?=$row['role']==='admin'?'selected':''?>>Administrator</option></select></div></div><div class="admin-form-actions"><button class="btn">Simpan Perubahan</button><a class="btn ghost" href="<?=url('admin/user/index.php')?>">Batal</a></div></form></section>
<?php include __DIR__.'/../../includes/admin_footer.php'; ?>

<?php
require_once __DIR__.'/../../config/auth.php';require_once __DIR__.'/../../config/database.php';require_once __DIR__.'/../../config/helper.php';require_admin();
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Metode tidak diizinkan.');}verify_csrf();$pdo=db();$id=max(0,(int)($_POST['id']??0));
if(!$pdo||!$id){flash('error','Pengguna tidak ditemukan.');redirect('admin/user/index.php');}
if($id===(int)current_user()['id']){flash('error','Akun yang sedang digunakan tidak dapat dihapus.');redirect('admin/user/index.php');}
$s=$pdo->prepare('SELECT nama,username,role FROM users WHERE id=?');$s->execute([$id]);$row=$s->fetch();if(!$row){flash('error','Pengguna tidak ditemukan.');redirect('admin/user/index.php');}
if($row['role']==='admin' && (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn()<=1){flash('error','Administrator terakhir tidak dapat dihapus.');redirect('admin/user/index.php');}
$d=$pdo->prepare('DELETE FROM users WHERE id=?');$d->execute([$id]);log_activity($pdo,(int)current_user()['id'],'Menghapus akun '.$row['role'].' @'.$row['username']);flash('success','Akun '.$row['nama'].' berhasil dihapus.');redirect('admin/user/index.php');

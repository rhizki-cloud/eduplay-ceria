<?php
$adminActive = $adminActive ?? '';
$adminUser = current_user();
$adminItems = [
    ['dashboard','📊','Dashboard','admin/dashboard.php'],
    ['user','👥','Pengguna','admin/user/index.php'],
    ['kategori','🗂️','Kategori','admin/kategori/index.php'],
    ['materi','📚','Materi','admin/materi/index.php'],
    ['permainan','🎮','Permainan','admin/permainan/index.php'],
    ['quiz','❓','Kuis','admin/quiz/index.php'],
    ['prestasi','🏆','Prestasi','admin/prestasi/index.php'],
    ['laporan','📈','Laporan','admin/laporan/index.php'],
    ['setting','⚙️','Pengaturan','admin/setting/index.php'],
];
?>
<aside class="admin-sidebar">
  <a class="admin-brand" href="<?= url('admin/dashboard.php') ?>">
    <span class="admin-brand-mark">🚀</span>
    <span><strong>EduPlay</strong><small>Panel Admin</small></span>
  </a>

  <nav class="admin-menu" aria-label="Navigasi administrator">
    <?php foreach ($adminItems as [$key,$icon,$label,$path]): ?>
      <a class="<?= $adminActive === $key ? 'active' : '' ?>" href="<?= url($path) ?>"><span><?= $icon ?></span><b><?= e($label) ?></b></a>
    <?php endforeach; ?>
  </nav>

  <div class="admin-account-card">
    <span class="admin-avatar">🧑‍💻</span>
    <div><strong><?= e($adminUser['name'] ?? 'Administrator') ?></strong><small>@<?= e($adminUser['username'] ?? 'admin') ?></small></div>
  </div>
  <div class="admin-sidebar-actions">
    <a href="<?= url('admin/profile/index.php') ?>">👤 Profil</a>
    <a href="<?= url('index.php') ?>">🌈 Lihat Siswa</a>
    <a class="danger-link" href="<?= url('logout.php') ?>">↪ Keluar</a>
  </div>
</aside>

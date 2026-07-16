<?php
require_once __DIR__.'/../config/auth.php';
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../config/helper.php';
require_admin();
$pdo = db();
$stats = ['siswa'=>0,'admin'=>0,'materi'=>0,'nilai'=>0];
$latestUsers = [];
$latestScores = [];
if ($pdo) {
    try {
        $stats['siswa'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='siswa'")->fetchColumn();
        $stats['admin'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
        $stats['materi'] = (int)$pdo->query("SELECT COUNT(*) FROM materi WHERE status='publish'")->fetchColumn();
        $stats['nilai'] = (int)$pdo->query('SELECT COUNT(*) FROM nilai')->fetchColumn();
        $latestUsers = $pdo->query('SELECT id,nama,username,role,created_at FROM users ORDER BY id DESC LIMIT 6')->fetchAll();
        $latestScores = $pdo->query('SELECT n.skor,n.jenis,n.created_at,u.nama FROM nilai n LEFT JOIN users u ON u.id=n.user_id ORDER BY n.id DESC LIMIT 6')->fetchAll();
    } catch (Throwable $e) {}
}
$adminPageTitle = 'Dashboard';
$adminPageDescription = 'Ringkasan akun, materi, dan aktivitas belajar terbaru.';
$adminActive = 'dashboard';
include __DIR__.'/../includes/admin_header.php';
?>
<?php if (!$pdo): ?><div class="notice warning">Database belum terhubung. Impor <code>database/database.sql</code> melalui phpMyAdmin agar seluruh data admin aktif.</div><?php endif; ?>

<section class="admin-grid" aria-label="Ringkasan data">
  <div class="admin-stat sun"><span class="admin-stat-icon">🧒</span><strong><?= $stats['siswa'] ?></strong><span>Akun siswa</span></div>
  <div class="admin-stat"><span class="admin-stat-icon">🧑‍💻</span><strong><?= $stats['admin'] ?></strong><span>Administrator</span></div>
  <div class="admin-stat mint"><span class="admin-stat-icon">📚</span><strong><?= $stats['materi'] ?></strong><span>Materi terbit</span></div>
  <div class="admin-stat coral"><span class="admin-stat-icon">⭐</span><strong><?= $stats['nilai'] ?></strong><span>Nilai tersimpan</span></div>
</section>

<section class="admin-card" style="margin-top:18px">
  <div class="admin-card-head"><div><h2>Akses Cepat</h2><p>Tugas pengelolaan yang paling sering digunakan.</p></div></div>
  <div class="admin-quick-grid">
    <a class="admin-quick-link" href="<?= url('admin/user/tambah.php?role=siswa') ?>"><span>➕</span><span><strong>Tambah Siswa</strong><small>Buat akun siswa dari panel admin</small></span></a>
    <a class="admin-quick-link" href="<?= url('admin/user/tambah.php?role=admin') ?>"><span>🛡️</span><span><strong>Tambah Admin</strong><small>Buat administrator baru</small></span></a>
    <a class="admin-quick-link" href="<?= url('admin/materi/tambah.php') ?>"><span>📝</span><span><strong>Tambah Materi</strong><small>Publikasikan bahan belajar</small></span></a>
  </div>
</section>

<div class="admin-columns">
  <section class="admin-card">
    <div class="admin-card-head"><div><h2>Pengguna Terbaru</h2><p>Akun yang paling baru dibuat.</p></div><a class="text-link" href="<?= url('admin/user/index.php') ?>">Lihat semua →</a></div>
    <?php if ($latestUsers): ?>
      <div class="admin-table-wrap"><table><thead><tr><th>Pengguna</th><th>Peran</th><th>Dibuat</th></tr></thead><tbody>
      <?php foreach ($latestUsers as $row): ?><tr><td><div class="admin-row-title"><span class="admin-row-avatar"><?= $row['role']==='admin'?'🧑‍💻':'🧒' ?></span><span><strong><?= e($row['nama']) ?></strong><small>@<?= e($row['username']) ?></small></span></div></td><td><span class="role-badge <?= e($row['role']) ?>"><?= e(ucfirst($row['role'])) ?></span></td><td><?= e(format_date_id($row['created_at'])) ?></td></tr><?php endforeach; ?>
      </tbody></table></div>
    <?php else: ?><div class="admin-empty"><span>👥</span><strong>Belum ada data pengguna</strong><small>Hubungkan database atau tambahkan akun baru.</small></div><?php endif; ?>
  </section>

  <section class="admin-card">
    <div class="admin-card-head"><div><h2>Nilai Terbaru</h2><p>Aktivitas siswa yang baru selesai.</p></div></div>
    <?php if ($latestScores): ?><div class="activity-list">
      <?php foreach ($latestScores as $row): ?><div class="activity-item"><span class="activity-icon">⭐</span><span><strong><?= e($row['nama'] ?: 'Pengguna dihapus') ?></strong><small><?= e($row['jenis']) ?> · <?= e(format_date_id($row['created_at'])) ?></small></span><span class="score"><?= (int)$row['skor'] ?></span></div><?php endforeach; ?>
    </div><?php else: ?><div class="admin-empty"><span>⭐</span><strong>Belum ada nilai</strong><small>Nilai akan muncul setelah siswa menyelesaikan permainan.</small></div><?php endif; ?>
  </section>
</div>
<?php include __DIR__.'/../includes/admin_footer.php'; ?>

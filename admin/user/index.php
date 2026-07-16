<?php
require_once __DIR__.'/../../config/auth.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../config/helper.php';
require_admin();
$pdo = db();
$q = trim((string)($_GET['q'] ?? ''));
$role = in_array($_GET['role'] ?? '', ['admin','siswa'], true) ? $_GET['role'] : '';
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$rows = [];
$total = 0;
$counts = ['all'=>0,'admin'=>0,'siswa'=>0];
if ($pdo) {
    $where = [];
    $params = [];
    if ($q !== '') { $where[] = '(nama LIKE ? OR username LIKE ?)'; $params[] = "%$q%"; $params[] = "%$q%"; }
    if ($role !== '') { $where[] = 'role=?'; $params[] = $role; }
    $whereSql = $where ? ' WHERE '.implode(' AND ', $where) : '';
    $countStmt = $pdo->prepare('SELECT COUNT(*) FROM users'.$whereSql);
    $countStmt->execute($params);
    $total = (int)$countStmt->fetchColumn();
    $offset = ($page - 1) * $perPage;
    $stmt = $pdo->prepare('SELECT id,nama,username,role,created_at FROM users'.$whereSql.' ORDER BY id DESC LIMIT '.$perPage.' OFFSET '.$offset);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    $counts['all'] = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $counts['admin'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
    $counts['siswa'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='siswa'")->fetchColumn();
}
$totalPages = max(1, (int)ceil($total / $perPage));
$adminPageTitle = 'Kelola Pengguna';
$adminPageDescription = 'Tambah siswa atau administrator, ubah akun, dan atur password.';
$adminActive = 'user';
include __DIR__.'/../../includes/admin_header.php';
?>
<section class="admin-grid" style="grid-template-columns:repeat(3,minmax(0,1fr));margin-bottom:18px">
  <div class="admin-stat"><span class="admin-stat-icon">👥</span><strong><?= $counts['all'] ?></strong><span>Semua pengguna</span></div>
  <div class="admin-stat sun"><span class="admin-stat-icon">🧑‍💻</span><strong><?= $counts['admin'] ?></strong><span>Administrator</span></div>
  <div class="admin-stat mint"><span class="admin-stat-icon">🧒</span><strong><?= $counts['siswa'] ?></strong><span>Siswa</span></div>
</section>

<section class="admin-card">
  <div class="admin-toolbar">
    <form class="admin-search" method="get">
      <input name="q" value="<?= e($q) ?>" placeholder="Cari nama atau username">
      <?php if ($role): ?><input type="hidden" name="role" value="<?= e($role) ?>"><?php endif; ?>
      <button class="btn ghost" type="submit">Cari</button>
    </form>
    <div class="admin-toolbar-group">
      <a class="btn ghost" href="<?= url('admin/user/index.php') ?>">Semua</a>
      <a class="btn ghost" href="<?= url('admin/user/index.php?role=siswa') ?>">Siswa</a>
      <a class="btn ghost" href="<?= url('admin/user/index.php?role=admin') ?>">Admin</a>
      <a class="btn outline" href="<?= url('admin/user/export.php') ?>">Unduh CSV</a>
      <a class="btn" href="<?= url('admin/user/tambah.php') ?>">+ Tambah Pengguna</a>
    </div>
  </div>

  <?php if (!$pdo): ?><div class="notice warning">Database belum terhubung.</div><?php elseif ($rows): ?>
  <div class="admin-table-wrap"><table><thead><tr><th>Pengguna</th><th>Peran</th><th>Tanggal dibuat</th><th>Aksi</th></tr></thead><tbody>
  <?php foreach ($rows as $row): ?><tr>
    <td><div class="admin-row-title"><span class="admin-row-avatar"><?= $row['role']==='admin'?'🧑‍💻':'🧒' ?></span><span><strong><?= e($row['nama']) ?></strong><small>@<?= e($row['username']) ?></small></span></div></td>
    <td><span class="role-badge <?= e($row['role']) ?>"><?= e(ucfirst($row['role'])) ?></span></td>
    <td><?= e(format_date_id($row['created_at'])) ?></td>
    <td><div class="table-actions">
      <a href="<?= url('admin/user/detail.php?id='.$row['id']) ?>">Detail</a>
      <a href="<?= url('admin/user/edit.php?id='.$row['id']) ?>">Edit</a>
      <a href="<?= url('admin/user/reset-password.php?id='.$row['id']) ?>">Password</a>
      <?php if ((int)$row['id'] !== (int)(current_user()['id'] ?? 0)): ?>
      <form class="inline-form" method="post" action="<?= url('admin/user/hapus.php') ?>" onsubmit="return confirm('Hapus akun <?= e(addslashes($row['nama'])) ?>?')"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$row['id'] ?>"><button class="danger" type="submit">Hapus</button></form>
      <?php endif; ?>
    </div></td>
  </tr><?php endforeach; ?>
  </tbody></table></div>
  <?php if ($totalPages > 1): ?><nav class="pagination" aria-label="Paginasi"><?php for ($i=1;$i<=$totalPages;$i++): ?><a class="<?= $i===$page?'active':'' ?>" href="?<?= http_build_query(['q'=>$q,'role'=>$role,'page'=>$i]) ?>"><?= $i ?></a><?php endfor; ?></nav><?php endif; ?>
  <?php else: ?><div class="admin-empty"><span>🔎</span><strong>Pengguna tidak ditemukan</strong><small>Ubah kata pencarian atau buat akun baru.</small></div><?php endif; ?>
</section>
<?php include __DIR__.'/../../includes/admin_footer.php'; ?>

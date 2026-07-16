<?php
$pageTitle='Ruang Belajar';
$pageKicker='Pilih Jalur Belajarmu';
$activeNav='materi';
$showBack=true;
$backUrl='index.php';
include __DIR__.'/../includes/header.php';
?>

<section class="module-banner numerasi">
  <div>
    <span class="eyebrow">📚 Materi Kelas 4–6</span>
    <h2>Satu ruang untuk belajar dengan caramu sendiri.</h2>
    <p>Pilih topik, baca materi singkat, lalu lanjutkan dengan permainan agar konsepnya semakin mudah diingat.</p>
    <div class="stack inline"><a class="btn yellow" href="<?= url('materi/numerasi/index.php') ?>">Mulai dari Numerasi</a><a class="btn outline" href="<?= url('permainan/index.php') ?>">Lihat Permainan</a></div>
  </div>
  <div class="module-banner-visual" aria-hidden="true">📚✨</div>
</section>

<div class="section-head"><div><h2 class="section-title">Jalur Pembelajaran</h2><p class="section-subtitle">Setiap jalur memiliki materi, latihan, dan tantangan yang berbeda.</p></div></div>
<div class="learning-grid">
  <a class="learning-card numerasi" href="<?= url('materi/numerasi/index.php') ?>">
    <span class="card-decoration"></span><span class="card-icon">🧮</span><h3>Numerasi Seru</h3>
    <p>Bilangan, operasi hitung, pecahan, pengukuran, bangun datar, skala, dan pemecahan masalah.</p>
    <div class="card-footer"><span>Kelas 4, 5, dan 6</span><span class="card-arrow">→</span></div>
  </a>
  <a class="learning-card sehat" href="<?= url('materi/sehat/index.php') ?>">
    <span class="card-decoration"></span><span class="card-icon">🍎</span><h3>Pola Hidup Sehat</h3>
    <p>Sarapan, cuci tangan, makanan bergizi, air putih, olahraga, dan kebiasaan harian yang baik.</p>
    <div class="card-footer"><span>5 topik pilihan</span><span class="card-arrow">→</span></div>
  </a>
  <a class="learning-card karakter" href="<?= url('materi/karakter/index.php') ?>">
    <span class="card-decoration"></span><span class="card-icon">🌟</span><h3>Karakter Hebat</h3>
    <p>Cerita interaktif tentang disiplin, kejujuran, tanggung jawab, dan keberanian memilih yang benar.</p>
    <div class="card-footer"><span>3 nilai utama</span><span class="card-arrow">→</span></div>
  </a>
</div>

<div class="section-head"><div><h2 class="section-title">Cara Belajar di EduPlay</h2><p class="section-subtitle">Ikuti tiga langkah sederhana agar belajar terasa ringan.</p></div></div>
<div class="lesson-grid">
  <div class="lesson-card"><span class="icon">👀</span><strong>1. Baca dan Amati</strong><small>Pelajari contoh yang dekat dengan kehidupan sehari-hari.</small></div>
  <div class="lesson-card"><span class="icon">🎮</span><strong>2. Coba dan Mainkan</strong><small>Gunakan permainan untuk melatih pemahaman tanpa terasa seperti ujian.</small></div>
  <div class="lesson-card"><span class="icon">🏆</span><strong>3. Kumpulkan Prestasi</strong><small>Simpan skor, naik level, dan buka badge saat target tercapai.</small></div>
</div>

<div class="content-card accent center">
  <div style="font-size:52px" aria-hidden="true">💡</div>
  <h2>Tips Belajar Ceria</h2>
  <p class="muted">Belajar 10–15 menit secara rutin lebih baik daripada belajar lama tetapi hanya sesekali.</p>
  <a class="action-btn" href="<?= url('permainan/index.php') ?>">Coba Tantangan Singkat</a>
</div>
<?php include __DIR__.'/../includes/footer.php'; ?>

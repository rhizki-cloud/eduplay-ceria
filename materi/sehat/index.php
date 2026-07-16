<?php
$pageTitle='Pola Hidup Sehat';
$pageKicker='Tubuh Kuat • Hati Ceria';
$activeNav='sehat';
$showBack=true;
$backUrl='materi/index.php';
include __DIR__.'/../../includes/header.php';
?>
<section class="module-banner sehat">
  <div><span class="eyebrow">🥗 Kebiasaan Baik Setiap Hari</span><h2>Jaga tubuh agar selalu kuat dan siap belajar.</h2><p>Kenali makanan bergizi, cara menjaga kebersihan, pentingnya air putih, dan aktivitas yang membuat tubuh bugar.</p><div class="stack inline"><a class="btn success" href="<?= url('permainan/sehat.php') ?>">🍎 Main Pilih Makanan</a><a class="btn outline" href="#materi-sehat">Baca Materi</a></div></div>
  <div class="module-banner-visual" aria-hidden="true">🏃‍♀️🍎</div>
</section>

<div class="section-head"><div><h2 class="section-title">Latihan Interaktif</h2><p class="section-subtitle">Belajar memilih kebiasaan yang membuat tubuh sehat.</p></div></div>
<div class="game-grid">
  <a class="game-card" href="<?= url('permainan/sehat.php') ?>"><span class="game-icon">🥗</span><span><strong>Pilih Makanan Sehat</strong><small>Kenali makanan bergizi</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('quiz/sehat.php') ?>"><span class="game-icon">🍽️</span><span><strong>Menu Gizi Seimbang</strong><small>Susun pilihan makan terbaik</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('materi/sehat/kebiasaan.php') ?>"><span class="game-icon">🧼</span><span><strong>Kebiasaan Harian</strong><small>Simulasi hidup bersih</small></span><span class="play-dot">▶</span></a>
</div>

<div class="section-head" id="materi-sehat"><div><h2 class="section-title">Materi Pilihan</h2><p class="section-subtitle">Pilih satu topik untuk dipelajari hari ini.</p></div></div>
<div class="lesson-grid">
  <a class="lesson-card" href="<?= url('materi/sehat/sarapan.php') ?>"><span class="icon">🥣</span><strong>Sarapan</strong><small>Energi untuk memulai hari dan fokus belajar.</small></a>
  <a class="lesson-card" href="<?= url('materi/sehat/cuci-tangan.php') ?>"><span class="icon">🧼</span><strong>Cuci Tangan</strong><small>Langkah sederhana mencegah kuman masuk ke tubuh.</small></a>
  <a class="lesson-card" href="<?= url('materi/sehat/makanan-bergizi.php') ?>"><span class="icon">🥦</span><strong>Makanan Bergizi</strong><small>Kenali isi piring yang seimbang dan beragam.</small></a>
  <a class="lesson-card" href="<?= url('materi/sehat/air-putih.php') ?>"><span class="icon">💧</span><strong>Air Putih</strong><small>Cukupi cairan agar tubuh tetap segar.</small></a>
  <a class="lesson-card" href="<?= url('materi/sehat/olahraga.php') ?>"><span class="icon">🏃</span><strong>Olahraga</strong><small>Bergerak aktif untuk tulang, otot, dan suasana hati.</small></a>
  <a class="lesson-card" href="<?= url('materi/sehat/kebiasaan.php') ?>"><span class="icon">🌞</span><strong>Rutinitas Sehat</strong><small>Gabungkan kebiasaan baik sepanjang hari.</small></a>
</div>
<?php include __DIR__.'/../../includes/footer.php'; ?>

<?php
$pageTitle='Zona Bermain';
$pageKicker='Main • Latihan • Naik Level';
$activeNav='permainan';
$showBack=true;
$backUrl='index.php';
include __DIR__.'/../includes/header.php';
?>
<section class="home-hero" style="min-height:300px;background:linear-gradient(135deg,#8b7cf6,#aa9eff 55%,#d7d1ff)">
  <div class="hero-copy"><span class="eyebrow">🎮 Belajar Lewat Permainan</span><h2 style="font-size:clamp(34px,4.6vw,54px)">Pilih tantangan dan pecahkan skor terbaikmu!</h2><p style="color:#fff">Setiap permainan melatih kemampuan berbeda: berhitung, mengingat, mencocokkan, mengenali gambar, dan memilih sikap baik.</p></div>
  <div class="hero-visual" aria-hidden="true"><div class="hero-planet" style="background:linear-gradient(145deg,#fff6c8,#ffd55d)"></div><span class="orbit-item one">🏆</span><span class="orbit-item two">🧠</span><span class="orbit-item three">⭐</span><div class="hero-mascot">🕹️</div></div>
</section>

<div class="section-head"><div><h2 class="section-title">Semua Permainan</h2><p class="section-subtitle">Mulai dari permainan mudah, lalu coba tantangan yang lebih tinggi.</p></div></div>
<div class="game-grid">
  <a class="game-card" href="<?= url('permainan/numerasi.php') ?>"><span class="game-icon">➕</span><span><strong>Kuis Aritmatika</strong><small>Hitung cepat • 10 soal • mudah</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/memory.php') ?>"><span class="game-icon">🧠</span><span><strong>Memory Ceria</strong><small>Cari pasangan • 8 pasang • sedang</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/sehat.php') ?>"><span class="game-icon">🥗</span><span><strong>Makanan Sehat</strong><small>Pilih makanan • 9 pilihan • mudah</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/tebak-gambar.php') ?>"><span class="game-icon">🖼️</span><span><strong>Tebak Gambar</strong><small>Kenali objek • 8 soal • mudah</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/matching.php') ?>"><span class="game-icon">🧩</span><span><strong>Mencocokkan</strong><small>Pasangkan konsep • 5 pasang • sedang</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/puzzle.php') ?>"><span class="game-icon">🔢</span><span><strong>Urutan Angka</strong><small>Susun pola • 5 ronde • sedang</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/karakter.php') ?>"><span class="game-icon">🤝</span><span><strong>Pilihan Baik</strong><small>Cerita karakter • 3 situasi • mudah</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/pilihan-ganda.php') ?>"><span class="game-icon">❓</span><span><strong>Kuis Pengetahuan</strong><small>Campuran materi • 8 soal • sedang</small></span><span class="play-dot">▶</span></a>
</div>

<div class="section-head"><div><h2 class="section-title">Perkembanganmu</h2><p class="section-subtitle">Ringkasan permainan yang tersimpan di perangkat ini.</p></div><a class="text-link" href="<?= url('prestasi/index.php') ?>">Buka prestasi →</a></div>
<section class="quick-stats">
  <div class="quick-stat"><span class="stat-icon">🎮</span><div><strong data-stat-sessions>0</strong><small>permainan selesai</small></div></div>
  <div class="quick-stat"><span class="stat-icon">⭐</span><div><strong data-stat-points>0</strong><small>poin terkumpul</small></div></div>
  <div class="quick-stat"><span class="stat-icon">🏆</span><div><strong data-stat-best>0</strong><small>skor terbaik</small></div></div>
  <div class="quick-stat"><span class="stat-icon">🔥</span><div><strong data-stat-streak>0</strong><small>hari beruntun</small></div></div>
</section>

<div class="content-card sky center"><div style="font-size:48px">🧘</div><h2>Ingat untuk Beristirahat</h2><p class="muted">Setelah bermain 15–20 menit, istirahatkan mata, berdiri, dan minum air putih.</p></div>
<?php include __DIR__.'/../includes/footer.php'; ?>

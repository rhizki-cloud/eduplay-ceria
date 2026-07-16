<?php
$pageTitle='Beranda Ceria';
$pageKicker='Halo, Penjelajah Hebat';
$activeNav='home';
include __DIR__.'/includes/header.php';
?>

<section class="home-hero" aria-labelledby="hero-title">
  <div class="hero-copy">
    <span class="eyebrow">🌈 Belajar Jadi Lebih Seru</span>
    <h2 id="hero-title"><span data-greeting>Selamat datang!</span> Siap jadi anak hebat?</h2>
    <p>Pilih petualangan belajar, kumpulkan poin, buka badge baru, dan tumbuh bersama EduPlay Ceria.</p>
    <div class="hero-actions">
      <a class="action-btn" href="<?= url('materi/index.php') ?>">📚 Mulai Belajar</a>
      <a class="action-btn secondary" href="<?= url('permainan/index.php') ?>">🎮 Main Sekarang</a>
    </div>
  </div>
  <div class="hero-visual" aria-hidden="true">
    <div class="hero-planet"></div>
    <span class="hero-cloud a">☁️</span><span class="hero-cloud b">☁️</span>
    <span class="orbit-item one">🔢</span>
    <span class="orbit-item two">🌱</span>
    <span class="orbit-item three">⭐</span>
    <div class="hero-mascot">🧑‍🚀</div>
  </div>
</section>

<section class="quick-stats" aria-label="Ringkasan perkembangan belajar">
  <div class="quick-stat"><span class="stat-icon">🔥</span><div><strong data-stat-streak>0</strong><small>hari beruntun</small></div></div>
  <div class="quick-stat"><span class="stat-icon">⭐</span><div><strong data-stat-points>0</strong><small>total poin</small></div></div>
  <div class="quick-stat"><span class="stat-icon">🎮</span><div><strong data-stat-sessions>0</strong><small>aktivitas selesai</small></div></div>
  <div class="quick-stat"><span class="stat-icon">🏆</span><div><strong data-stat-best>0</strong><small>skor terbaik</small></div></div>
</section>

<div class="dashboard-grid">
  <section>
    <div class="section-head">
      <div><h2 class="section-title">Pilih Petualangan Belajar</h2><p class="section-subtitle">Tiga jalur belajar yang dibuat ringan, ceria, dan mudah dipahami.</p></div>
      <a class="text-link" href="<?= url('materi/index.php') ?>">Lihat semua →</a>
    </div>
    <div class="learning-grid">
      <a class="learning-card numerasi" href="<?= url('materi/numerasi/index.php') ?>">
        <span class="card-decoration"></span><span class="card-icon">🧮</span>
        <h3>Numerasi Seru</h3><p>Berhitung, pecahan, pengukuran, dan tantangan logika untuk kelas 4–6.</p>
        <div class="card-footer"><span>6 materi • 4 permainan</span><span class="card-arrow">→</span></div>
      </a>
      <a class="learning-card sehat" href="<?= url('materi/sehat/index.php') ?>">
        <span class="card-decoration"></span><span class="card-icon">🥦</span>
        <h3>Hidup Sehat</h3><p>Kenali makanan bergizi, kebiasaan bersih, olahraga, dan tubuh yang kuat.</p>
        <div class="card-footer"><span>5 materi • 2 permainan</span><span class="card-arrow">→</span></div>
      </a>
      <a class="learning-card karakter" href="<?= url('materi/karakter/index.php') ?>">
        <span class="card-decoration"></span><span class="card-icon">🌟</span>
        <h3>Karakter Hebat</h3><p>Belajar disiplin, jujur, bertanggung jawab, dan berani memilih yang baik.</p>
        <div class="card-footer"><span>3 cerita • 1 simulasi</span><span class="card-arrow">→</span></div>
      </a>
    </div>
  </section>

  <aside>
    <div class="section-head"><div><h2 class="section-title">Misi Hari Ini</h2><p class="section-subtitle">Sedikit demi sedikit, kamu pasti bisa.</p></div></div>
    <div class="mission-card">
      <div class="mission-top"><div><h3>Bintang Harian</h3><p>Selesaikan 3 aktivitas belajar atau permainan.</p></div><span class="mission-icon">🎯</span></div>
      <div class="mission-progress"><span data-daily-progress></span></div>
      <div class="mission-meta"><span><b data-daily-count>0</b> dari 3 selesai</span><span>Target 100%</span></div>
      <div class="mission-reward"><span>🎁</span><div>Hadiah: badge <strong>Pejuang Harian</strong></div></div>
    </div>

    <div class="continue-card">
      <h3>Lanjutkan Petualangan</h3><p>Ulangi aktivitas terakhir dan pecahkan skor terbaikmu.</p>
      <a class="continue-row" data-continue-link href="<?= url('permainan/numerasi.php') ?>">
        <span class="continue-icon" data-continue-icon>🔢</span>
        <span><strong data-continue-title>Kuis Aritmatika</strong><small data-continue-meta>Mulai latihan pertamamu</small></span>
        <span class="card-arrow">→</span>
      </a>
    </div>
  </aside>
</div>

<section>
  <div class="section-head">
    <div><h2 class="section-title">Permainan Favorit</h2><p class="section-subtitle">Latihan singkat untuk mengasah ingatan, logika, dan kebiasaan baik.</p></div>
    <a class="text-link" href="<?= url('permainan/index.php') ?>">Buka zona bermain →</a>
  </div>
  <div class="game-grid">
    <a class="game-card" href="<?= url('permainan/numerasi.php') ?>"><span class="game-icon">➕</span><span><strong>Kuis Aritmatika</strong><small>10 soal hitung cepat</small></span><span class="play-dot">▶</span></a>
    <a class="game-card" href="<?= url('permainan/memory.php') ?>"><span class="game-icon">🧠</span><span><strong>Memory Ceria</strong><small>Cari pasangan kartu</small></span><span class="play-dot">▶</span></a>
    <a class="game-card" href="<?= url('permainan/sehat.php') ?>"><span class="game-icon">🥗</span><span><strong>Makanan Sehat</strong><small>Pilih makanan bergizi</small></span><span class="play-dot">▶</span></a>
    <a class="game-card" href="<?= url('permainan/tebak-gambar.php') ?>"><span class="game-icon">🖼️</span><span><strong>Tebak Gambar</strong><small>Kenali benda dan hewan</small></span><span class="play-dot">▶</span></a>
    <a class="game-card" href="<?= url('permainan/matching.php') ?>"><span class="game-icon">🧩</span><span><strong>Mencocokkan</strong><small>Pasangkan kata dan gambar</small></span><span class="play-dot">▶</span></a>
    <a class="game-card" href="<?= url('permainan/karakter.php') ?>"><span class="game-icon">🤝</span><span><strong>Pilihan Baik</strong><small>Latih karakter hebat</small></span><span class="play-dot">▶</span></a>
  </div>
</section>

<section>
  <div class="section-head">
    <div><h2 class="section-title">Aktivitas Terbaru</h2><p class="section-subtitle">Semua nilai tersimpan otomatis di perangkat ini.</p></div>
    <a class="text-link" href="<?= url('prestasi/index.php') ?>">Lihat prestasi →</a>
  </div>
  <div class="activity-list" data-recent-activities></div>
</section>

<script>
if('serviceWorker' in navigator){navigator.serviceWorker.register('<?= url('service-worker.js') ?>').catch(()=>{})}
</script>
<?php include __DIR__.'/includes/footer.php'; ?>

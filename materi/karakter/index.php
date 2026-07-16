<?php
$pageTitle='Karakter Hebat';
$pageKicker='Berani Baik Setiap Hari';
$activeNav='karakter';
$showBack=true;
$backUrl='materi/index.php';
include __DIR__.'/../../includes/header.php';
?>
<section class="module-banner karakter">
  <div><span class="eyebrow">🌟 Aku Anak Hebat</span><h2>Kebiasaan baik tumbuh dari pilihan kecil.</h2><p>Ikuti cerita, pikirkan akibatnya, lalu pilih tindakan yang menunjukkan disiplin, kejujuran, dan tanggung jawab.</p><div class="stack inline"><a class="btn" href="<?= url('permainan/karakter.php') ?>">🤝 Mulai Cerita</a><a class="btn outline" href="#nilai-karakter">Kenali Nilainya</a></div></div>
  <div class="module-banner-visual" aria-hidden="true">👧📚👦</div>
</section>

<div class="section-head" id="nilai-karakter"><div><h2 class="section-title">Nilai Karakter Utama</h2><p class="section-subtitle">Baca cerita singkat dan praktikkan dalam kehidupan sehari-hari.</p></div></div>
<div class="lesson-grid">
  <a class="lesson-card" href="<?= url('materi/karakter/disiplin.php') ?>"><span class="icon">⏰</span><strong>Belajar Disiplin</strong><small>Melakukan hal baik tepat waktu tanpa harus selalu diingatkan.</small></a>
  <a class="lesson-card" href="<?= url('materi/karakter/jujur.php') ?>"><span class="icon">🤝</span><strong>Berani Jujur</strong><small>Berkata dan bertindak sesuai kenyataan meski terasa sulit.</small></a>
  <a class="lesson-card" href="<?= url('materi/karakter/tanggung-jawab.php') ?>"><span class="icon">🛡️</span><strong>Tanggung Jawab</strong><small>Menyelesaikan tugas serta menerima akibat dari pilihan sendiri.</small></a>
</div>

<div class="section-head"><div><h2 class="section-title">Coba Dalam Cerita</h2><p class="section-subtitle">Pilih tindakan terbaik dalam situasi yang dekat dengan keseharianmu.</p></div></div>
<div class="content-card accent center"><div style="font-size:65px" aria-hidden="true">📖✨</div><h2>Cerita Interaktif: Pilihan Baik</h2><p class="muted">Tiga situasi, tiga keputusan, dan satu tujuan: menjadi anak yang dapat dipercaya.</p><a class="big-btn yellow" href="<?= url('permainan/karakter.php') ?>">Mulai Cerita Interaktif</a></div>
<?php include __DIR__.'/../../includes/footer.php'; ?>

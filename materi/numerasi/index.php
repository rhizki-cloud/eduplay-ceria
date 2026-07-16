<?php
$pageTitle='Numerasi Seru';
$pageKicker='Hitung • Pikir • Temukan';
$activeNav='numerasi';
$showBack=true;
$backUrl='materi/index.php';
include __DIR__.'/../../includes/header.php';
?>
<section class="module-banner numerasi">
  <div><span class="eyebrow">🧮 Petualangan Angka</span><h2>Matematika bisa jadi permainan yang menyenangkan!</h2><p>Mulai dari operasi hitung hingga pemecahan masalah. Pilih kelasmu atau langsung coba tantangan cepat.</p><div class="stack inline"><a class="btn yellow" href="<?= url('permainan/numerasi.php') ?>">➕ Mulai Kuis</a><a class="btn outline" href="#pilih-kelas">Pilih Materi</a></div></div>
  <div class="module-banner-visual" aria-hidden="true">🔢🚀</div>
</section>

<div class="section-head"><div><h2 class="section-title">Tantangan Pilihan</h2><p class="section-subtitle">Latihan singkat untuk menghangatkan otak.</p></div><a class="text-link" href="<?= url('permainan/index.php') ?>">Semua permainan →</a></div>
<div class="game-grid">
  <a class="game-card" href="<?= url('permainan/numerasi.php') ?>"><span class="game-icon">➕</span><span><strong>Kuis Aritmatika</strong><small>10 soal acak • 5 menit</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('quiz/numerasi4.php') ?>"><span class="game-icon">🎯</span><span><strong>Tantangan Angka</strong><small>Latihan dasar kelas 4</small></span><span class="play-dot">▶</span></a>
  <a class="game-card" href="<?= url('permainan/puzzle.php') ?>"><span class="game-icon">🧩</span><span><strong>Urutan Angka</strong><small>Susun pola dengan benar</small></span><span class="play-dot">▶</span></a>
</div>

<div class="section-head" id="pilih-kelas"><div><h2 class="section-title">Pilih Materi Kelas</h2><p class="section-subtitle">Materi disusun bertahap sesuai tingkat kesulitan.</p></div></div>
<div class="lesson-grid">
  <a class="lesson-card" href="<?= url('materi/numerasi/kelas4.php') ?>"><span class="icon">4️⃣</span><strong>Kelas 4</strong><small>Bilangan cacah, operasi hitung, pembulatan, dan pengukuran.</small></a>
  <a class="lesson-card" href="<?= url('materi/numerasi/kelas5.php') ?>"><span class="icon">5️⃣</span><strong>Kelas 5</strong><small>Pecahan, faktor, kelipatan, bangun datar, dan perbandingan.</small></a>
  <a class="lesson-card" href="<?= url('materi/numerasi/kelas6.php') ?>"><span class="icon">6️⃣</span><strong>Kelas 6</strong><small>Operasi campuran, skala, bangun ruang, dan soal HOTS.</small></a>
</div>

<div class="section-head"><div><h2 class="section-title">Aktivitas Numerasi Terakhir</h2><p class="section-subtitle">Nilai terbaru dari latihan angka.</p></div></div>
<div class="recent-card"><div><strong data-last-title>Belum ada permainan</strong><small data-last-date>Mulai kuis pertamamu, ya!</small></div><div class="score" data-last-score>0</div></div>
<script>
document.addEventListener('DOMContentLoaded',()=>{const h=window.eduplay.history().find(x=>/Kuis|Angka|Numerasi|Aritmatika|Urutan/i.test(x.type));if(h){document.querySelector('[data-last-title]').textContent=h.type;document.querySelector('[data-last-date]').textContent=new Date(h.date).toLocaleString('id-ID');document.querySelector('[data-last-score]').textContent=h.score}})
</script>
<?php include __DIR__.'/../../includes/footer.php'; ?>

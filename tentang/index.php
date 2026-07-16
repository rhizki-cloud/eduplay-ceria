<?php
$pageTitle='Tentang EduPlay';$pageKicker='Aman • Ceria • Bermanfaat';$activeNav='tentang';$showBack=true;$backUrl='index.php';
include __DIR__.'/../includes/header.php';
?>
<section class="module-banner sehat">
  <div><span class="eyebrow">🚀 Belajar, Bermain, Bertumbuh</span><h2>Ruang belajar digital yang dibuat ramah untuk anak.</h2><p>EduPlay Ceria menggabungkan materi ringkas, permainan interaktif, dan apresiasi perkembangan agar anak terdorong belajar dengan rasa ingin tahu.</p></div>
  <div class="module-banner-visual" aria-hidden="true">🌈🧒</div>
</section>

<div class="section-head"><div><h2 class="section-title">Apa yang Bisa Dilakukan?</h2><p class="section-subtitle">Semua fitur utama dapat digunakan melalui desktop, tablet, maupun ponsel.</p></div></div>
<div class="lesson-grid">
  <div class="lesson-card"><span class="icon">📚</span><strong>Materi Bertahap</strong><small>Numerasi kelas 4–6, pola hidup sehat, dan penguatan karakter.</small></div>
  <div class="lesson-card"><span class="icon">🎮</span><strong>Permainan Interaktif</strong><small>Kuis, memory, mencocokkan, tebak gambar, pola angka, dan cerita pilihan.</small></div>
  <div class="lesson-card"><span class="icon">🏆</span><strong>Prestasi Positif</strong><small>Poin, level, badge, piala, peringkat pribadi, dan sertifikat apresiasi.</small></div>
  <div class="lesson-card"><span class="icon">📱</span><strong>Responsif</strong><small>Tata letak menyesuaikan desktop, tablet, dan mobile tanpa kehilangan fungsi.</small></div>
  <div class="lesson-card"><span class="icon">🔊</span><strong>Umpan Balik Suara</strong><small>Suara ringan dapat diaktifkan atau dimatikan sesuai kebutuhan anak.</small></div>
  <div class="lesson-card"><span class="icon">🛡️</span><strong>Privasi Lokal</strong><small>Riwayat perkembangan utama disimpan di perangkat dan tidak menampilkan data anak lain.</small></div>
</div>

<div class="dashboard-grid" style="margin-top:28px">
  <div class="content-card"><h2>Untuk Anak</h2><p>Tampilan menggunakan warna cerah, tombol besar, arahan singkat, dan penghargaan positif. Anak dapat memilih aktivitas tanpa harus melewati menu yang rumit.</p><h3>Prinsip pengalaman belajar</h3><ul><li>Satu aktivitas memiliki tujuan yang jelas.</li><li>Kesalahan diberi umpan balik tanpa mempermalukan.</li><li>Pencapaian ditunjukkan sebagai kemajuan, bukan tekanan.</li></ul></div>
  <div class="content-card sky"><h2>Untuk Pendamping</h2><p>Orang tua atau guru dapat membuka halaman Prestasi untuk melihat jumlah aktivitas, skor terbaik, poin, serta riwayat latihan pada perangkat tersebut.</p><a class="btn" href="<?= url('prestasi/index.php') ?>">Lihat Perkembangan</a></div>
</div>

<div class="content-card accent center"><div style="font-size:54px">🌱</div><h2>Mulai dari aktivitas kecil hari ini</h2><p class="muted">Satu materi dan satu permainan sudah cukup untuk menjaga kebiasaan belajar tetap menyenangkan.</p><a class="big-btn yellow" href="<?= url('materi/index.php') ?>">Mulai Petualangan</a></div>
<?php include __DIR__.'/../includes/footer.php'; ?>

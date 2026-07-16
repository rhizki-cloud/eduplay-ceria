<?php
$pageTitle='Prestasi Saya';$pageKicker='Poin • Level • Badge';$activeNav='prestasi';$showBack=true;$backUrl='index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro">Setiap aktivitas yang kamu selesaikan akan menambah poin. Terus berlatih untuk naik level dan membuka badge baru.</p>

<section class="level-card">
  <div class="level-badge">🏅</div>
  <div><h2>Penjelajah Level <span data-level-number>1</span></h2><p>Kumpulkan 300 poin untuk naik ke level berikutnya.</p><div class="level-progress"><span data-level-progress></span></div><small style="color:#d7def1"><span data-level-progress-text>0%</span> menuju level berikutnya</small></div>
  <div class="level-points"><strong data-level-points>0</strong><small>TOTAL POIN</small></div>
</section>

<div class="section-head"><div><h2 class="section-title">Ringkasan Perkembangan</h2><p class="section-subtitle">Data tersimpan secara otomatis di perangkat yang digunakan.</p></div></div>
<section class="achievement-summary">
  <div class="achievement-stat"><span>🎮</span><strong data-stat-sessions>0</strong><small>Aktivitas</small></div>
  <div class="achievement-stat"><span>🏆</span><strong data-stat-best>0</strong><small>Skor Terbaik</small></div>
  <div class="achievement-stat"><span>🔥</span><strong data-stat-streak>0</strong><small>Hari Beruntun</small></div>
  <div class="achievement-stat"><span>⭐</span><strong data-stat-points>0</strong><small>Total Poin</small></div>
</section>

<div class="section-head"><div><h2 class="section-title">Koleksi Badge</h2><p class="section-subtitle">Badge berwarna berarti sudah berhasil kamu buka.</p></div><a class="text-link" href="<?= url('prestasi/badge.php') ?>">Detail badge →</a></div>
<div class="badge-grid">
  <div class="badge-card" data-badge="first"><span class="lock">🔒</span><div class="badge-icon">🌱</div><strong>Langkah Pertama</strong><small>Selesaikan 1 aktivitas.</small></div>
  <div class="badge-card" data-badge="80"><span class="lock">🔒</span><div class="badge-icon">🏆</div><strong>Bintang Skor</strong><small>Dapatkan skor 80 atau lebih.</small></div>
  <div class="badge-card" data-badge="three"><span class="lock">🔒</span><div class="badge-icon">🎮</div><strong>Rajin Bermain</strong><small>Selesaikan 3 aktivitas.</small></div>
  <div class="badge-card" data-badge="streak"><span class="lock">🔒</span><div class="badge-icon">🔥</div><strong>Semangat Rutin</strong><small>Belajar 2 hari beruntun.</small></div>
  <div class="badge-card" data-badge="points"><span class="lock">🔒</span><div class="badge-icon">💫</div><strong>Pengumpul Poin</strong><small>Kumpulkan 300 poin.</small></div>
  <div class="badge-card" data-badge="numerasi"><span class="lock">🔒</span><div class="badge-icon">🧮</div><strong>Jago Angka</strong><small>Selesaikan permainan numerasi.</small></div>
  <div class="badge-card" data-badge="sehat"><span class="lock">🔒</span><div class="badge-icon">🥦</div><strong>Anak Sehat</strong><small>Selesaikan permainan sehat.</small></div>
  <div class="badge-card" data-badge="karakter"><span class="lock">🔒</span><div class="badge-icon">🤝</div><strong>Karakter Hebat</strong><small>Selesaikan cerita karakter.</small></div>
</div>

<div class="section-head"><div><h2 class="section-title">Pusat Prestasi</h2><p class="section-subtitle">Lihat koleksi, piala, peringkat lokal, dan sertifikatmu.</p></div></div>
<div class="game-grid">
  <a class="game-card" href="<?= url('prestasi/badge.php') ?>"><span class="game-icon">🏅</span><span><strong>Semua Badge</strong><small>Lihat syarat setiap badge</small></span><span class="play-dot">→</span></a>
  <a class="game-card" href="<?= url('prestasi/trophy.php') ?>"><span class="game-icon">🏆</span><span><strong>Lemari Piala</strong><small>Piala berdasarkan pencapaian</small></span><span class="play-dot">→</span></a>
  <a class="game-card" href="<?= url('prestasi/ranking.php') ?>"><span class="game-icon">📊</span><span><strong>Peringkat Pribadi</strong><small>Bandingkan skor aktivitasmu</small></span><span class="play-dot">→</span></a>
  <a class="game-card" href="<?= url('prestasi/sertifikat.php') ?>"><span class="game-icon">📜</span><span><strong>Sertifikat Ceria</strong><small>Cetak saat target tercapai</small></span><span class="play-dot">→</span></a>
</div>

<div class="section-head"><div><h2 class="section-title">Riwayat Skor</h2><p class="section-subtitle">Aktivitas terbaru ditampilkan paling atas.</p></div><button class="btn ghost" type="button" data-reset-history>Hapus Riwayat</button></div>
<div class="activity-list" data-achievement-history></div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
 const data=window.eduplay.stats(),h=data.history;
 const unlock=(name,condition)=>{if(condition)document.querySelector(`[data-badge="${name}"]`)?.classList.add('unlocked')};
 unlock('first',h.length>0);unlock('80',h.some(x=>Number(x.score)>=80));unlock('three',h.length>=3);unlock('streak',data.streak>=2);unlock('points',data.points>=300);
 unlock('numerasi',h.some(x=>/angka|arit|numerasi|urutan/i.test(x.type)));unlock('sehat',h.some(x=>/sehat|makanan|gizi/i.test(x.type)));unlock('karakter',h.some(x=>/karakter|cerita|pilihan baik/i.test(x.type)));
 const box=document.querySelector('[data-achievement-history]');box.replaceChildren();
 if(!h.length){box.innerHTML='<div class="empty-state content-card"><span class="empty-icon">🏁</span><h3>Belum ada riwayat</h3><p>Selesaikan permainan pertama untuk mulai mengisi halaman prestasi.</p><a class="btn" href="<?= url('permainan/index.php') ?>">Mulai Bermain</a></div>'}
 else h.forEach(item=>{const row=document.createElement('div');row.className='recent-card';const copy=document.createElement('div');const title=document.createElement('strong');title.textContent=item.type;const time=document.createElement('small');time.textContent=new Date(item.date).toLocaleString('id-ID');copy.append(title,time);const score=document.createElement('div');score.className='score';score.textContent=item.score;row.append(copy,score);box.appendChild(row)});
 document.querySelector('[data-reset-history]').addEventListener('click',()=>{if(confirm('Hapus seluruh riwayat skor di perangkat ini?')){window.eduplay.resetProgress();location.reload()}});
});
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

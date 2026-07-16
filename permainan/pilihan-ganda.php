<?php
$pageTitle='Kuis Pengetahuan';$pageKicker='Campuran Materi Ceria';$activeNav='permainan';$showBack=true;$backUrl='permainan/index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro centered">Jawab 10 pertanyaan tentang numerasi, kesehatan, dan karakter.</p>
<section class="game-panel" data-knowledge-game>
  <div class="progress"><span data-knowledge-progress></span></div>
  <div class="game-meta"><span data-knowledge-meta></span><span>❓</span></div>
  <h2 data-knowledge-question style="margin:28px auto;max-width:650px;color:var(--navy)"></h2>
  <div class="answer-grid" data-knowledge-options></div>
  <div class="result-box content-card accent" data-knowledge-result><div style="font-size:58px">🎓✨</div><h2>Kuis selesai!</h2><div class="score" data-knowledge-score>0</div><p class="muted">poin</p><button class="btn" data-knowledge-restart type="button">Coba Lagi</button></div>
</section>
<script>
(()=>{
 const root=document.querySelector('[data-knowledge-game]');const questions=[
 {q:'Hasil dari 8 × 7 adalah ...',a:'56',o:['48','54','56','64']},
 {q:'Sebelum makan, kita sebaiknya ...',a:'Mencuci tangan',o:['Bermain tanah','Mencuci tangan','Tidur','Minum soda']},
 {q:'Mengembalikan barang yang ditemukan adalah sikap ...',a:'Jujur',o:['Malas','Jujur','Boros','Ceroboh']},
 {q:'Setengah dari 20 adalah ...',a:'10',o:['5','8','10','12']},
 {q:'Minuman terbaik untuk menjaga cairan tubuh adalah ...',a:'Air putih',o:['Soda','Sirup','Air putih','Kopi']},
 {q:'Menyelesaikan piket kelas menunjukkan sikap ...',a:'Tanggung jawab',o:['Tanggung jawab','Iri hati','Bohong','Malas']},
 {q:'1 meter sama dengan ... sentimeter.',a:'100',o:['10','50','100','1000']},
 {q:'Olahraga membantu tubuh menjadi ...',a:'Bugar',o:['Lemah','Bugar','Mengantuk','Kotor']},
 {q:'Datang ke sekolah tepat waktu menunjukkan sikap ...',a:'Disiplin',o:['Disiplin','Boros','Ragu','Ceroboh']},
 {q:'Hasil dari 125 + 75 adalah ...',a:'200',o:['180','190','200','210']}
 ];let current=0,score=0,locked=false;
 function setup(){current=0;score=0;root.querySelector('[data-knowledge-result]').classList.remove('show');draw()}
 function draw(){locked=false;const item=questions[current];root.querySelector('[data-knowledge-meta]').textContent=`Soal ${current+1}/${questions.length} • Skor ${score}`;root.querySelector('[data-knowledge-progress]').style.width=`${current/questions.length*100}%`;root.querySelector('[data-knowledge-question]').textContent=item.q;const box=root.querySelector('[data-knowledge-options]');box.replaceChildren();[...item.o].sort(()=>Math.random()-.5).forEach(value=>{const b=document.createElement('button');b.type='button';b.className='answer-btn';b.textContent=value;b.onclick=()=>choose(b,value,item.a);box.appendChild(b)})}
 function choose(button,value,answer){if(locked)return;locked=true;if(value===answer){score+=10;button.classList.add('correct');window.eduplay.sound(700)}else{button.classList.add('wrong');[...root.querySelectorAll('.answer-btn')].find(x=>x.textContent===answer)?.classList.add('correct')}setTimeout(()=>{current++;current<questions.length?draw():finish()},700)}
 function finish(){root.querySelector('[data-knowledge-progress]').style.width='100%';root.querySelector('[data-knowledge-question]').textContent=score>=80?'Luar biasa! Kamu menguasai banyak hal.':'Bagus! Terus berlatih agar semakin hebat.';root.querySelector('[data-knowledge-options]').replaceChildren();root.querySelector('[data-knowledge-meta]').textContent=`Skor akhir ${score}`;root.querySelector('[data-knowledge-score]').textContent=score;root.querySelector('[data-knowledge-result]').classList.add('show');window.eduplay.saveHistory({type:'Kuis Pengetahuan',score})}
 root.querySelector('[data-knowledge-restart]').onclick=setup;setup();
})();
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

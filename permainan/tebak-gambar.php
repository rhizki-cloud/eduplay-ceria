<?php
$pageTitle='Tebak Gambar';$pageKicker='Kenali dan Jawab';$activeNav='permainan';$showBack=true;$backUrl='permainan/index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro centered">Perhatikan gambar, lalu pilih nama yang benar. Ada 10 soal.</p>
<section class="game-panel" data-picture-game>
  <div class="progress"><span data-picture-progress></span></div>
  <div class="game-meta"><span data-picture-meta>Soal 1/10</span><span>🖼️</span></div>
  <div class="picture-question" data-picture-emoji aria-live="polite">🍎</div>
  <div class="answer-grid" data-picture-options></div>
  <div class="result-box content-card accent" data-picture-result><div style="font-size:60px">🎉</div><h2>Permainan selesai!</h2><div class="score" data-picture-score>0</div><p class="muted">poin</p><button class="btn" data-picture-restart type="button">Ulangi Permainan</button></div>
</section>
<script>
(()=>{
 const root=document.querySelector('[data-picture-game]');const pool=[['🍎','Apel'],['🐘','Gajah'],['🚲','Sepeda'],['🌈','Pelangi'],['🐟','Ikan'],['✈️','Pesawat'],['🥕','Wortel'],['🏠','Rumah'],['🌻','Bunga Matahari'],['⌚','Jam Tangan'],['🐱','Kucing'],['📚','Buku']];let questions=[],current=0,score=0,locked=false;
 const shuffle=a=>[...a].sort(()=>Math.random()-.5);
 function setup(){questions=shuffle(pool).slice(0,10);current=0;score=0;root.querySelector('[data-picture-result]').classList.remove('show');draw()}
 function draw(){locked=false;const [emoji,answer]=questions[current];root.querySelector('[data-picture-emoji]').textContent=emoji;root.querySelector('[data-picture-meta]').textContent=`Soal ${current+1}/10 • Skor ${score}`;root.querySelector('[data-picture-progress]').style.width=`${current*10}%`;const wrong=shuffle(pool.filter(x=>x[1]!==answer)).slice(0,3).map(x=>x[1]);const options=shuffle([answer,...wrong]);const box=root.querySelector('[data-picture-options]');box.replaceChildren();options.forEach(text=>{const b=document.createElement('button');b.type='button';b.className='answer-btn';b.textContent=text;b.onclick=()=>choose(b,text,answer);box.appendChild(b)})}
 function choose(button,value,answer){if(locked)return;locked=true;if(value===answer){score+=10;button.classList.add('correct');window.eduplay.sound(700)}else{button.classList.add('wrong');[...root.querySelectorAll('.answer-btn')].find(x=>x.textContent===answer)?.classList.add('correct')}setTimeout(()=>{current++;current<10?draw():finish()},650)}
 function finish(){root.querySelector('[data-picture-progress]').style.width='100%';root.querySelector('[data-picture-emoji]').textContent='🏆';root.querySelector('[data-picture-options]').replaceChildren();root.querySelector('[data-picture-meta]').textContent=`Skor akhir ${score}`;root.querySelector('[data-picture-score]').textContent=score;root.querySelector('[data-picture-result]').classList.add('show');window.eduplay.saveHistory({type:'Tebak Gambar',score})}
 root.querySelector('[data-picture-restart]').onclick=setup;setup();
})();
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

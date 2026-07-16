<?php
$pageTitle='Urutan Angka';$pageKicker='Temukan Polanya';$activeNav='permainan';$showBack=true;$backUrl='permainan/index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro centered">Cari angka yang hilang agar urutannya menjadi benar.</p>
<section class="game-panel" data-sequence-game>
  <div class="progress"><span data-sequence-progress></span></div>
  <div class="game-meta"><span data-sequence-meta>Ronde 1/6</span><span>🔍</span></div>
  <h2 style="margin-top:26px">Angka berapakah yang hilang?</h2>
  <div class="sequence-board" data-sequence-board></div>
  <div class="answer-grid" data-sequence-options></div>
  <div class="result-box content-card accent" data-sequence-result><div style="font-size:58px">🔢🏆</div><h2>Tantangan selesai!</h2><div class="score" data-sequence-score>0</div><p class="muted">poin</p><button class="btn" data-sequence-restart type="button">Main Lagi</button></div>
</section>
<script>
(()=>{
 const root=document.querySelector('[data-sequence-game]');const rounds=[{s:[2,4,null,8,10],a:6},{s:[5,10,15,null,25],a:20},{s:[3,6,9,12,null],a:15},{s:[20,18,null,14,12],a:16},{s:[1,2,4,null,16],a:8},{s:[7,14,null,28,35],a:21}];let current=0,score=0,locked=false;
 const shuffle=a=>[...a].sort(()=>Math.random()-.5);
 function setup(){current=0;score=0;root.querySelector('[data-sequence-result]').classList.remove('show');draw()}
 function draw(){locked=false;const r=rounds[current];root.querySelector('[data-sequence-meta]').textContent=`Ronde ${current+1}/${rounds.length} • Skor ${score}`;root.querySelector('[data-sequence-progress]').style.width=`${current/rounds.length*100}%`;const board=root.querySelector('[data-sequence-board]');board.replaceChildren();r.s.forEach(value=>{const tile=document.createElement('div');tile.className='sequence-tile'+(value===null?'':' filled');tile.textContent=value===null?'❓':value;board.appendChild(tile)});const opts=new Set([r.a]);while(opts.size<4){const delta=(Math.floor(Math.random()*6)+1)*(Math.random()>.5?1:-1);opts.add(Math.max(0,r.a+delta))}const box=root.querySelector('[data-sequence-options]');box.replaceChildren();shuffle([...opts]).forEach(value=>{const b=document.createElement('button');b.type='button';b.className='answer-btn';b.textContent=value;b.onclick=()=>choose(b,value,r.a);box.appendChild(b)})}
 function choose(button,value,answer){if(locked)return;locked=true;if(value===answer){score+=Math.round(100/rounds.length);button.classList.add('correct');window.eduplay.sound(710)}else{button.classList.add('wrong');[...root.querySelectorAll('.answer-btn')].find(x=>Number(x.textContent)===answer)?.classList.add('correct')}setTimeout(()=>{current++;current<rounds.length?draw():finish()},700)}
 function finish(){score=Math.min(100,score);root.querySelector('[data-sequence-progress]').style.width='100%';root.querySelector('[data-sequence-board]').innerHTML='<div class="sequence-tile filled">🏆</div>';root.querySelector('[data-sequence-options]').replaceChildren();root.querySelector('[data-sequence-meta]').textContent=`Skor akhir ${score}`;root.querySelector('[data-sequence-score]').textContent=score;root.querySelector('[data-sequence-result]').classList.add('show');window.eduplay.saveHistory({type:'Urutan Angka',score})}
 root.querySelector('[data-sequence-restart]').onclick=setup;setup();
})();
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

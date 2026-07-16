<?php
$pageTitle='Memory Ceria';$pageKicker='Latih Ingatanmu';$activeNav='permainan';$showBack=true;$backUrl='permainan/index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro centered">Buka dua kartu. Temukan semua pasangan dengan langkah sesedikit mungkin.</p>
<section class="game-panel" data-memory-game>
  <div class="progress"><span data-memory-progress></span></div>
  <div class="game-status"><span class="status-pill">Langkah: <b data-memory-moves>0</b></span><span class="status-pill">Pasangan: <b data-memory-pairs>0</b>/8</span><span class="status-pill">Waktu: <b data-memory-time>0</b> dtk</span></div>
  <div class="memory-grid" data-memory-grid aria-label="Papan permainan kartu memori"></div>
  <div class="result-box content-card accent" data-memory-result><div style="font-size:58px">🎉</div><h2>Semua pasangan ditemukan!</h2><p>Kamu menyelesaikannya dalam <b data-memory-result-moves>0</b> langkah.</p><div class="score" data-memory-score>0</div><p class="muted">poin</p><button class="btn" type="button" data-memory-restart>Main Lagi</button></div>
</section>
<script>
(()=>{
 const root=document.querySelector('[data-memory-game]'),grid=root.querySelector('[data-memory-grid]');
 const icons=['🍎','🚀','🐼','⭐','🌈','🎨','⚽','🎵'];let cards=[],open=[],matched=0,moves=0,start=Date.now(),timer,locked=false,finished=false;
 const shuffle=a=>[...a].sort(()=>Math.random()-.5);
 function setup(){cards=shuffle([...icons,...icons]).map((icon,id)=>({icon,id}));grid.replaceChildren();open=[];matched=0;moves=0;start=Date.now();locked=false;finished=false;root.querySelector('[data-memory-result]').classList.remove('show');update();cards.forEach(card=>{const b=document.createElement('button');b.type='button';b.className='memory-card';b.setAttribute('aria-label','Kartu tertutup');b.dataset.id=card.id;b.onclick=()=>flip(b,card);grid.appendChild(b)});clearInterval(timer);timer=setInterval(()=>{if(!finished)root.querySelector('[data-memory-time]').textContent=Math.floor((Date.now()-start)/1000)},1000)}
 function update(){root.querySelector('[data-memory-moves]').textContent=moves;root.querySelector('[data-memory-pairs]').textContent=matched;root.querySelector('[data-memory-progress]').style.width=`${matched/8*100}%`}
 function flip(button,card){if(locked||button.classList.contains('matched')||button.classList.contains('flipped')||finished)return;button.classList.add('flipped');button.textContent=card.icon;button.setAttribute('aria-label',card.icon);open.push({button,card});if(open.length===2){moves++;update();locked=true;const [a,b]=open;if(a.card.icon===b.card.icon){setTimeout(()=>{a.button.classList.replace('flipped','matched');b.button.classList.replace('flipped','matched');matched++;open=[];locked=false;window.eduplay.sound(680);update();if(matched===8)finish()},350)}else{setTimeout(()=>{[a,b].forEach(x=>{x.button.classList.remove('flipped');x.button.textContent='';x.button.setAttribute('aria-label','Kartu tertutup')});open=[];locked=false},700)}}}
 function finish(){finished=true;clearInterval(timer);const seconds=Math.floor((Date.now()-start)/1000);const score=Math.max(25,100-Math.max(0,moves-8)*4-Math.floor(seconds/12));root.querySelector('[data-memory-result-moves]').textContent=moves;root.querySelector('[data-memory-score]').textContent=score;root.querySelector('[data-memory-result]').classList.add('show');window.eduplay.saveHistory({type:'Memory Ceria',score})}
 root.querySelector('[data-memory-restart]').onclick=setup;setup();
})();
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

<?php
$pageTitle='Mencocokkan Ceria';$pageKicker='Pasangkan dengan Tepat';$activeNav='permainan';$showBack=true;$backUrl='permainan/index.php';
include __DIR__.'/../includes/header.php';
?>
<p class="intro centered">Pilih satu gambar di kiri, lalu pilih kata yang cocok di kanan.</p>
<section class="game-panel" data-matching-game>
  <div class="progress"><span data-match-progress></span></div>
  <div class="game-status"><span class="status-pill">Benar: <b data-match-count>0</b>/6</span><span class="status-pill">Kesalahan: <b data-match-errors>0</b></span></div>
  <div class="matching-board"><div class="matching-column" data-match-left></div><div class="matching-column" data-match-right></div></div>
  <div class="notice" data-match-message>Pilih gambar dan kata yang sesuai.</div>
  <div class="result-box content-card accent" data-match-result><div style="font-size:58px">🧩✨</div><h2>Semua sudah cocok!</h2><div class="score" data-match-score>0</div><p class="muted">poin</p><button class="btn" data-match-restart type="button">Main Lagi</button></div>
</section>
<script>
(()=>{
 const root=document.querySelector('[data-matching-game]');const pairs=[['🍎','Apel'],['🐟','Ikan'],['🚲','Sepeda'],['📚','Buku'],['🌳','Pohon'],['☀️','Matahari']];let selectedLeft=null,selectedRight=null,matched=0,errors=0,lock=false;
 const shuffle=a=>[...a].sort(()=>Math.random()-.5);
 function setup(){matched=0;errors=0;selectedLeft=selectedRight=null;lock=false;root.querySelector('[data-match-result]').classList.remove('show');const left=root.querySelector('[data-match-left]'),right=root.querySelector('[data-match-right]');left.replaceChildren();right.replaceChildren();shuffle(pairs).forEach(([icon,label])=>left.appendChild(make(icon,label,'left')));shuffle(pairs).forEach(([icon,label])=>right.appendChild(make(label,label,'right')));update('Pilih gambar dan kata yang sesuai.')}
 function make(text,key,side){const b=document.createElement('button');b.type='button';b.className='match-item';b.textContent=text;b.dataset.key=key;b.onclick=()=>select(b,side);return b}
 function select(button,side){if(lock||button.classList.contains('matched'))return;const previous=side==='left'?selectedLeft:selectedRight;if(previous)previous.classList.remove('selected');button.classList.add('selected');if(side==='left')selectedLeft=button;else selectedRight=button;if(selectedLeft&&selectedRight)check()}
 function check(){lock=true;if(selectedLeft.dataset.key===selectedRight.dataset.key){selectedLeft.classList.remove('selected');selectedRight.classList.remove('selected');selectedLeft.classList.add('matched');selectedRight.classList.add('matched');matched++;window.eduplay.sound(700);update('Hebat! Pasanganmu benar.');selectedLeft=selectedRight=null;lock=false;if(matched===pairs.length)finish()}else{errors++;update('Belum cocok. Coba lagi, ya!');setTimeout(()=>{selectedLeft.classList.remove('selected');selectedRight.classList.remove('selected');selectedLeft=selectedRight=null;lock=false},600)}}
 function update(message){root.querySelector('[data-match-count]').textContent=matched;root.querySelector('[data-match-errors]').textContent=errors;root.querySelector('[data-match-progress]').style.width=`${matched/pairs.length*100}%`;root.querySelector('[data-match-message]').textContent=message}
 function finish(){const score=Math.max(30,100-errors*8);root.querySelector('[data-match-score]').textContent=score;root.querySelector('[data-match-result]').classList.add('show');window.eduplay.saveHistory({type:'Mencocokkan Ceria',score})}
 root.querySelector('[data-match-restart]').onclick=setup;setup();
})();
</script>
<?php include __DIR__.'/../includes/footer.php'; ?>

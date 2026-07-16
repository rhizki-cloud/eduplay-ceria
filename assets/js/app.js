(()=>{
  'use strict';
  const q=(selector,root=document)=>root.querySelector(selector);
  const qa=(selector,root=document)=>[...root.querySelectorAll(selector)];
  const soundKey='eduplay_sound';
  const historyKey='eduplay_history';
  let sound=localStorage.getItem(soundKey)!=='off';
  let toastTimer;

  function safeHistory(){
    try{
      const value=JSON.parse(localStorage.getItem(historyKey)||'[]');
      return Array.isArray(value)?value:[];
    }catch(_){return []}
  }

  function renderSound(){
    qa('[data-sound-toggle]').forEach(btn=>{
      btn.textContent=sound?'🔊':'🔇';
      btn.setAttribute('aria-pressed',sound?'true':'false');
      btn.title=sound?'Suara aktif':'Suara nonaktif';
    });
  }

  function beep(frequency=520,duration=.08){
    if(!sound)return;
    try{
      const AudioCtx=window.AudioContext||window.webkitAudioContext;
      if(!AudioCtx)return;
      const audio=new AudioCtx();
      const oscillator=audio.createOscillator();
      const gain=audio.createGain();
      oscillator.connect(gain);gain.connect(audio.destination);
      oscillator.frequency.value=frequency;
      gain.gain.setValueAtTime(.045,audio.currentTime);
      gain.gain.exponentialRampToValueAtTime(.001,audio.currentTime+duration);
      oscillator.start();oscillator.stop(audio.currentTime+duration);
      oscillator.addEventListener('ended',()=>audio.close(),{once:true});
    }catch(_){/* Audio is optional. */}
  }

  function toast(message){
    const el=q('[data-toast]');
    if(!el)return;
    el.textContent=message;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer=setTimeout(()=>el.classList.remove('show'),2600);
  }

  function localDateKey(dateValue){
    const date=new Date(dateValue);
    if(Number.isNaN(date.getTime()))return '';
    const year=date.getFullYear();
    const month=String(date.getMonth()+1).padStart(2,'0');
    const day=String(date.getDate()).padStart(2,'0');
    return `${year}-${month}-${day}`;
  }

  function calculateStreak(history){
    const unique=[...new Set(history.map(item=>localDateKey(item.date)).filter(Boolean))].sort().reverse();
    if(!unique.length)return 0;
    const today=new Date();today.setHours(0,0,0,0);
    const latest=new Date(`${unique[0]}T00:00:00`);
    const dayGap=Math.round((today-latest)/86400000);
    if(dayGap>1)return 0;
    let streak=1;
    let cursor=latest;
    for(let i=1;i<unique.length;i++){
      const expected=new Date(cursor);expected.setDate(expected.getDate()-1);
      const current=new Date(`${unique[i]}T00:00:00`);
      if(current.getTime()!==expected.getTime())break;
      streak++;cursor=current;
    }
    return streak;
  }

  function stats(){
    const history=safeHistory();
    const points=history.reduce((total,item)=>total+Math.max(0,Number(item.score)||0),0);
    const level=Math.max(1,Math.floor(points/300)+1);
    const levelStart=(level-1)*300;
    const levelProgress=Math.min(100,Math.round(((points-levelStart)/300)*100));
    const today=localDateKey(new Date());
    const todayCount=history.filter(item=>localDateKey(item.date)===today).length;
    const best=history.reduce((max,item)=>Math.max(max,Number(item.score)||0),0);
    return {history,points,level,levelProgress,todayCount,best,streak:calculateStreak(history)};
  }

  function setText(selector,value){qa(selector).forEach(el=>el.textContent=String(value))}
  function setWidth(selector,value){qa(selector).forEach(el=>el.style.width=`${Math.max(0,Math.min(100,value))}%`)}

  function renderGlobalStats(){
    const data=stats();
    setText('[data-user-level]',data.level);
    setText('[data-stat-level]',data.level);
    setText('[data-stat-points]',data.points);
    setText('[data-stat-sessions]',data.history.length);
    setText('[data-stat-streak]',data.streak);
    setText('[data-stat-best]',data.best);
    setText('[data-daily-count]',Math.min(data.todayCount,3));
    setText('[data-level-points]',data.points);
    setText('[data-level-number]',data.level);
    setWidth('[data-daily-progress]',Math.min(100,(data.todayCount/3)*100));
    setWidth('[data-level-progress]',data.levelProgress);
    setText('[data-level-progress-text]',`${data.levelProgress}%`);
    setText('[data-next-level-points]',300-(data.points%300||0));
    document.documentElement.style.setProperty('--daily-progress',`${Math.min(100,(data.todayCount/3)*100)}%`);
  }

  function iconFor(type=''){
    if(/angka|arit|numerasi|hitung/i.test(type))return '🔢';
    if(/sehat|makanan|gizi/i.test(type))return '🥗';
    if(/karakter|cerita|jujur|disiplin/i.test(type))return '🌟';
    if(/memory/i.test(type))return '🧠';
    if(/gambar/i.test(type))return '🖼️';
    if(/cocok|matching/i.test(type))return '🧩';
    return '🎮';
  }

  function renderRecentActivities(){
    const box=q('[data-recent-activities]');
    if(!box)return;
    const history=safeHistory().slice(0,5);
    box.replaceChildren();
    if(!history.length){
      const empty=document.createElement('div');
      empty.className='empty-state content-card';
      empty.innerHTML='<span class="empty-icon">🌱</span><h3>Petualanganmu dimulai di sini</h3><p>Mainkan satu kuis atau permainan agar riwayat aktivitas muncul.</p>';
      const link=document.createElement('a');link.className='btn';link.href=(window.EDUPLAY_BASE||'')+'/permainan/index.php';link.textContent='Mulai Bermain';empty.appendChild(link);box.appendChild(empty);return;
    }
    history.forEach(item=>{
      const row=document.createElement('div');row.className='activity-item';
      const icon=document.createElement('span');icon.className='activity-icon';icon.textContent=iconFor(item.type);
      const copy=document.createElement('div');
      const title=document.createElement('strong');title.textContent=item.type||'Aktivitas EduPlay';
      const date=document.createElement('small');date.textContent=new Date(item.date).toLocaleString('id-ID',{dateStyle:'medium',timeStyle:'short'});
      copy.append(title,date);
      const score=document.createElement('div');score.className='score';score.textContent=Number(item.score)||0;
      row.append(icon,copy,score);box.appendChild(row);
    });
  }

  function renderContinueLearning(){
    const title=q('[data-continue-title]');
    const meta=q('[data-continue-meta]');
    const icon=q('[data-continue-icon]');
    const link=q('[data-continue-link]');
    if(!title||!meta||!icon||!link)return;
    const last=safeHistory()[0];
    if(!last)return;
    title.textContent=last.type||'Aktivitas terakhir';
    meta.textContent=`Skor terakhir ${Number(last.score)||0} • ulangi untuk hasil lebih tinggi`;
    icon.textContent=iconFor(last.type);
    if(/sehat|makanan/i.test(last.type))link.href=(window.EDUPLAY_BASE||'')+'/permainan/sehat.php';
    else if(/karakter|cerita/i.test(last.type))link.href=(window.EDUPLAY_BASE||'')+'/permainan/karakter.php';
    else if(/memory/i.test(last.type))link.href=(window.EDUPLAY_BASE||'')+'/permainan/memory.php';
    else if(/gambar/i.test(last.type))link.href=(window.EDUPLAY_BASE||'')+'/permainan/tebak-gambar.php';
    else link.href=(window.EDUPLAY_BASE||'')+'/permainan/numerasi.php';
  }

  function greeting(){
    const el=q('[data-greeting]');
    if(!el)return;
    const hour=new Date().getHours();
    el.textContent=hour<11?'Selamat pagi!':hour<15?'Selamat siang!':hour<18?'Selamat sore!':'Selamat malam!';
  }

  qa('[data-sound-toggle]').forEach(btn=>btn.addEventListener('click',()=>{
    sound=!sound;localStorage.setItem(soundKey,sound?'on':'off');renderSound();if(sound)beep(620,.1);
  }));

  window.addEventListener('online',()=>toast('Koneksi kembali aktif 🎉'));
  window.addEventListener('offline',()=>toast('Kamu sedang offline. Beberapa fitur tetap bisa dipakai.'));

  window.eduplay={
    saveHistory(item){
      const history=safeHistory();
      const clean={
        type:String(item?.type||'Aktivitas EduPlay').slice(0,80),
        score:Math.max(0,Math.min(1000,Number(item?.score)||0)),
        date:new Date().toISOString()
      };
      history.unshift(clean);
      localStorage.setItem(historyKey,JSON.stringify(history.slice(0,50)));
      renderGlobalStats();renderRecentActivities();renderContinueLearning();
      toast(`Prestasi tersimpan: ${clean.score} poin ⭐`);
      fetch((window.EDUPLAY_BASE||'')+'/proses/prestasi/simpan.php',{
        method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(clean)
      }).catch(()=>{});
      return clean;
    },
    history:safeHistory,
    stats,
    sound(frequency=520){beep(frequency)},
    toast,
    resetProgress(){localStorage.removeItem(historyKey);renderGlobalStats();renderRecentActivities();renderContinueLearning()}
  };

  renderSound();renderGlobalStats();renderRecentActivities();renderContinueLearning();greeting();
})();

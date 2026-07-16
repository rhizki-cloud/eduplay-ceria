</main>
<footer class="desktop-footer">
    <span>© <?= date('Y') ?> EduPlay Ceria</span>
    <span>Belajar • Bermain • Bertumbuh 🌱</span>
</footer>
</div>

<nav class="bottom-nav" aria-label="Navigasi utama mobile">
<a class="<?= $activeNav === 'home' ? 'active' : '' ?>" href="<?= url('index.php') ?>"><span>🏠</span><small>Beranda</small></a>
<a class="<?= $learningActive ? 'active' : '' ?>" href="<?= url('materi/index.php') ?>"><span>📚</span><small>Belajar</small></a>
<a class="<?= $activeNav === 'permainan' ? 'active' : '' ?>" href="<?= url('permainan/index.php') ?>"><span>🎮</span><small>Bermain</small></a>
<a class="<?= $activeNav === 'prestasi' ? 'active' : '' ?>" href="<?= url('prestasi/index.php') ?>"><span>🏆</span><small>Prestasi</small></a>
<a class="<?= $activeNav === 'tentang' ? 'active' : '' ?>" href="<?= url('tentang/index.php') ?>"><span>💡</span><small>Tentang</small></a>
</nav>
</div>
<div class="app-toast" role="status" aria-live="polite" data-toast></div>
<script>window.EDUPLAY_BASE=<?= json_encode(BASE_URL) ?>;</script>
<script src="<?= url('assets/js/app.js') ?>"></script>
<?php if (!empty($pageScript)): ?><script src="<?= url($pageScript) ?>"></script><?php endif; ?>
</body>
</html>

<?php
$admin          = session('admin');
$adminPageTitle = $adminPageTitle ?? 'Back-office';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($adminPageTitle) ?> — Back-office LEL</title>
<link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="any">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  :root { --navy:#1F4E79; --medblue:#2E75B6; --bg:#f4f6f8; --ink:#1a2319; }
  * { box-sizing: border-box; }
  body { margin:0; font-family:'DM Sans',Arial,sans-serif; background:var(--bg); color:var(--ink); }
  .admin-shell { display:flex; min-height:100vh; }
  .admin-sidebar { width:230px; background:var(--navy); color:#fff; padding:24px 18px; flex-shrink:0; }
  .admin-sidebar h2 { font-size:1.1rem; margin:0 0 24px; }
  .admin-sidebar a { display:flex; align-items:center; gap:10px; color:#dce6f0; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:4px; font-size:0.92rem; }
  .admin-sidebar a:hover, .admin-sidebar a.active { background:var(--medblue); color:#fff; }
  .nav-icon { flex-shrink:0; font-size:1.15rem; }
  .btn .nav-icon, h3 .nav-icon { vertical-align:-3px; margin-right:4px; }
  .admin-main { flex:1; padding:32px 40px; }
  .admin-topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; }
  .admin-card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 4px 14px rgba(0,0,0,0.06); margin-bottom:24px; }
  table.admin-table { width:100%; border-collapse:collapse; }
  table.admin-table th, table.admin-table td { text-align:left; padding:12px 10px; border-bottom:1px solid #e7e9ec; font-size:0.92rem; }
  table.admin-table tr:nth-child(even) { background:#fafbfc; }
  .badge { display:inline-block; padding:3px 10px; border-radius:999px; font-size:0.78rem; font-weight:700; }
  .badge-publie { background:#e4f2ea; color:#0b5940; }
  .badge-brouillon { background:#fdf3e0; color:#8a5a00; }
  .btn { display:inline-block; padding:9px 18px; border-radius:8px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; cursor:pointer; }
  .btn-primary { background:var(--navy); color:#fff; }
  .btn-primary:hover { background:var(--medblue); }
  .btn-danger { background:#c0392b; color:#fff; }
  .btn-secondary { background:#e7e9ec; color:var(--ink); }
  .admin-form label { display:block; font-weight:700; margin-bottom:6px; font-size:0.88rem; }
  .admin-form input, .admin-form textarea, .admin-form select {
    width:100%; padding:10px 12px; border:1px solid #d2d6db; border-radius:8px; font-family:inherit; margin-bottom:18px; font-size:0.92rem;
  }
  .admin-form textarea { min-height: 220px; font-family: monospace; }
  .lel-alert { padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:0.9rem; }
  .lel-alert-success { background:#e4f2ea; color:#0b5940; }
  .lel-alert-error { background:#fdeaea; color:#7a1f1f; }
  .row { display:flex; gap:20px; }
  .row > div { flex:1; }
</style>
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <h2>LEL · Back-office</h2>
    <?php if ($admin): ?>
    <a href="<?= site_url('admin/dashboard') ?>"><?= icon('chart', 'nav-icon') ?> Tableau de bord</a>
    <a href="<?= site_url('admin/actualites') ?>"><?= icon('news', 'nav-icon') ?> Actualités</a>
    <a href="<?= site_url('admin/actualites/create') ?>"><?= icon('plus', 'nav-icon') ?> Nouvelle actualité</a>
    <a href="<?= site_url('admin/enfants') ?>"><?= icon('userplus', 'nav-icon') ?> Enfants à parrainer</a>
    <a href="<?= site_url('admin/contacts') ?>"><?= icon('mail', 'nav-icon') ?> Messages</a>
    <a href="<?= site_url('/') ?>" target="_blank"><?= icon('globe', 'nav-icon') ?> Voir le site</a>
    <a href="<?= site_url('admin/logout') ?>"><?= icon('logout', 'nav-icon') ?> Déconnexion</a>
    <?php endif; ?>
  </aside>
  <main class="admin-main">
<?= $this->renderSection('content') ?>
  </main>
</div>
</body>
</html>

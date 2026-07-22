<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connexion — Back-office LEL</title>
<link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="any">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
<style>
body { font-family:'DM Sans',Arial,sans-serif; background:#1F4E79; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; }
.box { background:#fff; padding:40px; border-radius:14px; width:100%; max-width:380px; box-shadow:0 20px 50px rgba(0,0,0,0.2); }
.box h1 { font-size:1.3rem; margin:0 0 22px; color:#1F4E79; }
label { display:block; font-weight:700; margin-bottom:6px; font-size:0.88rem; }
input { width:100%; padding:10px 12px; border:1px solid #d2d6db; border-radius:8px; margin-bottom:18px; font-size:0.95rem; box-sizing:border-box; }
button { width:100%; padding:12px; background:#1F4E79; color:#fff; border:none; border-radius:8px; font-weight:700; cursor:pointer; font-size:0.95rem; }
button:hover { background:#2E75B6; }
.error { background:#fdeaea; color:#7a1f1f; padding:10px 14px; border-radius:8px; margin-bottom:18px; font-size:0.88rem; }
</style>
</head>
<body>
<div class="box">
  <h1>Back-office · Les Enfants Lumières</h1>
  <?php if ($erreur ?? null): ?><div class="error"><?= esc($erreur) ?></div><?php endif; ?>
  <form method="post" action="<?= site_url('admin/login') ?>">
    <?= csrf_field() ?>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required autofocus>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Se connecter</button>
  </form>
</div>
</body>
</html>

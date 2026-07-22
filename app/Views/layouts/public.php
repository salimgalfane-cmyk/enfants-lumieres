<?php
$pageTitle       = $pageTitle ?? 'Les Enfants Lumières';
$pageDescription = $pageDescription ?? "Association humanitaire franco-comorienne — Maison des Enfants Lumières, Dzahadjou.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<!-- Google tag (gtag.js) — chargée systématiquement pour la détection Google Ads, mais en mode "consentement par défaut refusé" : aucun cookie n'est posé tant que l'utilisateur n'a pas accepté via la bannière (voir main.js). -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-18337544236"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}

  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'ad_user_data': 'denied',
    'ad_personalization': 'denied',
    'analytics_storage': 'denied',
    'wait_for_update': 500
  });

  gtag('js', new Date());
  gtag('config', 'AW-18337544236');
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($pageTitle) ?></title>
<meta name="description" content="<?= esc($pageDescription) ?>">
<link rel="canonical" href="<?= esc(current_url()) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="any">
</head>
<body>
<header class="lel-header">
  <div class="lel-container">
    <a class="lel-logo" href="<?= site_url('/') ?>">
      <img src="<?= base_url('assets/uploads/logo-header.png') ?>" alt="Les Enfants Lumières">
    </a>
    <button class="lel-nav-toggle" id="navToggle" aria-label="Ouvrir le menu"><?= icon('menu') ?></button>
    <nav class="lel-nav" id="mainNav">
      <a href="<?= site_url('/') ?>" class="<?= navActive('') ?>">Accueil</a>
      <a href="<?= site_url('nos-actions') ?>" class="<?= navActive('nos-actions') ?>">Nos projets</a>
      <a href="<?= site_url('notre-impact') ?>" class="<?= navActive('notre-impact') ?>">Notre impact</a>
      <a href="<?= site_url('actualites') ?>" class="<?= navActive('actualite', true) ?>">Actualités</a>
      <a href="<?= site_url('parrainage') ?>" class="<?= navActive('parrainage') ?>">Parrainage</a>
      <a href="<?= site_url('contact') ?>" class="<?= navActive('contact') ?>">Contact</a>
      <a class="lel-btn-don" href="https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3" target="_blank" rel="noopener"><?= icon('heart') ?> Faire un don</a>
    </nav>
  </div>
</header>
<main>
<?= $this->renderSection('content') ?>
</main>
<footer class="lel-footer">
  <div class="lel-container">
    <div class="lel-footer-grid">
      <div>
        <h3 style="color:var(--cream)">Les Enfants Lumières</h3>
        <p>Association humanitaire franco-comorienne. Depuis 2022, la Maison des Enfants Lumières transforme l'accès à l'éducation à Dzahadjou, Grande Comore.</p>
        <p style="font-size:0.85rem;"><span style="opacity:.75;">Association loi 1901 déclarée en préfecture de l'Essonne —</span> <a href="https://www.journal-officiel.gouv.fr/pages/associations-detail-annonce/?q.id=id:202200351510" target="_blank" rel="noopener" style="text-decoration:underline; color:var(--green-light); font-weight:600;">Journal Officiel du 30 août 2022, annonce n° 1510</a></p>
      </div>
      <div>
        <h3 style="color:var(--cream); font-size:1.1rem;">Navigation</h3>
        <p><a href="<?= site_url('nos-actions') ?>">Nos projets</a><br>
           <a href="<?= site_url('notre-impact') ?>">Notre impact</a><br>
           <a href="<?= site_url('actualites') ?>">Actualités</a><br>
           <a href="<?= site_url('parrainage') ?>">Parrainage</a></p>
      </div>
      <div>
        <h3 style="color:var(--cream); font-size:1.1rem;">Contact</h3>
        <p><a href="mailto:contact@enfants-lumieres.com">contact@enfants-lumieres.com</a><br>
           42 Avenue des Alliés<br>91120 Palaiseau, France</p>
      </div>
    </div>
    <div class="lel-footer-bottom">
      &copy; <?= date('Y') ?> Les Enfants Lumières. Tous droits réservés. ·
      <a href="<?= site_url('politique-de-confidentialite') ?>">Politique de confidentialité</a> ·
      <a href="#" id="cookieGerer">Gérer les cookies</a>
    </div>
  </div>
</footer>

<div id="cookieBanner" class="lel-cookie-banner" hidden>
  <div class="lel-cookie-banner-content">
    <p>Nous utilisons des cookies de mesure publicitaire (Google Ads) pour évaluer l'efficacité de nos campagnes de sensibilisation. Ces cookies ne sont déposés qu'avec votre accord. <a href="<?= site_url('politique-de-confidentialite') ?>">En savoir plus</a></p>
    <div class="lel-cookie-banner-actions">
      <button type="button" id="cookieRefuser">Refuser</button>
      <button type="button" id="cookieAccepter">Accepter</button>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>

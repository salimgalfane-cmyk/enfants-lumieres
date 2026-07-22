<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<article class="lel-article-hero">
  <div class="lel-container">
    <span class="kicker"><?= icon($actualite['categorie_icone']) ?> <?= esc($actualite['categorie_nom']) ?></span>
    <h1><?= esc($actualite['titre']) ?></h1>
    <p style="opacity:.7; font-size:.9rem;">
      <?= esc(formatDateFr($actualite['date_publication'])) ?> · <?= (int) $actualite['temps_lecture_min'] ?> min de lecture
    </p>
    <?php if ($actualite['image_principale']): ?>
      <img src="<?= esc($actualite['image_principale']) ?>" alt="<?= esc($actualite['titre']) ?>">
    <?php endif; ?>

    <div class="lel-article-content">
      <?= $actualite['contenu'] /* HTML de confiance, saisi en back-office par l'équipe */ ?>
    </div>

    <?= view('partials/cta_block', ['actualite' => $actualite]) ?>

    <p><a href="<?= site_url('actualites') ?>">← Retour aux actualités</a></p>
  </div>
</article>
<?= $this->endSection() ?>

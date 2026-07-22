<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <h1>Actualités</h1>
    <p class="lead">Les nouvelles de la Maison des Enfants Lumières, trimestre après trimestre.</p>

    <div class="lel-grid-articles">
      <?php foreach ($actus as $actu): ?>
      <a class="lel-card" href="<?= site_url('actualite/' . $actu['slug']) ?>" style="color:inherit;">
        <img src="<?= esc($actu['image_principale'] ?: base_url('assets/uploads/placeholder.jpg')) ?>" alt="<?= esc($actu['titre']) ?>">
        <div class="lel-card-body">
          <span class="meta"><?= icon($actu['categorie_icone']) ?> <?= esc($actu['categorie_nom']) ?> · <?= (int) $actu['temps_lecture_min'] ?> min de lecture</span>
          <h3><?= esc($actu['titre']) ?></h3>
          <p><?= esc($actu['extrait']) ?></p>
          <span class="lire-plus">Lire plus →</span>
        </div>
      </a>
      <?php endforeach; ?>
      <?php if (! $actus): ?><p>Aucune actualité pour le moment.</p><?php endif; ?>
    </div>

    <div style="display:flex; justify-content:center; gap:14px; margin-top:20px;">
      <?php if ($page > 1): ?><a class="lel-btn-secondary" href="?page=<?= $page - 1 ?>">← Précédent</a><?php endif; ?>
      <?php if (count($actus) === $parPage): ?><a class="lel-btn-secondary" href="?page=<?= $page + 1 ?>">Suivant →</a><?php endif; ?>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

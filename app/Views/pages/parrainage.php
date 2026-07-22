<?= $this->extend('layouts/public') ?>

<?php
$carteEnfant = function (array $enfant): string {
    ob_start();
    ?>
    <div class="lel-enfant-card">
      <?php if ($enfant['photo']): ?>
        <img src="<?= esc($enfant['photo']) ?>" alt="<?= esc($enfant['prenom']) ?>">
      <?php else: ?>
        <div class="enfant-photo-placeholder"><?= icon('person') ?></div>
      <?php endif; ?>
      <div class="enfant-body">
        <h3><?= esc($enfant['prenom']) ?></h3>
        <span class="enfant-classe">
          <?= esc($enfant['classe']) ?><?= $enfant['age'] !== null ? ' · ' . (int) $enfant['age'] . ' ans' : '' ?>
        </span>
        <?php if ($enfant['anecdote']): ?>
          <p class="enfant-anecdote"><?= esc($enfant['anecdote']) ?></p>
        <?php endif; ?>
        <?php if ($enfant['statut'] === 'parraine'): ?>
          <span class="enfant-parraine-badge"><?= icon('heart') ?> Déjà parrainé(e)</span>
        <?php else: ?>
          <span class="enfant-prix">25 € / mois</span>
          <a class="lel-btn-primary" href="<?= esc($enfant['lien_parrainage']) ?>" target="_blank" rel="noopener">Parrainer <?= esc($enfant['prenom']) ?></a>
        <?php endif; ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
};
?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <span class="kicker">Parrainage</span>
    <h1>Parrainer un enfant aux Comores</h1>
    <p class="lead">Pour 25&nbsp;€ par mois, votre parrainage assure la scolarité complète d'un enfant à la Maison des Enfants Lumières, notre école pilote à Dzahadjou (Grande Comore) : matériel pédagogique, encadrement, repas et suivi tout au long de l'année. Une association humanitaire franco-comorienne, 100&nbsp;% transparente sur l'utilisation de chaque don. Choisissez un enfant ci-dessous pour commencer.</p>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <div class="lel-tabs" role="tablist">
      <button type="button" class="lel-tab-btn active" data-tab="disponibles">Enfants à parrainer (<?= count($enfantsDisponibles) ?>)</button>
      <button type="button" class="lel-tab-btn" data-tab="parraines">Enfants déjà parrainés (<?= count($enfantsParraines) ?>)</button>
    </div>

    <div class="lel-tab-panel" data-panel="disponibles">
      <?php if ($enfantsDisponibles): ?>
      <div class="lel-enfants-grid">
        <?php foreach ($enfantsDisponibles as $enfant): ?>
          <?= $carteEnfant($enfant) ?>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
        <p>Aucun enfant n'est disponible au parrainage pour le moment. <a href="<?= site_url('contact') ?>">Contactez-nous</a> pour en savoir plus sur les prochaines ouvertures de parrainage.</p>
      <?php endif; ?>
    </div>

    <div class="lel-tab-panel" data-panel="parraines" hidden>
      <?php if ($enfantsParraines): ?>
      <div class="lel-enfants-grid">
        <?php foreach ($enfantsParraines as $enfant): ?>
          <?= $carteEnfant($enfant) ?>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
        <p>Aucun enfant parrainé à afficher pour le moment.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="lel-section">
  <div class="lel-container">
    <div class="lel-cta">
      <div class="cta-icon"><?= icon('heart') ?></div>
      <div class="cta-content">
        <h3>Pas encore décidé ?</h3>
        <p>Vous pouvez aussi soutenir la Maison des Enfants Lumières de façon générale : votre don sera dirigé vers l'enfant qui en a le plus besoin.</p>
      </div>
      <a class="lel-btn-primary" href="https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3" target="_blank" rel="noopener">Faire un don</a>
    </div>

    <p style="font-size:0.82rem; opacity:.65; text-align:center; margin:32px 0 0;">Les photos et informations des enfants publiées sur cette page sont partagées avec l'accord préalable de leurs parents ou tuteurs légaux.</p>
  </div>
</section>
<?= $this->endSection() ?>

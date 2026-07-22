<?php
/**
 * Bloc CTA d'une actualité. Attend une variable $actualite (tableau issu de la table actualites).
 * La résolution du CTA passe systématiquement par ActualiteModel::resolveCta() — ne jamais dupliquer cette logique ici.
 */
if (! isset($actualite)) {
    return;
}

$cta        = (new \App\Models\ActualiteModel())->resolveCta($actualite);
$colorClass = $cta['couleur'] === 'green-mid' ? 'cta-green-mid' : '';
?>
<div class="lel-cta <?= esc($colorClass) ?>">
  <div class="cta-icon"><?= icon($cta['icone'] ?? 'heart') ?></div>
  <div class="cta-content">
    <h3><?= esc($cta['titre']) ?></h3>
    <p><?= esc($cta['texte']) ?></p>
  </div>
  <a class="lel-btn-primary" href="<?= esc($cta['bouton_lien']) ?>" target="<?= str_starts_with($cta['bouton_lien'], 'http') ? '_blank' : '_self' ?>" rel="noopener">
    <?= esc($cta['bouton_texte']) ?>
  </a>
</div>

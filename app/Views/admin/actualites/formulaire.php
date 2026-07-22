<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1><?= $actualite['id'] ? "Éditer l'actualité" : "Nouvelle actualité" ?></h1>

<?php if ($erreur ?? null): ?><div class="lel-alert lel-alert-error"><?= esc($erreur) ?></div><?php endif; ?>

<form class="admin-form" method="post" action="<?= $actualite['id'] ? site_url('admin/actualites/' . $actualite['id']) : site_url('admin/actualites') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="admin-card">
    <h3>Contenu de l'article</h3>
    <label for="titre">Titre</label>
    <input type="text" id="titre" name="titre" value="<?= esc($actualite['titre']) ?>" required>

    <label for="extrait">Extrait (résumé affiché sur les listes, 400 caractères max)</label>
    <textarea id="extrait" name="extrait" style="min-height:80px; font-family:inherit;" maxlength="400" required><?= esc($actualite['extrait']) ?></textarea>

    <label for="contenu">Contenu (HTML autorisé : &lt;p&gt;, &lt;h2&gt;, &lt;strong&gt;, &lt;a&gt;, &lt;img&gt;...)</label>
    <textarea id="contenu" name="contenu" required><?= esc($actualite['contenu']) ?></textarea>

    <div class="row">
      <div>
        <label for="categorie_id">Catégorie</label>
        <select id="categorie_id" name="categorie_id">
          <option value="">— Aucune —</option>
          <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $actualite['categorie_id'] == $c['id'] ? 'selected' : '' ?>><?= esc($c['nom']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="temps_lecture_min">Temps de lecture (minutes)</label>
        <input type="number" id="temps_lecture_min" name="temps_lecture_min" min="1" value="<?= (int) $actualite['temps_lecture_min'] ?>">
      </div>
    </div>

    <label for="image">Image principale <?= $actualite['image_principale'] ? '(actuelle : ' . esc($actualite['image_principale']) . ')' : '' ?></label>
    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
    <p style="font-size:0.82rem; opacity:.7; margin-top:-12px;">Compressez vos images avant import (JPEG optimisé, &lt; 300 Ko recommandé) pour la vitesse du site et l'éligibilité Google Ad Grants.</p>
  </div>

  <div class="admin-card" style="border-left: 4px solid #1F4E79;">
    <h3><?= icon('heart', 'nav-icon') ?> Appel à l'action (CTA) — obligatoire sur chaque actualité</h3>
    <p style="font-size:0.88rem; opacity:.75;">Choisissez un modèle de CTA. Les champs ci-dessous sont facultatifs : laissez-les vides pour utiliser le texte par défaut du modèle, ou personnalisez-les pour cette actualité précise.</p>

    <label for="cta_modele_id">Modèle de CTA</label>
    <select id="cta_modele_id" name="cta_modele_id" required>
      <?php foreach ($ctaModeles as $m): ?>
        <option value="<?= $m['id'] ?>" <?= $actualite['cta_modele_id'] == $m['id'] ? 'selected' : '' ?>><?= esc($m['nom']) ?></option>
      <?php endforeach; ?>
    </select>

    <label for="cta_titre">Titre personnalisé (facultatif)</label>
    <input type="text" id="cta_titre" name="cta_titre" value="<?= esc($actualite['cta_titre'] ?? '') ?>">

    <label for="cta_texte">Texte personnalisé (facultatif)</label>
    <textarea id="cta_texte" name="cta_texte" style="min-height:70px; font-family:inherit;"><?= esc($actualite['cta_texte'] ?? '') ?></textarea>

    <div class="row">
      <div>
        <label for="cta_bouton_texte">Texte du bouton (facultatif)</label>
        <input type="text" id="cta_bouton_texte" name="cta_bouton_texte" value="<?= esc($actualite['cta_bouton_texte'] ?? '') ?>">
      </div>
      <div>
        <label for="cta_bouton_lien">Lien du bouton (facultatif)</label>
        <input type="text" id="cta_bouton_lien" name="cta_bouton_lien" value="<?= esc($actualite['cta_bouton_lien'] ?? '') ?>">
      </div>
    </div>
  </div>

  <div class="admin-card">
    <h3>Publication</h3>
    <div class="row">
      <div>
        <label for="statut">Statut</label>
        <select id="statut" name="statut">
          <option value="brouillon" <?= $actualite['statut'] === 'brouillon' ? 'selected' : '' ?>>Brouillon</option>
          <option value="publie" <?= $actualite['statut'] === 'publie' ? 'selected' : '' ?>>Publié</option>
        </select>
      </div>
      <div>
        <label for="date_publication">Date de publication</label>
        <input type="datetime-local" id="date_publication" name="date_publication" value="<?= esc($actualite['date_publication']) ?>">
      </div>
    </div>
    <button type="submit" class="btn btn-primary"><?= icon('save', 'nav-icon') ?> Enregistrer</button>
    <a class="btn btn-secondary" href="<?= site_url('admin/actualites') ?>">Annuler</a>
  </div>
</form>
<?= $this->endSection() ?>

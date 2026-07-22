<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1><?= $enfant['id'] ? "Éditer l'enfant" : "Nouvel enfant" ?></h1>

<?php if ($erreur ?? null): ?><div class="lel-alert lel-alert-error"><?= esc($erreur) ?></div><?php endif; ?>

<form class="admin-form" method="post" action="<?= $enfant['id'] ? site_url('admin/enfants/' . $enfant['id']) : site_url('admin/enfants') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="admin-card">
    <h3>Profil de l'enfant</h3>
    <div class="row">
      <div>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="<?= esc($enfant['prenom']) ?>" required>
      </div>
      <div>
        <label for="matricule">Matricule</label>
        <input type="text" id="matricule" name="matricule" value="<?= esc($enfant['matricule'] ?? '') ?>" maxlength="5" placeholder="Ex. : A01" style="text-transform:uppercase;">
      </div>
      <div>
        <label for="age">Âge</label>
        <input type="number" id="age" name="age" min="0" max="25" value="<?= esc($enfant['age'] ?? '') ?>">
      </div>
      <div>
        <label for="classe">Classe</label>
        <input type="text" id="classe" name="classe" value="<?= esc($enfant['classe']) ?>" placeholder="Ex. : CE1-CE2" required>
      </div>
    </div>

    <label for="photo">Photo de profil <?= $enfant['photo'] ? '(actuelle : ' . esc($enfant['photo']) . ')' : '' ?></label>
    <input type="file" id="photo" name="photo" accept=".jpg,.jpeg,.png,.webp">
    <p style="font-size:0.82rem; opacity:.7; margin-top:-12px;">Photo au format portrait de préférence, compressée avant import (&lt; 300 Ko recommandé).</p>

    <label for="anecdote">Anecdote (courte histoire affichée sur sa fiche, quelques phrases)</label>
    <textarea id="anecdote" name="anecdote" style="min-height:90px; font-family:inherit;" maxlength="1000"><?= esc($enfant['anecdote'] ?? '') ?></textarea>

    <label for="lien_parrainage">Lien de parrainage (page HelloAsso dédiée à cet enfant)</label>
    <input type="url" id="lien_parrainage" name="lien_parrainage" value="<?= esc($enfant['lien_parrainage']) ?>" placeholder="https://www.helloasso.com/associations/...">
    <p style="font-size:0.82rem; opacity:.7; margin-top:-12px;">Facultatif : à laisser vide si l'enfant est déjà parrainé.</p>
  </div>

  <div class="admin-card">
    <h3>Suivi du parrain (usage interne, non affiché sur le site)</h3>
    <label for="parrain_email">Email du parrain (pour l'envoi des bulletins trimestriels)</label>
    <input type="email" id="parrain_email" name="parrain_email" value="<?= esc($enfant['parrain_email'] ?? '') ?>" placeholder="parrain@exemple.com">

    <label style="display:flex; align-items:center; gap:8px; font-weight:600; margin-top:10px;">
      <input type="checkbox" name="parrain_accepte_bulletin" value="1" <?= ! empty($enfant['parrain_accepte_bulletin']) ? 'checked' : '' ?>>
      Le parrain accepte de recevoir les bulletins trimestriels
    </label>
  </div>

  <div class="admin-card">
    <h3>Affichage sur la page publique</h3>
    <div class="row">
      <div>
        <label for="statut">Statut</label>
        <select id="statut" name="statut">
          <option value="disponible" <?= ($enfant['statut'] ?? 'disponible') === 'disponible' ? 'selected' : '' ?>>Disponible au parrainage</option>
          <option value="parraine" <?= ($enfant['statut'] ?? '') === 'parraine' ? 'selected' : '' ?>>Déjà parrainé(e)</option>
        </select>
      </div>
      <div>
        <label for="ordre">Ordre d'affichage (les plus petits d'abord)</label>
        <input type="number" id="ordre" name="ordre" min="0" value="<?= (int) $enfant['ordre'] ?>">
      </div>
      <div>
        <label for="actif">Visibilité</label>
        <select id="actif" name="actif">
          <option value="1" <?= $enfant['actif'] ? 'selected' : '' ?>>Actif — visible sur le site</option>
          <option value="0" <?= ! $enfant['actif'] ? 'selected' : '' ?>>Masqué</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-primary"><?= icon('save', 'nav-icon') ?> Enregistrer</button>
    <a class="btn btn-secondary" href="<?= site_url('admin/enfants') ?>">Annuler</a>
  </div>
</form>
<?= $this->endSection() ?>

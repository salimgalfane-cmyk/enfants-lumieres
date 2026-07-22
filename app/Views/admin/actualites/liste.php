<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">Actualités</h1>
  <a class="btn btn-primary" href="<?= site_url('admin/actualites/create') ?>"><?= icon('plus', 'nav-icon') ?> Nouvelle actualité</a>
</div>

<?php if (session('supprime')): ?>
  <div class="lel-alert lel-alert-success">Actualité supprimée.</div>
<?php endif; ?>
<?php if (session('enregistre')): ?>
  <div class="lel-alert lel-alert-success">Actualité enregistrée.</div>
<?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead>
      <tr><th>Titre</th><th>Catégorie</th><th>Statut</th><th>Vues</th><th>Date</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach ($actualites as $a): ?>
      <tr>
        <td><?= esc($a['titre']) ?></td>
        <td><?= esc($a['categorie_nom'] ?? '—') ?></td>
        <td><span class="badge badge-<?= $a['statut'] === 'publie' ? 'publie' : 'brouillon' ?>"><?= $a['statut'] === 'publie' ? 'Publié' : 'Brouillon' ?></span></td>
        <td><?= (int) $a['vues'] ?></td>
        <td><?= esc(formatDateFr($a['date_publication'] ?: $a['cree_le'])) ?></td>
        <td>
          <a class="btn btn-secondary" href="<?= site_url('admin/actualites/' . $a['id'] . '/edit') ?>">Éditer</a>
          <a class="btn btn-secondary" href="<?= site_url('actualite/' . $a['slug']) ?>" target="_blank">Voir</a>
          <a class="btn btn-danger" href="<?= site_url('admin/actualites/' . $a['id'] . '/delete') ?>" onclick="return confirm('Supprimer définitivement cette actualité ?');">Suppr.</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (! $actualites): ?><tr><td colspan="6">Aucune actualité pour le moment.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>

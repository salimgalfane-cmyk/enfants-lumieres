<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">Enfants à parrainer</h1>
  <a class="btn btn-primary" href="<?= site_url('admin/enfants/create') ?>"><?= icon('plus', 'nav-icon') ?> Nouvel enfant</a>
</div>

<?php if (session('supprime')): ?>
  <div class="lel-alert lel-alert-success">Enfant supprimé.</div>
<?php endif; ?>
<?php if (session('enregistre')): ?>
  <div class="lel-alert lel-alert-success">Enfant enregistré.</div>
<?php endif; ?>

<div class="admin-card">
  <p style="font-size:0.88rem; opacity:.75; margin-top:0;">Ces enfants s'affichent sur la page publique <a href="<?= site_url('parrainage') ?>" target="_blank">Parrainage</a>, dans l'ordre indiqué ci-dessous. Seuls les enfants « Actif » sont visibles.</p>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Photo</th>
        <th><?= lelTriLien('admin/enfants', 'prenom', 'Prénom', $tri, $direction) ?></th>
        <th><?= lelTriLien('admin/enfants', 'matricule', 'Matricule', $tri, $direction) ?></th>
        <th><?= lelTriLien('admin/enfants', 'age', 'Âge', $tri, $direction) ?></th>
        <th><?= lelTriLien('admin/enfants', 'classe', 'Classe', $tri, $direction) ?></th>
        <th><?= lelTriLien('admin/enfants', 'ordre', 'Ordre', $tri, $direction) ?></th>
        <th><?= lelTriLien('admin/enfants', 'statut', 'Parrainage', $tri, $direction) ?></th>
        <th>Bulletins</th>
        <th><?= lelTriLien('admin/enfants', 'actif', 'Visibilité', $tri, $direction) ?></th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($enfants as $e): ?>
      <tr>
        <td><img src="<?= esc($e['photo'] ?: base_url('assets/uploads/placeholder.jpg')) ?>" alt="" style="width:44px; height:44px; border-radius:50%; object-fit:cover; display:block;"></td>
        <td><?= esc($e['prenom']) ?></td>
        <td><?= $e['matricule'] ? esc($e['matricule']) : '—' ?></td>
        <td><?= $e['age'] !== null ? (int) $e['age'] . ' ans' : '—' ?></td>
        <td><?= esc($e['classe']) ?></td>
        <td><?= (int) $e['ordre'] ?></td>
        <td><span class="badge badge-<?= $e['statut'] === 'parraine' ? 'publie' : 'brouillon' ?>"><?= $e['statut'] === 'parraine' ? 'Déjà parrainé' : 'Disponible' ?></span></td>
        <td>
          <?php if ($e['statut'] === 'parraine'): ?>
            <?php if (! empty($e['parrain_accepte_bulletin']) && ! empty($e['parrain_email'])): ?>
              <span class="badge badge-publie" title="<?= esc($e['parrain_email']) ?>">OK</span>
            <?php elseif (! empty($e['parrain_email'])): ?>
              <span class="badge badge-brouillon" title="Email renseigné mais accord non coché">En attente</span>
            <?php else: ?>
              <span style="opacity:.5;">—</span>
            <?php endif; ?>
          <?php else: ?>
            <span style="opacity:.3;">—</span>
          <?php endif; ?>
        </td>
        <td><span class="badge badge-<?= $e['actif'] ? 'publie' : 'brouillon' ?>"><?= $e['actif'] ? 'Actif' : 'Masqué' ?></span></td>
        <td>
          <a class="btn btn-secondary" href="<?= site_url('admin/enfants/' . $e['id'] . '/edit') ?>">Éditer</a>
          <a class="btn btn-danger" href="<?= site_url('admin/enfants/' . $e['id'] . '/delete') ?>" onclick="return confirm('Supprimer définitivement cet enfant ?');">Suppr.</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (! $enfants): ?><tr><td colspan="10">Aucun enfant pour le moment.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>

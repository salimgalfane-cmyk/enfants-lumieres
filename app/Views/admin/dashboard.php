<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">Tableau de bord</h1>
  <span>Bonjour, <?= esc($admin['nom']) ?></span>
</div>

<div class="row">
  <div class="admin-card"><h3>Actualités publiées</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['publiees'] ?></p></div>
  <div class="admin-card"><h3>Brouillons</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['brouillons'] ?></p></div>
  <div class="admin-card"><h3>Messages non lus</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['messages_non_lus'] ?></p></div>
  <div class="admin-card"><h3>Vues cumulées</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['total_vues'] ?></p></div>
</div>

<div class="admin-card">
  <h3>Actions rapides</h3>
  <a class="btn btn-primary" href="<?= site_url('admin/actualites/create') ?>"><?= icon('plus', 'nav-icon') ?> Publier une actualité</a>
  <a class="btn btn-secondary" href="<?= site_url('admin/actualites') ?>"><?= icon('news', 'nav-icon') ?> Gérer les actualités</a>
  <a class="btn btn-secondary" href="<?= site_url('admin/contacts') ?>"><?= icon('mail', 'nav-icon') ?> Voir les messages</a>
</div>
<?= $this->endSection() ?>

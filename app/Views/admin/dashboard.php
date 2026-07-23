<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">Tableau de bord</h1>
  <span>Bonjour, <?= esc($admin['nom']) ?></span>
</div>

<div class="row">
  <div class="admin-card"><h3>Actualités publiées</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['publiees'] ?></p></div>
  <div class="admin-card"><h3>Brouillons</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['brouillons'] ?></p></div>
  <div class="admin-card">
    <h3>Messages non lus</h3>
    <p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['messages_non_lus'] ?></p>
    <p style="font-size:0.8rem;opacity:.6;margin:4px 0 0;"><?= (int) $totaux['messages_ce_mois'] ?> reçu(s) ce mois-ci</p>
  </div>
  <div class="admin-card"><h3>Vues cumulées</h3><p style="font-size:2rem;font-weight:700;margin:0;"><?= (int) $totaux['total_vues'] ?></p></div>
</div>

<div class="row">
  <div class="admin-card">
    <h3>Articles les plus vus</h3>
    <?php if ($topArticles): ?>
    <table class="admin-table">
      <tbody>
        <?php foreach ($topArticles as $a): ?>
        <tr>
          <td><a href="<?= site_url('actualite/' . $a['slug']) ?>" target="_blank"><?= esc($a['titre']) ?></a><br>
            <span style="font-size:0.78rem;opacity:.6;"><?= esc($a['categorie_nom'] ?? '—') ?></span></td>
          <td style="text-align:right;font-weight:700;white-space:nowrap;"><?= (int) $a['vues'] ?> vues</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="opacity:.6;">Pas encore de vues enregistrées.</p>
    <?php endif; ?>
  </div>
  <div class="admin-card">
    <h3>Vues par catégorie</h3>
    <?php if ($vuesParCategorie): ?>
    <table class="admin-table">
      <tbody>
        <?php foreach ($vuesParCategorie as $c): ?>
        <tr>
          <td><?= esc($c['categorie_nom'] ?? 'Sans catégorie') ?><br>
            <span style="font-size:0.78rem;opacity:.6;"><?= (int) $c['nb_articles'] ?> article(s)</span></td>
          <td style="text-align:right;font-weight:700;white-space:nowrap;"><?= (int) $c['total_vues'] ?> vues</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="opacity:.6;">Pas encore de vues enregistrées.</p>
    <?php endif; ?>
  </div>
</div>

<div class="admin-card">
  <h3>Actions rapides</h3>
  <a class="btn btn-primary" href="<?= site_url('admin/actualites/create') ?>"><?= icon('plus', 'nav-icon') ?> Publier une actualité</a>
  <a class="btn btn-secondary" href="<?= site_url('admin/actualites') ?>"><?= icon('news', 'nav-icon') ?> Gérer les actualités</a>
  <a class="btn btn-secondary" href="<?= site_url('admin/contacts') ?>"><?= icon('mail', 'nav-icon') ?> Voir les messages</a>
</div>
<?= $this->endSection() ?>

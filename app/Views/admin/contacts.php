<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">Messages reçus</h1>
  <a class="btn btn-secondary" href="<?= site_url('admin/ips-bloquees') ?>"><?= icon('eye', 'nav-icon') ?> IP bloquées</a>
</div>

<?php if (session('supprime')): ?>
  <div class="lel-alert lel-alert-success">Message supprimé.</div>
<?php endif; ?>
<?php if (session('bloque')): ?>
  <div class="lel-alert lel-alert-success">IP bloquée et message supprimé.</div>
<?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>Statut</th><th>Nom</th><th>Email</th><th>IP</th><th>Sujet</th><th>Message</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($messages as $m): ?>
      <tr>
        <td><span class="badge badge-<?= $m['lu'] ? 'publie' : 'brouillon' ?>"><?= $m['lu'] ? 'Lu' : 'Nouveau' ?></span></td>
        <td><?= esc($m['nom']) ?></td>
        <td><a href="mailto:<?= esc($m['email']) ?>"><?= esc($m['email']) ?></a></td>
        <td style="font-size:0.82rem; opacity:.7;"><?= esc($m['ip_origine']) ?></td>
        <td><?= esc($m['sujet']) ?></td>
        <td style="max-width:280px;"><?= esc(mb_strimwidth($m['message'], 0, 120, '…')) ?></td>
        <td><?= esc(formatDateFr($m['recu_le'])) ?></td>
        <td>
          <?php if (! $m['lu']): ?><a class="btn btn-secondary" href="<?= site_url('admin/contacts/' . $m['id'] . '/marquer-lu') ?>">Marquer lu</a><?php endif; ?>
          <a class="btn btn-secondary" href="<?= site_url('admin/contacts/' . $m['id'] . '/delete') ?>" onclick="return confirm('Supprimer définitivement ce message ?');">Supprimer</a>
          <a class="btn btn-danger" href="<?= site_url('admin/contacts/' . $m['id'] . '/bloquer-ip') ?>" onclick="return confirm('Bloquer l\'IP ' + <?= json_encode($m['ip_origine']) ?> + ' et supprimer ce message ?');">Bloquer l'IP</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (! $messages): ?><tr><td colspan="8">Aucun message reçu.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>

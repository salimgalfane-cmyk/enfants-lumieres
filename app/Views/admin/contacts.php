<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1>Messages reçus</h1>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>Statut</th><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th><th>Date</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach ($messages as $m): ?>
      <tr>
        <td><span class="badge badge-<?= $m['lu'] ? 'publie' : 'brouillon' ?>"><?= $m['lu'] ? 'Lu' : 'Nouveau' ?></span></td>
        <td><?= esc($m['nom']) ?></td>
        <td><a href="mailto:<?= esc($m['email']) ?>"><?= esc($m['email']) ?></a></td>
        <td><?= esc($m['sujet']) ?></td>
        <td style="max-width:280px;"><?= esc(mb_strimwidth($m['message'], 0, 120, '…')) ?></td>
        <td><?= esc(formatDateFr($m['recu_le'])) ?></td>
        <td><?php if (! $m['lu']): ?><a class="btn btn-secondary" href="<?= site_url('admin/contacts/' . $m['id'] . '/marquer-lu') ?>">Marquer lu</a><?php endif; ?></td>
      </tr>
      <?php endforeach; ?>
      <?php if (! $messages): ?><tr><td colspan="7">Aucun message reçu.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>

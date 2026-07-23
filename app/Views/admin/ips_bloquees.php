<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-topbar">
  <h1 style="margin:0;">IP bloquées</h1>
  <a class="btn btn-secondary" href="<?= site_url('admin/contacts') ?>">Retour aux messages</a>
</div>

<div class="admin-card">
  <p style="font-size:0.88rem; opacity:.75; margin-top:0;">Une adresse IP bloquée ici ne peut plus envoyer de message via le formulaire de contact du site public.</p>
  <table class="admin-table">
    <thead><tr><th>IP</th><th>Raison</th><th>Bloquée le</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach ($ips as $i): ?>
      <tr>
        <td><?= esc($i['ip']) ?></td>
        <td><?= esc($i['raison'] ?: '(aucune)') ?></td>
        <td><?= esc(formatDateFr($i['bloque_le'])) ?></td>
        <td><a class="btn btn-secondary" href="<?= site_url('admin/ips-bloquees/' . $i['id'] . '/delete') ?>" onclick="return confirm('Débloquer cette IP ?');">Débloquer</a></td>
      </tr>
      <?php endforeach; ?>
      <?php if (! $ips): ?><tr><td colspan="4">Aucune IP bloquée.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>

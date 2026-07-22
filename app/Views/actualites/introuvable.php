<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <h1>Article introuvable</h1>
    <p>Cette actualité n'existe pas ou n'est plus disponible. <a href="<?= site_url('actualites') ?>">Retour aux actualités</a>.</p>
  </div>
</section>
<?= $this->endSection() ?>

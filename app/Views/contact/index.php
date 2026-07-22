<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <h1>Nous contacter</h1>
    <p class="lead">Une question, un projet, une envie de collaborer ? Écrivez-nous.</p>

    <?php if ($succes ?? false): ?>
      <div class="lel-alert lel-alert-success">Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.</div>
    <?php endif; ?>
    <?php if ($erreur ?? null): ?>
      <div class="lel-alert lel-alert-error"><?= esc($erreur) ?></div>
    <?php endif; ?>

    <form class="lel-form" method="post" action="<?= site_url('contact') ?>">
      <?= csrf_field() ?>
      <label for="nom">Nom complet</label>
      <input type="text" id="nom" name="nom" value="<?= esc(old('nom')) ?>" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" required>

      <label for="telephone">Téléphone (facultatif)</label>
      <input type="tel" id="telephone" name="telephone" value="<?= esc(old('telephone')) ?>">

      <label for="sujet">Sujet</label>
      <input type="text" id="sujet" name="sujet" value="<?= esc(old('sujet')) ?>">

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="6" required><?= esc(old('message')) ?></textarea>

      <button type="submit" class="lel-btn-primary">Envoyer le message</button>
    </form>
  </div>
</section>
<?= $this->endSection() ?>

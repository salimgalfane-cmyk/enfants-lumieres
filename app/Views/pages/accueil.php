<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-hero">
  <div class="lel-container">
    <span class="kicker">Association humanitaire · Dzahadjou, Comores</span>
    <h1>Allumer la flamme de <em>l'éducation</em> aux Comores</h1>
    <p class="lead">Nous croyons que chaque enfant comorien mérite une éducation de qualité qui respecte son rythme, sa culture et son potentiel. Depuis 2022, la Maison des Enfants Lumières transforme ce projet en réalité à Dzahadjou.</p>
    <div class="lel-hero-actions">
      <a class="lel-btn-primary" href="<?= site_url('parrainage') ?>">Parrainer un enfant</a>
      <a class="lel-btn-secondary" href="#notre-mission">Découvrir notre mission →</a>
    </div>

    <div class="lel-stats">
      <div><div class="stat-num">86</div><div class="stat-label">élèves accueillis en 2025-2026</div></div>
      <div><div class="stat-num">3 ans</div><div class="stat-label">d'existence et de croissance</div></div>
      <div><div class="stat-num">37%</div><div class="stat-label">de filles scolarisées</div></div>
      <div><div class="stat-num">1<sup>re</sup></div><div class="stat-label">école pilote Montessori à Dzahadjou</div></div>
    </div>
  </div>
</section>

<section class="lel-section" id="notre-mission">
  <div class="lel-container">
    <div class="lel-mission">
      <div>
        <h2>Notre mission</h2>
        <p>Les Enfants Lumières est une association humanitaire franco-comorienne fondée en 2022. Nous croyons que chaque enfant comorien mérite un accès à une éducation de qualité, quels que soient son lieu de naissance ou les moyens de sa famille.</p>
        <p>C'est cette conviction qui nous a menés à Dzahadjou, un village de Badjini Est en Grande Comore où aucune école de proximité n'existait avant l'ouverture de la Maison des Enfants Lumières en juillet 2022. Depuis, l'école a grandi avec le village, et le village a grandi avec elle.</p>
      </div>
      <div class="lel-mission-box">
        <h3>Notre pédagogie</h3>
        <p>École pilote Montessori et nature, la Maison des Enfants Lumières respecte le rythme de chaque enfant et l'ancre dans son environnement culturel et naturel comorien plutôt que de plaquer un modèle importé.</p>
        <a href="<?= site_url('nos-actions') ?>">Découvrir nos projets →</a>
      </div>
    </div>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <h2>Ce que nous faisons</h2>
    <div class="lel-features">
      <div class="lel-feature">
        <div class="feature-icon"><?= icon('school') ?></div>
        <h3>École pilote à Dzahadjou</h3>
        <p>La Maison des Enfants Lumières accueille les enfants du village dans une pédagogie Montessori et nature, adaptée aux réalités comoriennes.</p>
        <a class="feature-link" href="<?= site_url('nos-actions') ?>">Nos projets →</a>
      </div>
      <div class="lel-feature">
        <div class="feature-icon"><?= icon('userplus') ?></div>
        <h3>Parrainage</h3>
        <p>Chaque parrainage assure la scolarité complète d'un enfant à la Maison des Enfants Lumières, mois après mois.</p>
        <a class="feature-link" href="<?= site_url('parrainage') ?>">Parrainer un enfant →</a>
      </div>
      <div class="lel-feature">
        <div class="feature-icon"><?= icon('link') ?></div>
        <h3>Partenariats</h3>
        <p>Le projet Lumin'Îles, porté avec l'AFD et Expertise France, vient renforcer durablement notre impact à Dzahadjou.</p>
        <a class="feature-link" href="<?= site_url('nos-actions') ?>">En savoir plus →</a>
      </div>
      <div class="lel-feature">
        <div class="feature-icon"><?= icon('users') ?></div>
        <h3>Bénévolat</h3>
        <p>Vous avez du temps, des compétences ou des idées à partager ? Rejoignez l'aventure Les Enfants Lumières.</p>
        <a class="feature-link" href="<?= site_url('contact') ?>">Nous contacter →</a>
      </div>
    </div>
  </div>
</section>

<section class="lel-section">
  <div class="lel-container">
    <h2>Dernières actualités</h2>
    <div class="lel-grid-articles">
      <?php foreach ($dernieresActus as $actu): ?>
      <a class="lel-card" href="<?= site_url('actualite/' . $actu['slug']) ?>" style="color:inherit;">
        <img src="<?= esc($actu['image_principale'] ?: base_url('assets/uploads/placeholder.jpg')) ?>" alt="<?= esc($actu['titre']) ?>">
        <div class="lel-card-body">
          <span class="meta"><?= icon($actu['categorie_icone']) ?> <?= esc($actu['categorie_nom']) ?></span>
          <h3><?= esc($actu['titre']) ?></h3>
          <p><?= esc($actu['extrait']) ?></p>
          <span class="lire-plus">Lire plus →</span>
        </div>
      </a>
      <?php endforeach; ?>
      <?php if (! $dernieresActus): ?>
        <p>Aucune actualité publiée pour le moment. Rendez-vous bientôt !</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php if ($ctaModeles): ?>
<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <h2>Comment nous soutenir</h2>
    <div class="lel-cta-grid">
      <?php foreach ($ctaModeles as $cta): ?>
      <div class="lel-cta-card">
        <div class="cta-card-icon"><?= icon($cta['icone']) ?></div>
        <h3><?= esc($cta['nom']) ?></h3>
        <p><?= esc($cta['texte_defaut']) ?></p>
        <a href="<?= esc($cta['bouton_lien_defaut']) ?>"<?= str_starts_with($cta['bouton_lien_defaut'], 'http') ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($cta['bouton_texte_defaut']) ?> →</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="lel-section">
  <div class="lel-container">
    <div class="lel-cta">
      <div class="cta-icon"><?= icon('heart') ?></div>
      <div class="cta-content">
        <h3>Faites partie de l'impact</h3>
        <p>Chaque parrainage assure la scolarité d'un enfant. Chaque don construit l'école de demain.</p>
      </div>
      <a class="lel-btn-primary" href="https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3" target="_blank" rel="noopener">Faire un don</a>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

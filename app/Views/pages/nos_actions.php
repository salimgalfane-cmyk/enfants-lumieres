<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <span class="kicker">Nos projets</span>
    <h1>Deux projets, une même conviction</h1>
    <p class="lead">Scolariser un enfant à Dzahadjou et libérer le temps de sa mère sont, pour nous, un seul et même combat. C'est ce qui relie notre école pilote à notre participation au projet régional Lumin'Îles.</p>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <div class="lel-project">
      <div class="lel-project-media">
        <div class="project-icon"><?= icon('school') ?></div>
        <h3 style="margin-top:16px;">La Maison des Enfants Lumières</h3>
        <p style="margin:0; opacity:.85;">École pilote Montessori et nature, ouverte à Dzahadjou en juillet 2022.</p>
      </div>
      <div>
        <h2>Une école pensée pour Dzahadjou, pas plaquée sur Dzahadjou</h2>
        <p>La Maison des Enfants Lumières rompt avec le modèle scolaire traditionnel : des espaces d'apprentissage ouverts et flexibles, où les enfants explorent et interagissent avec leur environnement plutôt que de rester assis face à un tableau. La pédagogie Montessori, réputée pour son respect du rythme de chaque enfant, y est complétée par un éveil à la nature qui s'appuie sur l'environnement comorien comme terrain d'apprentissage.</p>
        <div class="lel-pillars">
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('leaf') ?></div>
            <div>
              <h4>Pédagogie active et ancrée dans la nature</h4>
              <p>Montessori adapté aux réalités culturelles et environnementales des Comores, pas importé tel quel.</p>
            </div>
          </div>
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('users') ?></div>
            <div>
              <h4>Une école pensée pour l'inclusion</h4>
              <p>Programmes et infrastructures conçus pour accueillir tous les enfants, quelles que soient leurs capacités.</p>
            </div>
          </div>
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('home') ?></div>
            <div>
              <h4>Ancrée dans la vie du village</h4>
              <p>Parents et habitants de Dzahadjou sont associés à la vie scolaire, pas seulement informés de son existence.</p>
            </div>
          </div>
        </div>
        <p><a href="<?= site_url('actualite/ecole-pilote-la-maison-des-enfants-lumieres-a-dzahadjou-un-modele-educatif-unique-aux-comores') ?>">Lire l'histoire de l'école pilote →</a></p>
      </div>
    </div>
  </div>
</section>

<section class="lel-section">
  <div class="lel-container">
    <div class="lel-project lel-project-reverse">
      <div>
        <h2>Lumin'Îles : quand l'émancipation des femmes éclaire l'avenir des enfants</h2>
        <p>Le 25 février 2026, Les Enfants Lumières participaient au lancement officiel du projet Lumin'Îles à l'Hôtel Retaj, à Moroni, en présence de la Ministre comorienne de la Promotion du Genre et de l'Ambassadeur de France aux Comores. Ce projet régional, financé par l'Agence Française de Développement (AFD) et mis en œuvre par Expertise France, se déploie simultanément aux Comores, à Madagascar et à Maurice.</p>
        <div class="lel-countries">
          <span>Comores</span>
          <span>Madagascar</span>
          <span>Maurice</span>
        </div>
        <p>Sa conviction rejoint la nôtre : l'accès des femmes au travail est indissociable de la qualité de l'accueil de leurs enfants. Notre participation au volet garde d'enfants du projet conforte un objectif que nous portons depuis plusieurs mois — l'ouverture d'une crèche à Dzahadjou, une première dans ce village rural du nord de la Grande Comore.</p>
        <p><a href="<?= site_url('actualite/projet-luminiles') ?>">Lire le récit complet du lancement →</a></p>
      </div>
      <div class="lel-project-media">
        <div class="lel-launch-card">
          <div class="lel-launch-date">
            <div class="day">25</div>
            <div class="month">Fév. 2026</div>
          </div>
          <div>
            <strong>Lancement officiel de Lumin'Îles</strong>
            <p style="margin:4px 0 0; font-size:.88rem; opacity:.8;">Hôtel Retaj, Moroni — Union des Comores</p>
          </div>
        </div>
        <div class="lel-pillars">
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('graduation') ?></div>
            <div>
              <h4>Professionnalisation de la petite enfance</h4>
              <p>Partager notre modèle pédagogique pour structurer le secteur.</p>
            </div>
          </div>
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('person') ?></div>
            <div>
              <h4>Autonomisation des femmes</h4>
              <p>Un accueil sécurisé des enfants pour libérer le temps économique des mères.</p>
            </div>
          </div>
          <div class="lel-pillar">
            <div class="pillar-icon"><?= icon('link') ?></div>
            <div>
              <h4>Dialogue institutionnel</h4>
              <p>Échanger avec les pouvoirs publics pour renforcer les politiques d'égalité.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <div class="lel-cta cta-green-mid">
      <div class="cta-icon"><?= icon('mega') ?></div>
      <div class="cta-content">
        <h3>Suivez l'avancée de nos projets</h3>
        <p>École pilote, Lumin'Îles, future crèche de Dzahadjou : toutes les étapes sont racontées dans nos actualités.</p>
      </div>
      <a class="lel-btn-primary" href="<?= site_url('actualites') ?>">Voir les actualités</a>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

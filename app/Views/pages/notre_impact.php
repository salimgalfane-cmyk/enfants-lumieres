<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container">
    <span class="kicker">Notre impact</span>
    <h1>Un village qui change, un enfant à la fois</h1>
    <p class="lead">Depuis juillet 2022, la Maison des Enfants Lumières n'a pas seulement ouvert une école : elle a transformé le quotidien de Dzahadjou. Voici ce qui a changé, avec des faits plutôt que des promesses.</p>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <h2>Dzahadjou, avant et après</h2>
    <div class="lel-compare">
      <div class="lel-compare-card before">
        <h3>Avant 2022</h3>
        <ul>
          <li>Pas d'école maternelle dans le village</li>
          <li>Plusieurs kilomètres à parcourir pour scolariser un enfant</li>
          <li>Les filles souvent maintenues à la maison</li>
          <li>Aucun emploi pédagogique local</li>
          <li>Aucun espace collectif dédié aux enfants</li>
          <li>Les mères sans possibilité de travailler le matin</li>
        </ul>
      </div>
      <div class="lel-compare-card after">
        <h3>Aujourd'hui</h3>
        <ul>
          <li>École maternelle et primaire ouverte dans le village</li>
          <li>86 enfants scolarisés à 5 minutes à pied</li>
          <li>37 % de filles, en hausse chaque année</li>
          <li>8 emplois locaux créés</li>
          <li>Un espace scolaire réhabilité, sûr et accueillant</li>
          <li>Des mères libérées le matin pour travailler</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="lel-section">
  <div class="lel-container">
    <div class="lel-stat-band">
      <div>
        <div class="num">514 %</div>
        <div class="label">de croissance des effectifs en 3 ans (14 → 86 élèves)</div>
      </div>
      <div>
        <div class="num">73 %</div>
        <div class="label">de nouveaux inscrits à la rentrée 2025, sans démarchage de l'association</div>
      </div>
      <div>
        <div class="num">8</div>
        <div class="label">emplois locaux créés, stables et qualifiés</div>
      </div>
    </div>
  </div>
</section>

<section class="lel-section lel-section-alt">
  <div class="lel-container">
    <h2>Six dimensions d'un impact qui dépasse les murs de l'école</h2>
    <p class="lead" style="max-width:760px;">L'impact d'une école dans un village rural ne se mesure pas seulement au nombre d'élèves. Il se mesure aux transformations qui se produisent dans les familles, dans les habitudes, dans les ambitions.</p>
    <div class="lel-dimensions">
      <div class="lel-dimension">
        <div class="dim-num">01</div>
        <h3>L'accès à l'éducation</h3>
        <p>Des enfants qui n'allaient pas à l'école y vont désormais. Une croissance portée par la confiance des familles, pas par la communication.</p>
      </div>
      <div class="lel-dimension">
        <div class="dim-num">02</div>
        <h3>L'émancipation des mères</h3>
        <p>Libérées des contraintes de garde le matin, les mères de Dzahadjou peuvent travailler, se former ou s'impliquer dans la vie collective.</p>
      </div>
      <div class="lel-dimension">
        <div class="dim-num">03</div>
        <h3>La scolarisation des filles</h3>
        <p>De moins d'un tiers des effectifs en 2022 à 37 % en 2025 : chaque fille inscrite ouvre la porte à la suivante.</p>
      </div>
      <div class="lel-dimension">
        <div class="dim-num">04</div>
        <h3>Des emplois locaux qualifiés</h3>
        <p>8 emplois directs — enseignantes, assistants d'éducation, personnel — avec des formations régulières aux pédagogies Montessori et nature.</p>
      </div>
      <div class="lel-dimension">
        <div class="dim-num">05</div>
        <h3>Une cohésion communautaire</h3>
        <p>Plusieurs parents d'élèves sont devenus des relais actifs de l'association, aidant à identifier les familles dans le besoin.</p>
      </div>
      <div class="lel-dimension">
        <div class="dim-num">06</div>
        <h3>Un rayonnement au-delà de Dzahadjou</h3>
        <p>La Maison des Enfants Lumières reçoit aujourd'hui des demandes de familles de villages voisins souhaitant y inscrire leurs enfants.</p>
      </div>
    </div>
    <p><a href="<?= site_url('actualite/dzahadjou-trois-ans-apres') ?>">Lire le récit complet, trois ans après →</a></p>
  </div>
</section>

<section class="lel-section">
  <div class="lel-container">
    <div class="lel-cta">
      <div class="cta-icon"><?= icon('heart') ?></div>
      <div class="cta-content">
        <h3>Derrière chaque chiffre, un enfant</h3>
        <p>Cet impact, nous voulons continuer à le documenter, le renforcer et le faire grandir avec vous.</p>
      </div>
      <a class="lel-btn-primary" href="https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3" target="_blank" rel="noopener">Faire un don</a>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

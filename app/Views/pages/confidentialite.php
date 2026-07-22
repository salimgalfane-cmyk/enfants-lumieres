<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="lel-section">
  <div class="lel-container" style="max-width: 820px;">
    <span class="kicker">Informations légales</span>
    <h1>Politique de confidentialité</h1>
    <p class="lead">Cette page explique quelles données Les Enfants Lumières collecte sur ce site, pourquoi, et comment vous pouvez exercer vos droits.</p>

    <div class="lel-article-content">
      <h2>1. Qui sommes-nous ?</h2>
      <p>Le responsable du traitement des données collectées sur ce site est l'association <strong>Les Enfants Lumières</strong>, association humanitaire franco-comorienne, domiciliée au 42 Avenue des Alliés, 91120 Palaiseau, France. Association loi 1901 déclarée en préfecture de l'Essonne — <a href="https://www.journal-officiel.gouv.fr/pages/associations-detail-annonce/?q.id=id:202200351510" target="_blank" rel="noopener" style="text-decoration:underline; color:var(--green-mid); font-weight:600;">Journal Officiel du 30 août 2022, annonce n° 1510</a>. Pour toute question, vous pouvez nous écrire à <a href="mailto:contact@enfants-lumieres.com">contact@enfants-lumieres.com</a>.</p>

      <h2>2. Données que nous collectons</h2>
      <p>Nous collectons des données personnelles dans deux situations :</p>
      <ul>
        <li><strong>Le formulaire de contact</strong> : nom, adresse email, téléphone (facultatif), sujet et message, ainsi que l'adresse IP à l'origine de l'envoi (à des fins de sécurité et de lutte contre les abus).</li>
        <li><strong>La navigation sur le site</strong> : si vous acceptez les cookies de mesure publicitaire (voir section 4), des données de navigation sont transmises à Google Ads.</li>
      </ul>
      <p>Nous ne collectons aucune donnée bancaire : les dons et parrainages sont traités directement par notre partenaire HelloAsso, qui dispose de sa propre politique de confidentialité.</p>

      <h2>3. Pourquoi nous les collectons</h2>
      <p>Les données du formulaire de contact sont utilisées uniquement pour répondre à votre demande. Elles sont conservées le temps nécessaire au traitement de votre message, puis archivées ou supprimées dans un délai raisonnable. La base légale de ce traitement est l'intérêt légitime de l'association à pouvoir échanger avec les personnes qui la contactent.</p>
      <p>Les données de navigation liées à Google Ads sont utilisées pour mesurer l'efficacité de nos campagnes de sensibilisation (savoir si une visite provient d'une annonce, et si elle a mené à un parrainage ou un don). La base légale de ce traitement est votre <strong>consentement</strong>, recueilli via la bannière affichée lors de votre première visite.</p>

      <h2>4. Cookies utilisés sur ce site</h2>
      <table class="lel-table" style="margin: 16px 0;">
        <thead>
          <tr><th>Cookie</th><th>Finalité</th><th>Durée</th><th>Soumis à consentement ?</th></tr>
        </thead>
        <tbody>
          <tr><td><code>lel_consent</code></td><td>Mémorise votre choix (accepté/refusé) concernant les cookies publicitaires</td><td>6 mois</td><td>Non — strictement nécessaire</td></tr>
          <tr><td><code>ci_session</code></td><td>Fonctionnement technique du site (session, formulaires)</td><td>Session</td><td>Non — strictement nécessaire</td></tr>
          <tr><td>Cookies Google Ads (<code>_gcl_*</code>, etc.)</td><td>Mesure de l'efficacité des campagnes publicitaires Google Ads</td><td>Jusqu'à 90 jours</td><td><strong>Oui</strong></td></tr>
        </tbody>
      </table>
      <p>Les cookies Google Ads ne sont déposés que si vous cliquez sur « Accepter » dans la bannière de cookies. Vous pouvez à tout moment modifier votre choix en cliquant sur « Gérer les cookies » en bas de chaque page.</p>

      <h2>5. Avec qui partageons-nous ces données ?</h2>
      <ul>
        <li><strong>Google Ireland Limited</strong> (Google Ads) : uniquement si vous avez accepté les cookies publicitaires, pour la mesure d'audience de nos campagnes.</li>
        <li><strong>HelloAsso</strong> : lorsque vous cliquez sur un bouton de don ou de parrainage, vous êtes redirigé vers leur plateforme, qui traite vos données de paiement selon sa propre politique de confidentialité.</li>
      </ul>
      <p>Nous ne vendons ni ne louons vos données personnelles à des tiers.</p>

      <h2>6. Vos droits</h2>
      <p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de rectification, d'effacement, d'opposition et de portabilité sur vos données personnelles. Pour exercer ces droits, contactez-nous à <a href="mailto:contact@enfants-lumieres.com">contact@enfants-lumieres.com</a>. Vous disposez également du droit d'introduire une réclamation auprès de la <a href="https://www.cnil.fr" target="_blank" rel="noopener">CNIL</a> (Commission Nationale de l'Informatique et des Libertés).</p>

      <h2>7. Sécurité</h2>
      <p>Nous mettons en œuvre les mesures techniques raisonnables pour protéger vos données contre l'accès non autorisé, la perte ou la divulgation.</p>

      <h2>8. Modifications de cette politique</h2>
      <p>Cette politique peut être mise à jour périodiquement, notamment pour refléter l'évolution du site ou de la réglementation. La date de dernière mise à jour figure ci-dessous.</p>
      <p style="opacity:.7; font-size:0.88rem;">Dernière mise à jour : juillet 2026.</p>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

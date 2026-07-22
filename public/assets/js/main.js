(function () {
  var toggle = document.getElementById('navToggle');
  var nav = document.getElementById('mainNav');
  if (!toggle || !nav) return;
  toggle.addEventListener('click', function () {
    nav.classList.toggle('is-open');
  });
})();

(function () {
  var tabBtns = document.querySelectorAll('.lel-tab-btn');
  if (!tabBtns.length) return;
  tabBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var cible = btn.getAttribute('data-tab');
      tabBtns.forEach(function (b) { b.classList.toggle('active', b === btn); });
      document.querySelectorAll('.lel-tab-panel').forEach(function (panel) {
        panel.hidden = panel.getAttribute('data-panel') !== cible;
      });
    });
  });
})();

// Bannière de consentement cookies : les cookies Google Ads ne sont posés qu'après acceptation explicite (RGPD).
(function () {
  function lelSetCookie(nom, valeur, jours) {
    var expires = '';
    if (jours) {
      var date = new Date();
      date.setTime(date.getTime() + (jours * 24 * 60 * 60 * 1000));
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = nom + '=' + valeur + expires + '; path=/; SameSite=Lax';
  }

  function lelGetCookie(nom) {
    var match = document.cookie.match(new RegExp('(^| )' + nom + '=([^;]+)'));
    return match ? match[2] : null;
  }

  function lelActiverGoogleAds() {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function () { dataLayer.push(arguments); };
    gtag('consent', 'update', {
      'ad_storage': 'granted',
      'ad_user_data': 'granted',
      'ad_personalization': 'granted',
      'analytics_storage': 'granted'
    });
  }

  var banniere = document.getElementById('cookieBanner');
  if (!banniere) return;

  var consentement = lelGetCookie('lel_consent');
  if (consentement === 'accepte') {
    lelActiverGoogleAds();
  } else if (consentement !== 'refuse') {
    banniere.hidden = false;
  }

  var btnAccepter = document.getElementById('cookieAccepter');
  var btnRefuser = document.getElementById('cookieRefuser');
  var lienGerer = document.getElementById('cookieGerer');

  if (btnAccepter) {
    btnAccepter.addEventListener('click', function () {
      lelSetCookie('lel_consent', 'accepte', 180);
      banniere.hidden = true;
      lelActiverGoogleAds();
    });
  }
  if (btnRefuser) {
    btnRefuser.addEventListener('click', function () {
      lelSetCookie('lel_consent', 'refuse', 180);
      banniere.hidden = true;
    });
  }
  if (lienGerer) {
    lienGerer.addEventListener('click', function (e) {
      e.preventDefault();
      banniere.hidden = false;
    });
  }
})();

# CLAUDE.md

Ce fichier donne à Claude Code le contexte pour ce projet. Il doit rester à la racine du dépôt.

> Copie synchronisée manuellement avec le `CLAUDE.md` du dossier parent local (`100 - enfantsLumieres/`), qui contient en plus l'ancien site PHP procédural (non versionné, conservé comme archive locale hors du dépôt Git). Ce dossier `lel-site-ci4/` est la racine du dépôt Git/GitHub (`salimgalfane-cmyk/enfants-lumieres`, public).

## État actuel (mise à jour la plus récente)

**La migration vers CodeIgniter 4 est terminée et en production.** Le plan de migration en 13 étapes ci-dessous est conservé comme référence historique (conventions suivies, architecture retenue) mais n'est plus le plan d'action courant. **La priorité actuelle est le backlog** (section "Ce qui reste à faire", plus bas).

Résumé de ce qui a été fait après la bascule initiale :
- Contenu réel migré depuis l'ancien WordPress (8 actualités), icônes emoji remplacées par un système d'icônes SVG cohérent (back-office, catégories publiques, CTA, et jusque dans le contenu des articles migrés).
- Page d'accueil étoffée (sections « Notre mission », « Ce que nous faisons », « Comment nous soutenir » — cette dernière alimentée dynamiquement depuis `cta_modeles`).
- Pages **Nos projets** et **Notre impact** rédigées avec du contenu réel (chronologie de croissance de l'école, chiffres, six dimensions d'impact).
- Page **À propos** retirée (route, contrôleur, vue, liens de navigation) : son contenu de mission a été absorbé par la page d'accueil, elle est jugée superflue.
- Logo réel et `favicon.ico` en place (remplacent le placeholder).
- État actif du menu de navigation, largeur de page uniformisée sur tout le site.
- Bascule en production faite sur `enfants-lumieres.com` ; l'ancien site WordPress est conservé intact dans un répertoire serveur séparé et non référencé (`sites/enfants.lumieres/`), donc pas de suppression nécessaire côté hébergement.
- Bugs corrigés en cours de route : `app.baseURL` mal configuré (prod pointait vers preprod juste après bascule), images d'articles en URL absolue codée vers preprod, liens de CTA cassés (anciennes URLs WordPress), TypeError sur `Admin\Auth::login()`.
- **Module Parrainage complet** : table `enfants_parrainage` (prénom, âge, classe, photo, anecdote, lien HelloAsso par enfant, statut disponible/parrainé, ordre, actif), CRUD admin `Admin\Enfants`, page publique avec grille adaptative (`repeat(auto-fit, ...)`, tient sur une ligne quel que soit le nombre d'enfants) et onglets « Enfants à parrainer » / « Enfants déjà parrainés ». Mention de consentement parental ajoutée en bas de page. **Le backlog "contenu réel de la page Parrainage" est donc terminé.**
- Bouton « Faire un don » du menu remis en valeur (couleur ambre dédiée, icône cœur, ombre) après correction d'un bug de spécificité CSS (`.lel-nav a` écrasait le padding de `.lel-btn-don`) ; lien de don HelloAsso basculé sur `formulaires/3` partout (code et données).
- Nouvel article publié : « Google Ad Grants : une reconnaissance officielle pour Les Enfants Lumières » (catégorie Partenariats, illustré avec de vraies photos de la Galerie).
- Images ajoutées ou remplacées sur deux articles migrés qui n'en avaient pas ou dépendaient d'une URL WordPress fragile : « La Pédagogie Nature » et « École Pilote... à Dzahadjou ».
- Page Parrainage : prix « 25 €/mois » affiché (intro + chaque carte enfant) ; champ « Lien de parrainage » rendu optionnel en admin pour les enfants déjà parrainés (colonne DB toujours `NOT NULL` mais chaîne vide acceptée).
- Fiche enfant (admin) enrichie de deux champs internes, jamais affichés publiquement : `matricule` (identifiant unique, 5 caractères max, normalisé en majuscules, contrainte `UNIQUE` en base) et suivi du parrain (`parrain_email` + case à cocher « accepte de recevoir les bulletins trimestriels »), avec une colonne « Bulletins » dans la liste admin pour repérer rapidement qui contacter chaque trimestre.
- Article « Rentrée scolaire 2025-2026 » entièrement réécrit : l'ancienne version embarquait un bloc de statistiques custom (barres, donut chart) qui cassait le design du site (bandeau vert du header qui débordait) ; remplacé par du HTML standard du design system, nouvelle photo, CTA basculé sur « Faire un don ». Date de publication d'origine conservée.
- Référencement de la page Parrainage retravaillé pour aligner le site sur une campagne Google Ads (titre, meta description et texte d'intro enrichis avec « Comores », « Dzahadjou », « 25€/mois », « association humanitaire franco-comorienne »).
- **Conformité RGPD** : bannière de consentement cookies (Accepter/Refuser, choix mémorisé 6 mois via cookie `lel_consent`, lien « Gérer les cookies » en pied de page) + nouvelle page `politique-de-confidentialite`. La balise Google Ads (`gtag.js`, ID `AW-18337544236`) est chargée en permanence sur toutes les pages publiques mais implémentée en **Consent Mode v2** (`consent default` = tout refusé) : elle ne pose de cookies qu'après un `consent update` déclenché par l'acceptation de la bannière, ce qui satisfait à la fois la détection automatique de Google Ads et le RGPD.
- Suivi de conversion Google Ads configuré : une action « Clic sortant » couvrant tout `enfants-lumieres.com` marquée Principale (sert à l'optimisation des enchères), une seconde plus restrictive repassée en Secondaire pour éviter le double comptage.
- Références au Journal Officiel (déclaration loi 1901, JO du 30 août 2022, annonce n° 1510) ajoutées en pied de page et sur la page politique de confidentialité, avec lien vers l'annonce officielle, mises en couleur (vert clair sur le footer sombre, vert soutenu sur la page claire) et soulignées pour bien signaler qu'il s'agit de liens cliquables.
- **CI/CD mis en place** : dépôt Git dédié, `lel-site-ci4/` comme racine (l'ancien site procédural du dossier parent n'est pas versionné, dépôt GitHub public). Un push sur `main` déclenche `.github/workflows/deploy.yml` : `composer install --no-dev` sur le runner puis déploiement automatique par **FTPS** (pas SFTP — l'action `FTP-Deploy-Action` ne supporte pas le SSH malgré le nom des secrets `SFTP_*`) vers `/sites/enfants-lumieres/lel-site-ci4/` sur Infomaniak. Secrets stockés dans un **environnement GitHub** dédié (`enfants-lumieres.com`), pas en secrets de dépôt classiques — le job déclare `environment: enfants-lumieres.com` pour y avoir accès. Remplace le dépôt FTP manuel qui reste documenté en fallback dans le `README.md`. Les migrations de base de données restent manuelles, volontairement non automatisées dans le pipeline. Pipeline testé et validé sur plusieurs déploiements réels depuis sa mise en place.
- **Tri par colonne** sur la liste admin « Enfants à parrainer » (Prénom, Matricule, Âge, Classe, Ordre, Parrainage, Visibilité) : clic sur l'en-tête pour trier, second clic pour inverser le sens (flèche ▲/▼). Tri côté back-office uniquement (query string `?tri=&dir=`), sans impact sur l'ordre d'affichage public (toujours géré par le champ `ordre`).
- **Lien « Notre impact »** ajouté à la navigation du footer public (il manquait).
- **Deux articles migrés de WordPress corrigés en profondeur** (images cassées + contenu pauvre) :
  - « Dzahadjou, trois ans après » : le corps de l'article embarquait un bloc HTML/CSS custom migré tel quel de WordPress (comme « Rentrée scolaire 2025-2026 » avant lui) — 6 images cassées vers d'anciennes URLs WordPress, texte peu contrasté, CTA obsolète dupliquant celui généré automatiquement par le site. Réécrit avec les composants du design system existant (`.lel-stats`, `.lel-compare`, `.lel-dimensions`, `.lel-alert`). **Deux nouveaux composants réutilisables ajoutés à `style.css`** : `.lel-timeline` (frise chronologique à puces reliées par une ligne) et `.lel-photo-pair` (duo de photos avant/après, responsive). Contenu illustré de vraies photos de la Galerie, appariées intérieur/intérieur et extérieur/extérieur pour les comparaisons avant/après travaux.
  - « La Pédagogie Nature : Une Méthode Innovante » : 3 images cassées (mêmes anciennes URLs WordPress). Article étoffé de ~450 à ~790 mots, restructuré autour de **3 sorties scolaires réelles et distinctes** (plage — géologie volcanique et pêche traditionnelle ; marché du village — biodiversité marine et économie locale ; campagne — élevage et écosystème rural), chacune illustrée par des photos authentiques du dossier « Sorties Scolaires » de la Galerie et reliée à des exemples concrets d'apprentissage. Utilise le composant `.lel-photo-pair`. Temps de lecture mis à jour (2 → 4 min).
  - **Point de vigilance non traité** : d'autres actualités migrées de WordPress ont probablement encore des images cassées dans le corps du contenu (seule l'image d'en-tête `image_principale` avait été systématiquement corrigée jusqu'ici) — pas d'audit complet effectué, à vérifier au cas par cas si signalé.

⚠️ Point de config connu et volontairement laissé tel quel : le `.env` de **preprod** pointe vers le domaine de production (`app.baseURL`) suite à un dernier dépôt de fichiers — preprod reste visuellement fonctionnel mais ses liens internes renvoient vers la prod. Ne pas s'en étonner si on retravaille sur preprod plus tard.

## Vue d'ensemble du projet

Site vitrine de l'association humanitaire **Les Enfants Lumières (LEL)**, association franco-comorienne fondée en 2022 qui gère la **Maison des Enfants Lumières (MEL)**, école pilote Montessori/nature à Dzahadjou, Badjini Est, Grande Comore.

Site en production : https://enfants-lumieres.com

Une première version avait été construite en PHP procédural natif (sans framework) pour remplacer un site WordPress + WPBakery devenu inmaintenable (WPBakery force `display:block`/`width:100%` sur les colonnes, casse les grilles CSS/Flexbox, empêche l'injection propre de code dans le footer). Cette version procédurale a servi de référence pour la **migration vers CodeIgniter 4**, désormais terminée et en production (voir "État actuel" et décision d'architecture ci-dessous).

## Décision d'architecture : migration vers CodeIgniter 4

Après comparaison de Laravel, Symfony et CodeIgniter 4 pour un hébergement mutualisé Infomaniak (FTP-only, pas de SSH garanti, trafic modéré d'un site associatif) :

- **CodeIgniter 4** est retenu : overhead par requête le plus faible des frameworks complets, structure MVC simple, ORM/Query Builder, validation et sessions intégrées, déploiement compatible FTP (on fait `composer install` en local puis on upload le dossier `vendor/`, aucun accès SSH requis).
- Laravel et Symfony sont écartés : overhead nettement plus élevé par requête (le conteneur de services de Laravel en particulier), complexité de configuration disproportionnée pour la taille du projet.
- Le gain principal attendu n'est **pas** la vitesse brute (le PHP procédural actuel n'a par définition aucun overhead de framework et reste, en pur temps de réponse, aussi rapide sinon plus), mais la **structure, la testabilité et la facilité de reprise** du projet par un autre développeur dans le futur.

## Plan de migration (historique — les 13 étapes sont terminées)

Conservé comme référence : décrit comment le site a été construit et pourquoi (conventions, architecture). Chaque étape a été validée en local avant la suivante, conformément à la règle initiale. Ne sert plus de plan d'action.

### Étape 1 — Installer CodeIgniter 4
```bash
composer create-project codeigniter4/appstarter lel-site-ci4
cd lel-site-ci4
```
Vérifier la version PHP disponible chez Infomaniak (8.1 minimum requis par CodeIgniter 4) avant de figer la version dans `composer.json`.

### Étape 2 — Configurer l'environnement
- Copier `env` vers `.env`, définir `CI_ENVIRONMENT = production` (ou `development` en local).
- Renseigner `app.baseURL` = `https://enfants-lumieres.com`.
- Renseigner les identifiants base de données dans `.env` (`database.default.*`) : hôte, nom de base, utilisateur, mot de passe fournis par le Manager Infomaniak.
- Fixer le fuseau horaire sur `Indian/Comoro` dans `app.config` ou `.env` (`app.appTimezone`).

### Étape 3 — Recréer le schéma via des migrations CodeIgniter
Le fichier `sql/schema.sql` de la version actuelle contient la référence exacte des tables à reproduire. Créer une migration par table dans `app/Database/Migrations/` :
- `CreateAdmins` : id, nom, email (unique), mot_de_passe_hash, role (enum admin/redacteur), derniere_connexion, actif, cree_le.
- `CreateCategories` : id, nom, slug (unique), icone.
- `CreateCtaModeles` : id, code (unique), nom, icone, titre_defaut, texte_defaut, bouton_texte_defaut, bouton_lien_defaut, couleur, actif.
- `CreateActualites` : reproduire fidèlement les colonnes existantes, en particulier `cta_modele_id` (clé étrangère **obligatoire**, `ON DELETE RESTRICT`), `categorie_id` (`ON DELETE SET NULL`), `auteur_id` (`ON DELETE SET NULL`), `statut` (enum brouillon/publie), `date_publication`, `vues`.
- `CreateMessagesContact` : id, nom, email, telephone, sujet, message, lu, ip_origine, recu_le.

Ajouter un Seeder (`app/Database/Seeds/`) qui reprend telles quelles les données de départ de `sql/schema.sql` : les 5 modèles de CTA (don, parrainage, benevolat, newsletter, contact) avec leurs textes par défaut, les 6 catégories, et le compte admin par défaut (email `contact@enfants-lumieres.com`, mot de passe temporaire `ChangezMoi2026!` à hasher avec `password_hash()`, à faire changer immédiatement après la première connexion).

Exécuter : `php spark migrate` puis `php spark db:seed InitialSeeder`.

### Étape 4 — Créer les Models
Dans `app/Models/` :
- `ActualiteModel` (table `actualites`) : méthodes `getPubliees($limit, $offset, $categorieId = null)`, `getParSlug($slug)` (incrémente les vues), `slugUnique($base, $excludeId = null)`.
- `CtaModeleModel` (table `cta_modeles`).
- `CategorieModel` (table `categories`).
- `MessageContactModel` (table `messages_contact`).
- `AdminModel` (table `admins`), avec vérification bcrypt via `password_verify()`.

**Important : centraliser la résolution du CTA dans une seule méthode**, par exemple `ActualiteModel::resolveCta(array $actualite): array`, qui reproduit exactement la logique de l'actuel `resolveCta()` dans `includes/functions.php` : va chercher le modèle CTA lié, applique les surcharges par article (`cta_titre`, `cta_texte`, `cta_bouton_texte`, `cta_bouton_lien`) si elles sont renseignées, sinon retombe sur les valeurs par défaut du modèle. **Ne jamais dupliquer cette logique dans les vues ou les contrôleurs.**

### Étape 5 — Recréer les vues et le layout
Dans `app/Views/` :
- `layouts/public.php` : reprend le HTML de `includes/header.php` + `includes/footer.php`, avec `$this->renderSection('content')` pour le contenu de page.
- `layouts/admin.php` : reprend `admin/includes/admin-header.php` + `admin-footer.php`, palette navy distincte (`--navy: #1F4E79`, `--medblue: #2E75B6`).
- `partials/cta_block.php` : reprend `includes/cta-block.php`, reçoit un tableau `$actualite` et appelle `ActualiteModel::resolveCta()`.
- Une vue par page publique (`pages/accueil.php`, `pages/nos_actions.php`, `pages/notre_impact.php`, `pages/parrainage.php`, `actualites/liste.php`, `actualites/detail.php`, `contact/index.php`). *(La page `apropos.php` a existé puis a été retirée — voir "État actuel".)*
- Vues admin (`admin/login.php`, `admin/dashboard.php`, `admin/actualites/liste.php`, `admin/actualites/formulaire.php`, `admin/contacts.php`).

Utiliser l'échappement natif de CodeIgniter (`esc()`) à la place de l'actuel `e()` maison.

### Étape 6 — Créer les Controllers et les routes
Dans `app/Controllers/` :
- `Pages` : `index()`, `nosActions()`, `notreImpact()`, `parrainage()`.
- `Actualites` : `index()` (liste + pagination), `show($slug)` (détail + incrément vues).
- `Contact` : `index()` (affiche le formulaire), `store()` (traite le POST, valide, enregistre en base).
- `Admin\Auth` : `login()`, `attempt()`, `logout()`.
- `Admin\Dashboard` : `index()` (statistiques : publiées, brouillons, messages non lus, vues cumulées).
- `Admin\Actualites` : `index()`, `create()`, `edit($id)`, `store()`, `update($id)`, `delete($id)`.
- `Admin\Contacts` : `index()`, `marquerLu($id)`.

Déclarer les routes correspondantes dans `app/Config/Routes.php`, en conservant des URLs équivalentes à l'existant (`/actualites`, `/actualite/{slug}`, `/contact`, `/admin/...`) pour ne pas casser les liens déjà partagés/indexés.

### Étape 7 — Authentification et sécurité back-office
- Créer un Filter `app/Filters/AdminAuthFilter.php` équivalent à l'actuel `requireLogin()`, appliqué à toutes les routes `admin/*` sauf `admin/login`.
- Utiliser la Session library native de CodeIgniter (`session()`) à la place des accès directs à `$_SESSION`.
- Conserver `password_hash()` / `password_verify()` pour les mots de passe admin (pas de changement ici).
- Activer la protection CSRF native de CodeIgniter (`app.config` → `CSRFProtection`) sur tous les formulaires POST, à la place de l'actuel `csrfToken()`/`csrfCheck()` maison.
- Reproduire la validation d'upload d'image (extensions `jpg/jpeg/png/webp`, taille max 4 Mo) avec la Validation library de CodeIgniter plutôt qu'à la main.

### Étape 8 — Assets et fichiers publics
- CodeIgniter sert les fichiers depuis `public/` : déplacer `assets/css/style.css`, `assets/js/main.js` et le contenu de `assets/uploads/` vers `public/assets/`.
- Adapter `UPLOAD_PATH`/`UPLOAD_URL` en constantes ou entrées `.env`, réutilisées dans `ActualiteModel` pour l'upload d'image.
- Conserver le `.htaccess` anti-exécution PHP dans `public/assets/uploads/actualites/`.
- Recréer `robots.txt` (statique, dans `public/`) et un contrôleur `Sitemap` qui génère le XML dynamiquement à partir de `ActualiteModel` (reprendre la logique de l'actuel `sitemap.php`).

### Étape 9 — Design system
Copier tel quel le contenu de `assets/css/style.css` (tokens `:root`, composants `.lel-hero`, `.lel-stats`, `.lel-grid-articles`/`.lel-card`, `.lel-cta`, `.lel-form`, `.lel-alert`) : **aucune modification visuelle n'est demandée**, seule l'architecture change. Idem pour la palette back-office (navy/medblue), à garder strictement séparée de la palette publique (vert/crème).

### Étape 10 — Tests locaux
```bash
php spark serve
```
Vérifier : accueil, liste et détail actualités (avec CTA affiché), formulaire de contact (enregistrement + affichage dans `/admin/contacts`), login admin, création/édition/suppression d'une actualité avec upload d'image et choix de CTA, sitemap.php, robots.txt.

### Étape 11 — Adapter le déploiement Infomaniak
CodeIgniter attend que la racine web (document root) pointe vers le dossier `public/`, ce qui diffère de la version procédurale actuelle où tout est à la racine. Deux options à évaluer avec l'hébergement Infomaniak existant :
1. Si le Manager Infomaniak permet de configurer un dossier racine différent pour le site : pointer la racine vers `public/`.
2. Sinon (cas fréquent en mutualisé) : appliquer la méthode standard CodeIgniter pour hébergement sans contrôle du document root — déplacer le contenu de `public/` à la racine du site, et adapter les chemins `require` dans `index.php` en conséquence (voir la documentation officielle CodeIgniter 4, section déploiement en hébergement partagé).
Mettre à jour le `README.md` avec la procédure retenue une fois validée.

### Étape 12 — Import des données existantes
Si le site procédural a déjà des actualités publiées en production, exporter la table `actualites` (et `messages_contact` si pertinent) avant bascule, puis les réimporter dans la nouvelle base une fois les migrations CodeIgniter appliquées (les schémas de colonnes sont volontairement identiques pour simplifier ce transfert).

### Étape 13 — Bascule en production ✅ Faite
Déployée par copie FTP/SFTP, testée en conditions réelles sur `enfants-lumieres.com`. L'ancien site (WordPress, pas la version procédurale — voir "État actuel") n'a pas eu besoin d'être retiré : il vit dans un répertoire serveur séparé (`sites/enfants.lumieres/`) que plus aucun domaine ne référence, il sert donc déjà d'archive sur place.

## Arborescence cible (après migration)

```
app/
  Config/               # Routes.php, Database.php, Filters.php, App.php
  Controllers/           # Pages, Actualites, Contact, Admin/*
  Models/                # ActualiteModel, CtaModeleModel, CategorieModel, MessageContactModel, AdminModel
  Views/
    layouts/             # public.php, admin.php
    partials/            # cta_block.php
    pages/, actualites/, contact/, admin/
  Filters/               # AdminAuthFilter.php
  Database/
    Migrations/
    Seeds/
public/
  index.php              # point d'entrée CodeIgniter
  assets/css/style.css
  assets/js/main.js
  assets/uploads/actualites/
  robots.txt
.env
README.md
CLAUDE.md
```

L'étape 13 est validée : l'ancienne arborescence procédurale locale (`includes/`, `admin/`, `config/config.php`, `sql/schema.sql` à la racine du dépôt, si elle existe encore) peut être retirée dès qu'on le souhaite — elle ne sert plus que de référence historique.

## Objectifs métier à garder en tête (inchangés par la migration)

- Obtenir et conserver l'éligibilité **Google Ad Grants** : images compressées, navigation cohérente, CTA de don visible, articles de blog riches (800-1000 mots) avec CTA, sitemap/robots.txt propres.
- Chaque actualité publiée doit systématiquement intégrer un CTA (don, parrainage, bénévolat, newsletter, contact) pour convertir la visite en soutien concret. **Cette règle ne change pas avec la migration : elle doit rester appliquée au niveau du Model, pas du contrôleur ni de la vue.**
- Le back-office doit rester utilisable sans connaissances techniques par l'équipe de l'association.

## Conventions de code à suivre après migration

- **Langue** : code, commentaires et messages utilisateurs en **français**.
- Utiliser le Query Builder / les Models CodeIgniter plutôt que du PDO brut : ne pas réintroduire de requêtes SQL concaténées.
- Utiliser `esc()` pour tout affichage de donnée utilisateur, sauf `actualites.contenu` qui reste du HTML de confiance saisi en back-office par l'équipe.
- Utiliser la Validation library de CodeIgniter pour tous les formulaires (contact, actualité, login) plutôt que des vérifications manuelles éparpillées.
- Pas de nouvelle dépendance Composer hors de celles strictement nécessaires à la migration (pas d'ORM supplémentaire, pas de moteur de templating tiers : le moteur de vues natif de CodeIgniter suffit).
- Rester compatible hébergement mutualisé : pas de websockets, pas de file d'attente (queue) obligatoire, pas de tâche cron obligatoire côté code.

## Modèle de données (inchangé, voir Étape 3 pour la traduction en migrations)

- `actualites.cta_modele_id` reste **obligatoire** (clé étrangère `ON DELETE RESTRICT` vers `cta_modeles`). Les champs `cta_titre`, `cta_texte`, `cta_bouton_texte`, `cta_bouton_lien` restent des **surcharges optionnelles** (NULL = valeur par défaut du modèle).
- Ajouter un nouveau type de CTA doit rester une simple insertion dans `cta_modeles`, sans modification de code (le formulaire d'édition d'actualité doit continuer à lister dynamiquement tous les modèles actifs).

## Ce qui reste à faire (backlog — priorité actuelle)

- ✅ ~~Migrer le contenu réel de Nos projets / Notre impact~~ — fait, avec du contenu réel tiré des actualités migrées (chronologie de l'école, chiffres d'impact, récit Lumin'Îles).
- ✅ ~~Remplacer le logo placeholder~~ — fait, avec `favicon.ico`.
- ~~Migrer le contenu réel de la page À propos~~ — sans objet, la page a été retirée (contenu de mission absorbé par l'accueil).
- ✅ ~~Contenu réel de la page Parrainage~~ — fait, module complet (liste d'enfants à parrainer gérée en admin, onglet enfants déjà parrainés, mention de consentement parental).
- Ajouter une page Événements/Agenda (identifiée dans l'audit Google Ad Grants), sur le modèle du module Actualités.
- Envisager un tableau de bord de statistiques plus riche (les vues par actualité sont déjà trackées en base).

## Déploiement

Déploiement automatisé par CI/CD (GitHub Actions) : un push sur `main` du dépôt GitHub `salimgalfane-cmyk/enfants-lumieres` déclenche build (`composer install --no-dev`) puis déploiement FTPS vers `/sites/enfants-lumieres/lel-site-ci4/`. Voir `README.md` pour le détail du pipeline, les secrets requis (environnement GitHub `enfants-lumieres.com`), et la procédure manuelle de secours (encore valable pour les opérations hors pipeline comme les migrations de base de données). Toute modification doit être testée en local (`php spark serve`) avant d'être poussée. Le déploiement en preprod n'est pas garanti à jour (voir "État actuel" — `.env` de preprod pointe vers le domaine de production) et n'est pas couvert par le pipeline CI/CD (qui ne cible que la production) : privilégier un test local, sinon vérifier directement en production après déploiement.

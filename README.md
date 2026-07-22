# Les Enfants Lumières — site CodeIgniter 4

Site vitrine de l'association humanitaire **Les Enfants Lumières** (LEL), migré depuis une version PHP procédurale vers CodeIgniter 4. Voir `CLAUDE.md` à la racine du dépôt pour le contexte complet du projet et le plan de migration.

<!-- Test du pipeline CI/CD : ce commentaire vérifie que le workflow GitHub Actions déploie correctement après un merge sur main. Fichier non public (hors du dossier public/), aucun impact visible sur le site. -->

## Prérequis

- PHP **8.2 minimum** (requis par CodeIgniter 4.7.x — testé en local avec PHP 8.4.19).
- Composer.
- MySQL/MariaDB.

## Installation locale

```bash
composer install
cp env .env
```

Puis renseigner dans `.env` :
- `CI_ENVIRONMENT = development`
- `app.baseURL` (ex: `http://localhost:8080/`)
- `app.indexPage = ''` (URLs propres, sans `/index.php/` — le `.htaccess` de `public/` gère la réécriture)
- `database.default.*` (base locale)
- `encryption.key` (générer avec `php spark key:generate`)

Migrations et données initiales :

```bash
php spark migrate
php spark db:seed InitialSeeder
```

Lancer le serveur de dev :

```bash
php spark serve
```

Compte admin par défaut créé par le seeder : `contact@enfants-lumieres.com` / `ChangezMoi2026!` — **à changer immédiatement** après la première connexion en production.

## Déploiement sur Infomaniak

### CI/CD (méthode actuelle)

Un push sur la branche `main` du dépôt GitHub [`salimgalfane-cmyk/enfants-lumieres`](https://github.com/salimgalfane-cmyk/enfants-lumieres) déclenche automatiquement [`.github/workflows/deploy.yml`](.github/workflows/deploy.yml) :

1. Checkout du code.
2. `composer install --no-dev --optimize-autoploader` sur le runner GitHub (le dossier `vendor/` n'est jamais commité, il est régénéré à chaque déploiement).
3. Déploiement par **SFTP** (port 22, authentification par mot de passe) vers `/sites/enfants-lumieres/lel-site-ci4/` sur l'hébergement Infomaniak, via l'action `SamKirkland/FTP-Deploy-Action`. Seuls les fichiers modifiés sont transférés ; `.env*`, `vendor/`, et le contenu de `writable/` (cache, logs, session, uploads, debugbar) sont exclus du transfert pour ne jamais écraser l'état du serveur.

Secrets GitHub requis (`Settings > Secrets and variables > Actions` du dépôt) :
- `SFTP_SERVER` = `zi0g5.ftp.infomaniak.com`
- `SFTP_USERNAME` = `zi0g5_galfane`
- `SFTP_PASSWORD` = mot de passe FTP/SSH existant de cet utilisateur (Manager Infomaniak > Hébergement > FTP/SSH)

**Ce que le pipeline ne fait pas** : il ne touche jamais à la base de données. Les migrations/seeders restent une étape manuelle (voir "Point de vigilance" ci-dessous et le point 7 de la procédure manuelle) — un déploiement de code qui nécessite un changement de schéma doit être accompagné d'une exécution manuelle des migrations via un accès SSH ponctuel ou phpMyAdmin.

Le dépôt Git ne couvre que ce dossier `lel-site-ci4/` (racine du dépôt GitHub) : l'ancien site PHP procédural conservé dans le dossier parent local n'est pas versionné.

### Déploiement manuel (fallback / mise en route initiale)

Déploiement par copie **FTP/SFTP** directe, méthode utilisée avant la mise en place du CI/CD et qui reste valable en secours (ex. si GitHub Actions est indisponible, ou pour une opération ponctuelle hors pipeline comme les migrations de base de données).

### Racine web

Le Manager Infomaniak (Hébergement Web > site > paramètres) permet de définir un **dossier racine personnalisé** pour le site. C'est l'option retenue : on pointe la racine web vers le dossier `public/` de ce dépôt, sans avoir besoin de restructurer le projet. Le reste de l'arborescence (`app/`, `system/`, `vendor/`, `writable/`, `.env`) reste **hors de la racine web accessible publiquement**, ce qui est le comportement de sécurité par défaut de CodeIgniter 4.

### Procédure

1. **En local** : vérifier la version PHP disponible sur l'hébergement Infomaniak (Manager > PHP) et s'assurer qu'elle est ≥ 8.2 (idéalement aligner sur la même version en local et en prod pour éviter les surprises de compatibilité).
2. Lancer `composer install --no-dev --optimize-autoloader` en local pour générer un `vendor/` de production (sans les dépendances de dev comme PHPUnit).
3. Uploader par FTP/SFTP l'intégralité du projet (`app/`, `public/`, `system/` si vendoré séparément, `vendor/`, `writable/`, `.env`, `spark`, `composer.json`) vers le dossier du site sur Infomaniak.
4. Dans le Manager Infomaniak, configurer le **dossier racine du site** pour qu'il pointe vers le sous-dossier `public/` uploadé.
5. Créer/adapter le fichier `.env` **directement sur le serveur** (ne jamais committer le `.env` de production dans le dépôt) avec :
   - `CI_ENVIRONMENT = production`
   - `app.baseURL = 'https://enfants-lumieres.com/'`
   - `app.indexPage = ''`
   - `database.default.*` avec les identifiants fournis par le Manager Infomaniak (Hébergement Web > Bases de données)
   - `encryption.key` : générer une clé **différente** de celle utilisée en local (`php spark key:generate` en local puis copier la valeur, ou générer directement via un script ponctuel sur le serveur)
6. Vérifier les **permissions** du dossier `writable/` (et ses sous-dossiers `cache/`, `logs/`, `session/`, `uploads/`, `debugbar/`) : doivent être accessibles en écriture par le processus PHP (généralement 755 ou 775 selon la configuration Infomaniak).
7. Exécuter les migrations et le seeder sur la base de production. Sans accès SSH garanti, cela peut se faire :
   - via un accès SSH si le plan Infomaniak le permet, ou
   - via un script ponctuel exposé temporairement (à supprimer immédiatement après usage) qui appelle les migrations en interne, ou
   - via phpMyAdmin en import direct du schéma (moins recommandé, perd la traçabilité des migrations).
8. Tester en conditions réelles sur le nom de domaine : accueil, actualités, contact, login admin, sitemap.xml, robots.txt.
9. Ne retirer les anciens fichiers PHP procéduraux du serveur qu'une fois cette validation complète effectuée (voir Étape 13 du plan de migration).

### Point de vigilance

- Le compte admin par défaut du seeder doit être changé dès la première connexion en production.
- `.env` ne doit jamais être commité ni transmis autrement que directement sur le serveur.
- Prévoir des redirections 301 depuis les anciennes URLs `.php` (`/actualites.php`, `/actualite.php?slug=...`, etc.) si elles sont déjà indexées par Google, vers les nouvelles URLs propres (`/actualites`, `/actualite/{slug}`, ...).

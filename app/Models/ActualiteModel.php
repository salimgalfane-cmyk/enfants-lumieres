<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualiteModel extends Model
{
    protected $table         = 'actualites';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'titre',
        'slug',
        'extrait',
        'contenu',
        'image_principale',
        'categorie_id',
        'temps_lecture_min',
        'cta_modele_id',
        'cta_titre',
        'cta_texte',
        'cta_bouton_texte',
        'cta_bouton_lien',
        'statut',
        'auteur_id',
        'date_publication',
        'vues',
    ];

    /** Actualités publiées (date de publication passée), les plus récentes d'abord. */
    public function getPubliees(int $limit = 20, int $offset = 0, ?int $categorieId = null): array
    {
        $builder = $this->select('actualites.*, categories.nom AS categorie_nom, categories.icone AS categorie_icone')
            ->join('categories', 'categories.id = actualites.categorie_id', 'left')
            ->where('actualites.statut', 'publie')
            ->where('actualites.date_publication <=', date('Y-m-d H:i:s'));

        if ($categorieId !== null) {
            $builder->where('actualites.categorie_id', $categorieId);
        }

        return $builder->orderBy('actualites.date_publication', 'DESC')
            ->findAll($limit, $offset);
    }

    /**
     * Actualité publiée par son slug ; incrémente son compteur de vues, une fois par IP,
     * et seulement pour les visiteurs non connectés au back-office (vues admin exclues).
     */
    public function getParSlug(string $slug): ?array
    {
        $actualite = $this->select('actualites.*, categories.nom AS categorie_nom, categories.icone AS categorie_icone')
            ->join('categories', 'categories.id = actualites.categorie_id', 'left')
            ->where('actualites.slug', $slug)
            ->where('actualites.statut', 'publie')
            ->where('actualites.date_publication <=', date('Y-m-d H:i:s'))
            ->first();

        if ($actualite !== null && ! session('admin')) {
            $ipHash = hash('sha256', service('request')->getIPAddress());
            $db     = db_connect();

            $db->query(
                'INSERT INTO actualites_vues_ip (actualite_id, ip_hash, vu_le) VALUES (?, ?, ?)
                 ON DUPLICATE KEY UPDATE vu_le = vu_le',
                [$actualite['id'], $ipHash, date('Y-m-d H:i:s')]
            );

            if ($db->affectedRows() === 1) {
                $this->set('vues', 'vues + 1', false)->update($actualite['id']);
            }
        }

        return $actualite;
    }

    /** Génère un slug propre à partir d'un titre. */
    public function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text) ?: $text;
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        return $text ?: 'article';
    }

    /** Rend un slug unique dans la table actualites (hors id donné, pour l'édition). */
    public function slugUnique(string $baseSlug, ?int $excludeId = null): string
    {
        $slug = $baseSlug;
        $i    = 2;

        while (true) {
            $builder = $this->where('slug', $slug);
            if ($excludeId !== null) {
                $builder->where('id !=', $excludeId);
            }

            if ($builder->countAllResults() === 0) {
                return $slug;
            }

            $slug = $baseSlug . '-' . $i;
            $i++;
        }
    }

    /** Articles publiés les plus vus, du plus consulté au moins consulté. */
    public function getTopVues(int $limit = 5): array
    {
        return $this->select('actualites.titre, actualites.slug, actualites.vues, categories.nom AS categorie_nom')
            ->join('categories', 'categories.id = actualites.categorie_id', 'left')
            ->where('actualites.statut', 'publie')
            ->orderBy('actualites.vues', 'DESC')
            ->findAll($limit);
    }

    /** Vues cumulées et nombre d'articles publiés, groupés par catégorie. */
    public function getVuesParCategorie(): array
    {
        return $this->select('categories.nom AS categorie_nom, SUM(actualites.vues) AS total_vues, COUNT(actualites.id) AS nb_articles')
            ->join('categories', 'categories.id = actualites.categorie_id', 'left')
            ->where('actualites.statut', 'publie')
            ->groupBy('actualites.categorie_id')
            ->orderBy('total_vues', 'DESC')
            ->findAll();
    }

    /**
     * Résout le CTA d'une actualité : modèle lié + surcharges éventuelles.
     * Point d'entrée unique pour cette logique — ne pas la dupliquer ailleurs.
     */
    public function resolveCta(array $actualite): array
    {
        $modele = (new CtaModeleModel())->find($actualite['cta_modele_id']);

        if ($modele === null) {
            return [
                'icone'        => 'heart',
                'titre'        => 'Soutenez notre mission',
                'texte'        => 'Votre soutien fait la différence pour les enfants de Dzahadjou.',
                'bouton_texte' => 'Faire un don',
                'bouton_lien'  => 'https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3',
                'couleur'      => 'green-deep',
            ];
        }

        return [
            'icone'        => $modele['icone'],
            'titre'        => $actualite['cta_titre'] ?: $modele['titre_defaut'],
            'texte'        => $actualite['cta_texte'] ?: $modele['texte_defaut'],
            'bouton_texte' => $actualite['cta_bouton_texte'] ?: $modele['bouton_texte_defaut'],
            'bouton_lien'  => $actualite['cta_bouton_lien'] ?: $modele['bouton_lien_defaut'],
            'couleur'      => $modele['couleur'],
        ];
    }
}

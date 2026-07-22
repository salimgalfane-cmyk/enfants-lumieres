<?php

namespace App\Models;

use CodeIgniter\Model;

class CtaModeleModel extends Model
{
    protected $table         = 'cta_modeles';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'code',
        'nom',
        'icone',
        'titre_defaut',
        'texte_defaut',
        'bouton_texte_defaut',
        'bouton_lien_defaut',
        'couleur',
        'actif',
    ];

    /** Modèles de CTA actifs, pour peupler dynamiquement le formulaire d'édition d'actualité. */
    public function getActifs(): array
    {
        return $this->where('actif', 1)->orderBy('nom', 'ASC')->findAll();
    }
}

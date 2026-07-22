<?php

namespace App\Models;

use CodeIgniter\Model;

class EnfantParrainageModel extends Model
{
    protected $table         = 'enfants_parrainage';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'prenom',
        'matricule',
        'age',
        'classe',
        'photo',
        'anecdote',
        'lien_parrainage',
        'statut',
        'parrain_email',
        'parrain_accepte_bulletin',
        'actif',
        'ordre',
        'cree_le',
    ];

    /** Enfants actifs disponibles au parrainage, dans l'ordre choisi en back-office. */
    public function getDisponibles(): array
    {
        return $this->where('actif', 1)->where('statut', 'disponible')
            ->orderBy('ordre', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    /** Enfants actifs déjà parrainés, dans l'ordre choisi en back-office. */
    public function getParraines(): array
    {
        return $this->where('actif', 1)->where('statut', 'parraine')
            ->orderBy('ordre', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    public const COLONNES_TRIABLES = ['prenom', 'matricule', 'age', 'classe', 'ordre', 'statut', 'actif'];

    /** Tous les enfants, pour la liste back-office, triables par colonne. */
    public function getToutes(string $tri = 'ordre', string $direction = 'asc'): array
    {
        $colonne   = in_array($tri, self::COLONNES_TRIABLES, true) ? $tri : 'ordre';
        $direction = strtolower($direction) === 'desc' ? 'DESC' : 'ASC';

        return $this->orderBy($colonne, $direction)->orderBy('id', 'ASC')->findAll();
    }
}

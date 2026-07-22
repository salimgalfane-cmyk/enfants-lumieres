<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'email',
        'mot_de_passe_hash',
        'role',
        'derniere_connexion',
        'actif',
    ];

    /**
     * Vérifie les identifiants d'un admin actif et met à jour sa dernière connexion.
     * Retourne l'admin (sans le hash) si les identifiants sont valides, sinon null.
     */
    public function verifierIdentifiants(string $email, string $password): ?array
    {
        $admin = $this->where('email', $email)->where('actif', 1)->first();

        if (! $admin || ! password_verify($password, $admin['mot_de_passe_hash'])) {
            return null;
        }

        $this->update($admin['id'], ['derniere_connexion' => date('Y-m-d H:i:s')]);
        unset($admin['mot_de_passe_hash']);

        return $admin;
    }
}

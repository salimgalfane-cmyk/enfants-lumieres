<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageContactModel extends Model
{
    protected $table         = 'messages_contact';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'email',
        'telephone',
        'sujet',
        'message',
        'lu',
        'ip_origine',
    ];

    public function getRecents(): array
    {
        return $this->orderBy('recu_le', 'DESC')->findAll();
    }

    public function marquerLu(int $id): bool
    {
        return (bool) $this->update($id, ['lu' => 1]);
    }

    /** Nombre de messages reçus depuis le 1er du mois en cours. */
    public function getRecusCeMois(): int
    {
        return $this->where('recu_le >=', date('Y-m-01 00:00:00'))->countAllResults();
    }
}

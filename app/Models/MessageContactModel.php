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
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorieModel extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nom', 'slug', 'icone'];

    public function getToutes(): array
    {
        return $this->orderBy('nom', 'ASC')->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class IpBloqueeModel extends Model
{
    protected $table         = 'ips_bloquees';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['ip', 'raison', 'bloque_le'];

    /** Vérifie si une IP est actuellement bloquée. */
    public function estBloquee(string $ip): bool
    {
        return $this->where('ip', $ip)->countAllResults() > 0;
    }

    /** Toutes les IP bloquées, les plus récentes d'abord. */
    public function getToutes(): array
    {
        return $this->orderBy('bloque_le', 'DESC')->findAll();
    }

    /** Bloque une IP si elle ne l'est pas déjà (ignore silencieusement les doublons). */
    public function bloquer(string $ip, ?string $raison = null): void
    {
        if ($this->estBloquee($ip)) {
            return;
        }

        $this->insert([
            'ip'        => $ip,
            'raison'    => $raison,
            'bloque_le' => date('Y-m-d H:i:s'),
        ]);
    }
}

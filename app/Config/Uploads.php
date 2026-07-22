<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Chemins de stockage des images d'actualités.
 * Surchargeables via .env (uploads.path / uploads.url) si besoin sur l'hébergement cible.
 */
class Uploads extends BaseConfig
{
    /** Chemin disque absolu où déposer les images uploadées. */
    public string $path = FCPATH . 'assets/uploads/actualites';

    /** URL publique correspondante. */
    public string $url = 'assets/uploads/actualites';
}

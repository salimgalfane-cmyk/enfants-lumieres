<?php

namespace App\Controllers;

use App\Models\ActualiteModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sitemap extends BaseController
{
    private const PAGES_STATIQUES = [
        '/',
        'nos-actions',
        'notre-impact',
        'parrainage',
        'contact',
        'actualites',
    ];

    public function index(): ResponseInterface
    {
        $actualites = (new ActualiteModel())
            ->select('slug, modifie_le')
            ->where('statut', 'publie')
            ->where('date_publication <=', date('Y-m-d H:i:s'))
            ->findAll();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach (self::PAGES_STATIQUES as $page) {
            $xml .= '  <url><loc>' . esc(site_url($page === '/' ? '' : $page)) . '</loc></url>' . "\n";
        }

        foreach ($actualites as $actualite) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . esc(site_url('actualite/' . $actualite['slug'])) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . esc(date('Y-m-d', strtotime($actualite['modifie_le']))) . '</lastmod>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $this->response->setContentType('application/xml')->setBody($xml);
    }
}

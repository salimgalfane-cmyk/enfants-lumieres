<?php

namespace App\Controllers;

use App\Models\ActualiteModel;
use CodeIgniter\HTTP\ResponseInterface;

class Actualites extends BaseController
{
    public function index(): string
    {
        $model   = new ActualiteModel();
        $parPage = 9;
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));

        return view('actualites/liste', [
            'pageTitle' => 'Actualités — Les Enfants Lumières',
            'actus'     => $model->getPubliees($parPage, ($page - 1) * $parPage),
            'page'      => $page,
            'parPage'   => $parPage,
        ]);
    }

    public function show(string $slug): string
    {
        $actualite = (new ActualiteModel())->getParSlug($slug);

        if ($actualite === null) {
            $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);

            return view('actualites/introuvable', [
                'pageTitle' => 'Article introuvable — Les Enfants Lumières',
            ]);
        }

        return view('actualites/detail', [
            'pageTitle'       => $actualite['titre'] . ' — Les Enfants Lumières',
            'pageDescription' => $actualite['extrait'],
            'actualite'       => $actualite,
        ]);
    }
}

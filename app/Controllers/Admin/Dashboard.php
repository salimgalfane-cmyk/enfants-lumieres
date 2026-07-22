<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActualiteModel;
use App\Models\MessageContactModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $actualiteModel = new ActualiteModel();

        $totalVues = $actualiteModel->selectSum('vues')->first()['vues'] ?? 0;

        $totaux = [
            'publiees'         => $actualiteModel->where('statut', 'publie')->countAllResults(),
            'brouillons'       => $actualiteModel->where('statut', 'brouillon')->countAllResults(),
            'messages_non_lus' => (new MessageContactModel())->where('lu', 0)->countAllResults(),
            'total_vues'       => (int) $totalVues,
        ];

        return view('admin/dashboard', [
            'adminPageTitle' => 'Tableau de bord',
            'admin'          => session('admin'),
            'totaux'         => $totaux,
        ]);
    }
}

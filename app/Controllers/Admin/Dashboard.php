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
        $messageModel   = new MessageContactModel();

        $totalVues = $actualiteModel->selectSum('vues')->first()['vues'] ?? 0;

        $totaux = [
            'publiees'         => $actualiteModel->where('statut', 'publie')->countAllResults(),
            'brouillons'       => $actualiteModel->where('statut', 'brouillon')->countAllResults(),
            'messages_non_lus' => $messageModel->where('lu', 0)->countAllResults(),
            'total_vues'       => (int) $totalVues,
            'messages_ce_mois' => $messageModel->getRecusCeMois(),
        ];

        return view('admin/dashboard', [
            'adminPageTitle'     => 'Tableau de bord',
            'admin'              => session('admin'),
            'totaux'             => $totaux,
            'topArticles'        => $actualiteModel->getTopVues(5),
            'vuesParCategorie'   => $actualiteModel->getVuesParCategorie(),
        ]);
    }
}

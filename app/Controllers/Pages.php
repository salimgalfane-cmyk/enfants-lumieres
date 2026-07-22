<?php

namespace App\Controllers;

use App\Models\ActualiteModel;
use App\Models\CtaModeleModel;
use App\Models\EnfantParrainageModel;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('pages/accueil', [
            'pageTitle'       => "Les Enfants Lumières — Allumer la flamme de l'éducation aux Comores",
            'pageDescription' => "Depuis 2022, la Maison des Enfants Lumières transforme l'accès à l'éducation à Dzahadjou, Grande Comore.",
            'dernieresActus'  => (new ActualiteModel())->getPubliees(3),
            'ctaModeles'      => (new CtaModeleModel())->getActifs(),
        ]);
    }

    public function nosActions(): string
    {
        return view('pages/nos_actions', [
            'pageTitle' => 'Nos projets — Les Enfants Lumières',
        ]);
    }

    public function notreImpact(): string
    {
        return view('pages/notre_impact', [
            'pageTitle' => 'Notre impact — Les Enfants Lumières',
        ]);
    }

    public function parrainage(): string
    {
        $model = new EnfantParrainageModel();

        return view('pages/parrainage', [
            'pageTitle'         => 'Parrainer un enfant aux Comores — Les Enfants Lumières',
            'pageDescription'   => "Parrainez un enfant de la Maison des Enfants Lumières à Dzahadjou, Comores, pour 25€/mois : scolarité, matériel, repas et suivi inclus. Association humanitaire franco-comorienne.",
            'enfantsDisponibles' => $model->getDisponibles(),
            'enfantsParraines'   => $model->getParraines(),
        ]);
    }

    public function confidentialite(): string
    {
        return view('pages/confidentialite', [
            'pageTitle'       => 'Politique de confidentialité — Les Enfants Lumières',
            'pageDescription' => "Politique de confidentialité et gestion des cookies du site Les Enfants Lumières.",
        ]);
    }
}

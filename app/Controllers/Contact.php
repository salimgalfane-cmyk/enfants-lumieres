<?php

namespace App\Controllers;

use App\Models\IpBloqueeModel;
use App\Models\MessageContactModel;

class Contact extends BaseController
{
    private const MESSAGE_ERREUR_GENERIQUE = 'Votre message n\'a pas pu être envoyé. Merci de réessayer plus tard.';

    public function index(): string
    {
        return view('contact/index', [
            'pageTitle' => 'Nous contacter — Les Enfants Lumières',
        ]);
    }

    public function store(): string
    {
        $ip = $this->request->getIPAddress();

        if ((new IpBloqueeModel())->estBloquee($ip)) {
            return view('contact/index', [
                'pageTitle' => 'Nous contacter — Les Enfants Lumières',
                'erreur'    => self::MESSAGE_ERREUR_GENERIQUE,
            ]);
        }

        if (! service('throttler')->check(md5($ip), 3, MINUTE * 10)) {
            return view('contact/index', [
                'pageTitle' => 'Nous contacter — Les Enfants Lumières',
                'erreur'    => 'Trop de messages envoyés en peu de temps. Merci de réessayer dans quelques minutes.',
            ]);
        }

        $rules = [
            'nom'       => 'required|max_length[150]',
            'email'     => 'required|valid_email|max_length[190]',
            'telephone' => 'permit_empty|max_length[40]',
            'sujet'     => 'permit_empty|max_length[200]',
            'message'   => 'required',
        ];

        if (! $this->validate($rules)) {
            return view('contact/index', [
                'pageTitle' => 'Nous contacter — Les Enfants Lumières',
                'erreur'    => 'Merci de renseigner votre nom, un email valide et votre message.',
            ]);
        }

        (new MessageContactModel())->insert([
            'nom'        => $this->request->getPost('nom'),
            'email'      => $this->request->getPost('email'),
            'telephone'  => $this->request->getPost('telephone'),
            'sujet'      => $this->request->getPost('sujet'),
            'message'    => $this->request->getPost('message'),
            'ip_origine' => $ip,
        ]);

        return view('contact/index', [
            'pageTitle' => 'Nous contacter — Les Enfants Lumières',
            'succes'    => true,
        ]);
    }
}

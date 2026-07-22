<?php

namespace App\Controllers;

use App\Models\MessageContactModel;

class Contact extends BaseController
{
    public function index(): string
    {
        return view('contact/index', [
            'pageTitle' => 'Nous contacter — Les Enfants Lumières',
        ]);
    }

    public function store(): string
    {
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
            'ip_origine' => $this->request->getIPAddress(),
        ]);

        return view('contact/index', [
            'pageTitle' => 'Nous contacter — Les Enfants Lumières',
            'succes'    => true,
        ]);
    }
}

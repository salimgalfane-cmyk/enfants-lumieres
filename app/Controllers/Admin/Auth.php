<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session('admin')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/login');
    }

    public function attempt()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return view('admin/login', ['erreur' => 'Email ou mot de passe incorrect.']);
        }

        $admin = (new AdminModel())->verifierIdentifiants(
            $this->request->getPost('email'),
            $this->request->getPost('password')
        );

        if ($admin === null) {
            return view('admin/login', ['erreur' => 'Email ou mot de passe incorrect.']);
        }

        session()->regenerate();
        session()->set('admin', $admin);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->remove('admin');
        session()->regenerate();

        return redirect()->to('/admin/login');
    }
}

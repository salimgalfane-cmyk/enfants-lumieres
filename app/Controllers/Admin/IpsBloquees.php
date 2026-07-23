<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\IpBloqueeModel;

class IpsBloquees extends BaseController
{
    public function index(): string
    {
        return view('admin/ips_bloquees', [
            'adminPageTitle' => 'IP bloquées',
            'admin'          => session('admin'),
            'ips'            => (new IpBloqueeModel())->getToutes(),
        ]);
    }

    public function debloquer(int $id)
    {
        (new IpBloqueeModel())->delete($id);

        return redirect()->to('/admin/ips-bloquees');
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\IpBloqueeModel;
use App\Models\MessageContactModel;

class Contacts extends BaseController
{
    public function index(): string
    {
        return view('admin/contacts', [
            'adminPageTitle' => 'Messages reçus',
            'admin'          => session('admin'),
            'messages'       => (new MessageContactModel())->getRecents(),
        ]);
    }

    public function marquerLu(int $id)
    {
        (new MessageContactModel())->marquerLu($id);

        return redirect()->to('/admin/contacts');
    }

    public function supprimer(int $id)
    {
        (new MessageContactModel())->delete($id);

        return redirect()->to('/admin/contacts')->with('supprime', true);
    }

    public function bloquerIp(int $id)
    {
        $model   = new MessageContactModel();
        $message = $model->find($id);

        if ($message !== null && $message['ip_origine']) {
            (new IpBloqueeModel())->bloquer(
                $message['ip_origine'],
                'Bloquée depuis le message de ' . $message['nom'] . ' (' . $message['email'] . ')'
            );
            $model->delete($id);
        }

        return redirect()->to('/admin/contacts')->with('bloque', true);
    }
}

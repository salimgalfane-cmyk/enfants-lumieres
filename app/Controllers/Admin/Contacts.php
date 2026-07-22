<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
}

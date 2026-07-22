<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EnfantParrainageModel;

class Enfants extends BaseController
{
    private const DEFAUTS = [
        'id'              => null,
        'prenom'          => '',
        'matricule'       => '',
        'age'             => null,
        'classe'          => '',
        'photo'           => '',
        'anecdote'        => '',
        'lien_parrainage' => '',
        'statut'          => 'disponible',
        'parrain_email'   => '',
        'parrain_accepte_bulletin' => 0,
        'actif'           => 1,
        'ordre'           => 0,
    ];

    private const REGLES_VALIDATION = [
        'prenom'          => 'required|max_length[100]',
        'matricule'       => 'permit_empty|max_length[5]|regex_match[/^[A-Za-z0-9]+$/]',
        'age'             => 'permit_empty|is_natural|less_than_equal_to[25]',
        'classe'          => 'required|max_length[100]',
        'anecdote'        => 'permit_empty|max_length[1000]',
        'lien_parrainage' => 'permit_empty|max_length[255]|valid_url_strict',
        'statut'          => 'required|in_list[disponible,parraine]',
        'parrain_email'   => 'permit_empty|max_length[255]|valid_email',
        'photo'           => 'permit_empty|max_size[photo,4096]|ext_in[photo,jpg,jpeg,png,webp]|is_image[photo]',
    ];

    private function dossierUploads(): string
    {
        return FCPATH . 'assets/uploads/enfants';
    }

    public function index(): string
    {
        return view('admin/enfants/liste', [
            'adminPageTitle' => 'Enfants à parrainer',
            'admin'          => session('admin'),
            'enfants'        => (new EnfantParrainageModel())->getToutes(),
        ]);
    }

    public function create(): string
    {
        return view('admin/enfants/formulaire', [
            'adminPageTitle' => 'Nouvel enfant',
            'admin'          => session('admin'),
            'enfant'         => self::DEFAUTS,
        ]);
    }

    public function edit(int $id): string
    {
        $enfant = (new EnfantParrainageModel())->find($id);

        if ($enfant === null) {
            return redirect()->to('/admin/enfants');
        }

        return view('admin/enfants/formulaire', [
            'adminPageTitle' => "Éditer l'enfant",
            'admin'          => session('admin'),
            'enfant'         => $enfant,
        ]);
    }

    public function store()
    {
        return $this->enregistrer(null);
    }

    public function update(int $id)
    {
        return $this->enregistrer($id);
    }

    public function delete(int $id)
    {
        $model  = new EnfantParrainageModel();
        $enfant = $model->find($id);

        if ($enfant !== null) {
            $model->delete($id);

            if ($enfant['photo']) {
                $chemin = rtrim($this->dossierUploads(), '/') . '/' . basename($enfant['photo']);
                if (is_file($chemin)) {
                    @unlink($chemin);
                }
            }
        }

        return redirect()->to('/admin/enfants')->with('supprime', true);
    }

    private function enregistrer(?int $id)
    {
        $model = new EnfantParrainageModel();

        $reglesValidation = self::REGLES_VALIDATION;
        $reglesValidation['matricule'] .= $id !== null
            ? "|is_unique[enfants_parrainage.matricule,id,{$id}]"
            : '|is_unique[enfants_parrainage.matricule]';

        if (! $this->validate($reglesValidation)) {
            $enfant = $id !== null ? $model->find($id) : array_merge(self::DEFAUTS, $this->request->getPost());

            return view('admin/enfants/formulaire', [
                'adminPageTitle' => $id !== null ? "Éditer l'enfant" : 'Nouvel enfant',
                'admin'          => session('admin'),
                'enfant'         => $enfant,
                'erreur'         => implode(' ', $this->validator->getErrors()),
            ]);
        }

        $existant    = $id !== null ? $model->find($id) : null;
        $photoChemin = $existant['photo'] ?? null;

        $fichier = $this->request->getFile('photo');
        if ($fichier && $fichier->isValid() && ! $fichier->hasMoved()) {
            $dossier    = $this->dossierUploads();
            $nomFichier = $fichier->getRandomName();
            $fichier->move($dossier, $nomFichier);
            $photoChemin = base_url('assets/uploads/enfants/' . $nomFichier);
        }

        $age = $this->request->getPost('age');

        $donnees = [
            'prenom'          => trim((string) $this->request->getPost('prenom')),
            'matricule'       => strtoupper(trim((string) $this->request->getPost('matricule'))) ?: null,
            'age'             => $age !== null && $age !== '' ? (int) $age : null,
            'classe'          => trim((string) $this->request->getPost('classe')),
            'photo'           => $photoChemin,
            'anecdote'        => trim((string) $this->request->getPost('anecdote')) ?: null,
            'lien_parrainage' => trim((string) $this->request->getPost('lien_parrainage')),
            'statut'          => in_array($this->request->getPost('statut'), ['disponible', 'parraine'], true)
                ? $this->request->getPost('statut')
                : 'disponible',
            'parrain_email'   => trim((string) $this->request->getPost('parrain_email')) ?: null,
            'parrain_accepte_bulletin' => $this->request->getPost('parrain_accepte_bulletin') ? 1 : 0,
            'actif'           => $this->request->getPost('actif') ? 1 : 0,
            'ordre'           => (int) $this->request->getPost('ordre'),
        ];

        if ($id !== null) {
            $model->update($id, $donnees);
        } else {
            $donnees['cree_le'] = date('Y-m-d H:i:s');
            $model->insert($donnees);
        }

        return redirect()->to('/admin/enfants')->with('enregistre', true);
    }
}

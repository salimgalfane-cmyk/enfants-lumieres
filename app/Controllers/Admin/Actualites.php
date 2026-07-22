<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActualiteModel;
use App\Models\CategorieModel;
use App\Models\CtaModeleModel;

class Actualites extends BaseController
{
    private const DEFAUTS = [
        'id'                => null,
        'titre'             => '',
        'slug'              => '',
        'extrait'           => '',
        'contenu'           => '',
        'image_principale'  => '',
        'categorie_id'      => null,
        'temps_lecture_min' => 5,
        'cta_modele_id'     => null,
        'cta_titre'         => '',
        'cta_texte'         => '',
        'cta_bouton_texte'  => '',
        'cta_bouton_lien'   => '',
        'statut'            => 'brouillon',
        'date_publication'  => '',
    ];

    private const REGLES_VALIDATION = [
        'titre'         => 'required|max_length[200]',
        'extrait'       => 'required|max_length[400]',
        'contenu'       => 'required',
        'cta_modele_id' => 'required|is_natural_no_zero',
        'image'         => 'permit_empty|max_size[image,4096]|ext_in[image,jpg,jpeg,png,webp]|is_image[image]',
    ];

    public function index(): string
    {
        $model       = new ActualiteModel();
        $actualites  = $model->select('actualites.*, categories.nom AS categorie_nom')
            ->join('categories', 'categories.id = actualites.categorie_id', 'left')
            ->orderBy('actualites.cree_le', 'DESC')
            ->findAll();

        return view('admin/actualites/liste', [
            'adminPageTitle' => 'Actualités',
            'admin'          => session('admin'),
            'actualites'     => $actualites,
        ]);
    }

    public function create(): string
    {
        $actualite               = self::DEFAUTS;
        $actualite['cta_modele_id'] = null;
        $actualite['date_publication'] = date('Y-m-d\TH:i');

        return view('admin/actualites/formulaire', [
            'adminPageTitle' => 'Nouvelle actualité',
            'admin'          => session('admin'),
            'actualite'      => $actualite,
            'categories'     => (new CategorieModel())->getToutes(),
            'ctaModeles'     => (new CtaModeleModel())->getActifs(),
        ]);
    }

    public function edit(int $id): string
    {
        $actualite = (new ActualiteModel())->find($id);

        if ($actualite === null) {
            return redirect()->to('/admin/actualites');
        }

        if ($actualite['date_publication']) {
            $actualite['date_publication'] = str_replace(' ', 'T', substr($actualite['date_publication'], 0, 16));
        }

        return view('admin/actualites/formulaire', [
            'adminPageTitle' => "Éditer l'actualité",
            'admin'          => session('admin'),
            'actualite'      => $actualite,
            'categories'     => (new CategorieModel())->getToutes(),
            'ctaModeles'     => (new CtaModeleModel())->getActifs(),
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
        $model     = new ActualiteModel();
        $actualite = $model->find($id);

        if ($actualite !== null) {
            $model->delete($id);

            if ($actualite['image_principale']) {
                $chemin = rtrim(config('Uploads')->path, '/') . '/' . basename($actualite['image_principale']);
                if (is_file($chemin)) {
                    @unlink($chemin);
                }
            }
        }

        return redirect()->to('/admin/actualites')->with('supprime', true);
    }

    private function enregistrer(?int $id)
    {
        $model = new ActualiteModel();

        if (! $this->validate(self::REGLES_VALIDATION)) {
            $actualite = $id !== null ? $model->find($id) : array_merge(self::DEFAUTS, $this->request->getPost());

            return view('admin/actualites/formulaire', [
                'adminPageTitle' => $id !== null ? "Éditer l'actualité" : 'Nouvelle actualité',
                'admin'          => session('admin'),
                'actualite'      => $actualite,
                'categories'     => (new CategorieModel())->getToutes(),
                'ctaModeles'     => (new CtaModeleModel())->getActifs(),
                'erreur'         => implode(' ', $this->validator->getErrors()),
            ]);
        }

        $existant   = $id !== null ? $model->find($id) : null;
        $imageChemin = $existant['image_principale'] ?? null;

        $fichier = $this->request->getFile('image');
        if ($fichier && $fichier->isValid() && ! $fichier->hasMoved()) {
            $uploadConfig = config('Uploads');
            $nomFichier   = $fichier->getRandomName();
            $fichier->move($uploadConfig->path, $nomFichier);
            $imageChemin = base_url($uploadConfig->url . '/' . $nomFichier);
        }

        $titre       = trim((string) $this->request->getPost('titre'));
        $slugBase    = $model->slugify($titre);
        $slug        = $model->slugUnique($slugBase, $id);
        $categorieId = $this->request->getPost('categorie_id') ?: null;
        $datePub     = $this->request->getPost('date_publication')
            ? str_replace('T', ' ', $this->request->getPost('date_publication')) . ':00'
            : date('Y-m-d H:i:s');

        $donnees = [
            'titre'             => $titre,
            'slug'              => $slug,
            'extrait'           => trim((string) $this->request->getPost('extrait')),
            'contenu'           => $this->request->getPost('contenu'),
            'image_principale'  => $imageChemin,
            'categorie_id'      => $categorieId,
            'temps_lecture_min' => max(1, (int) $this->request->getPost('temps_lecture_min')),
            'cta_modele_id'     => (int) $this->request->getPost('cta_modele_id'),
            'cta_titre'         => $this->request->getPost('cta_titre') ?: null,
            'cta_texte'         => $this->request->getPost('cta_texte') ?: null,
            'cta_bouton_texte'  => $this->request->getPost('cta_bouton_texte') ?: null,
            'cta_bouton_lien'   => $this->request->getPost('cta_bouton_lien') ?: null,
            'statut'            => in_array($this->request->getPost('statut'), ['brouillon', 'publie'], true)
                ? $this->request->getPost('statut')
                : 'brouillon',
            'date_publication'  => $datePub,
        ];

        if ($id !== null) {
            $model->update($id, $donnees);
        } else {
            $donnees['auteur_id'] = session('admin')['id'] ?? null;
            $model->insert($donnees);
        }

        return redirect()->to('/admin/actualites')->with('enregistre', true);
    }
}

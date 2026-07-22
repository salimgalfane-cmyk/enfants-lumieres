<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        $this->seedCtaModeles();
        $this->seedCategories();
        $this->seedAdmin();
    }

    private function seedCtaModeles(): void
    {
        if ($this->db->table('cta_modeles')->countAllResults() > 0) {
            return;
        }

        $this->db->table('cta_modeles')->insertBatch([
            [
                'code'                => 'don',
                'nom'                 => 'Faire un don',
                'icone'               => 'heart',
                'titre_defaut'        => 'Chaque don construit l\'école de demain',
                'texte_defaut'        => 'Votre générosité finance le matériel pédagogique, les infrastructures et la formation des enseignants à Dzahadjou.',
                'bouton_texte_defaut' => 'Faire un don',
                'bouton_lien_defaut'  => 'https://www.helloasso.com/associations/les-enfants-lumieres/formulaires/3',
                'couleur'             => 'green-deep',
            ],
            [
                'code'                => 'parrainage',
                'nom'                 => 'Parrainer un enfant',
                'icone'               => 'userplus',
                'titre_defaut'        => 'Parrainez un enfant, changez une vie',
                'texte_defaut'        => 'Votre parrainage assure la scolarité complète d\'un enfant à la Maison des Enfants Lumières.',
                'bouton_texte_defaut' => 'Parrainer un enfant',
                'bouton_lien_defaut'  => '/parrainage',
                'couleur'             => 'green-mid',
            ],
            [
                'code'                => 'benevolat',
                'nom'                 => 'Devenir bénévole',
                'icone'               => 'users',
                'titre_defaut'        => 'Rejoignez l\'aventure Les Enfants Lumières',
                'texte_defaut'        => 'Vous avez du temps, des compétences ou des idées à partager ? Contactez-nous pour devenir bénévole.',
                'bouton_texte_defaut' => 'Nous contacter',
                'bouton_lien_defaut'  => '/contact',
                'couleur'             => 'green-deep',
            ],
            [
                'code'                => 'newsletter',
                'nom'                 => 'Suivre nos actualités',
                'icone'               => 'mega',
                'titre_defaut'        => 'Ne manquez aucune nouvelle de Dzahadjou',
                'texte_defaut'        => 'Recevez nos actualités et suivez l\'évolution de la Maison des Enfants Lumières.',
                'bouton_texte_defaut' => 'S\'abonner',
                'bouton_lien_defaut'  => '/contact',
                'couleur'             => 'green-mid',
            ],
            [
                'code'                => 'contact',
                'nom'                 => 'Nous contacter',
                'icone'               => 'mail',
                'titre_defaut'        => 'Une question, un projet, une envie de collaborer ?',
                'texte_defaut'        => 'Notre équipe en France et aux Comores est à votre écoute.',
                'bouton_texte_defaut' => 'Nous écrire',
                'bouton_lien_defaut'  => '/contact',
                'couleur'             => 'green-deep',
            ],
        ]);
    }

    private function seedCategories(): void
    {
        if ($this->db->table('categories')->countAllResults() > 0) {
            return;
        }

        $this->db->table('categories')->insertBatch([
            ['nom' => 'Impact local', 'slug' => 'impact-local', 'icone' => 'home'],
            ['nom' => 'Pédagogie nature', 'slug' => 'pedagogie-nature', 'icone' => 'leaf'],
            ['nom' => 'Pédagogie', 'slug' => 'pedagogie', 'icone' => 'book'],
            ['nom' => 'Sortie scolaire', 'slug' => 'sortie-scolaire', 'icone' => 'map'],
            ['nom' => 'Partenariats', 'slug' => 'partenariats', 'icone' => 'link'],
            ['nom' => 'Vie de l\'école', 'slug' => 'vie-de-lecole', 'icone' => 'school'],
        ]);
    }

    private function seedAdmin(): void
    {
        if ($this->db->table('admins')->countAllResults() > 0) {
            return;
        }

        $this->db->table('admins')->insert([
            'nom'               => 'Administrateur LEL',
            'email'             => 'contact@enfants-lumieres.com',
            'mot_de_passe_hash' => password_hash('ChangezMoi2026!', PASSWORD_DEFAULT),
            'role'              => 'admin',
        ]);
    }
}

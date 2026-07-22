<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateActualitesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'titre' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 220,
            ],
            'extrait' => [
                'type'       => 'VARCHAR',
                'constraint' => 400,
            ],
            'contenu' => [
                'type' => 'MEDIUMTEXT',
            ],
            'image_principale' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'categorie_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'temps_lecture_min' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true,
                'default'    => 5,
            ],
            'cta_modele_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'cta_titre' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'cta_texte' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cta_bouton_texte' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
                'null'       => true,
            ],
            'cta_bouton_lien' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'statut' => [
                'type'       => 'ENUM',
                'constraint' => ['brouillon', 'publie'],
                'default'    => 'brouillon',
            ],
            'auteur_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'vues' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'date_publication' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'cree_le' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'modifie_le' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey(['statut', 'date_publication'], false, false, 'idx_statut_date');
        $this->forge->addKey('categorie_id', false, false, 'idx_categorie');

        $this->forge->addForeignKey('categorie_id', 'categories', 'id', false, 'SET NULL', 'fk_actualites_categorie');
        $this->forge->addForeignKey('cta_modele_id', 'cta_modeles', 'id', false, 'RESTRICT', 'fk_actualites_cta_modele');
        $this->forge->addForeignKey('auteur_id', 'admins', 'id', false, 'SET NULL', 'fk_actualites_auteur');

        $this->forge->createTable('actualites', true, [
            'ENGINE'  => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('actualites', true);
    }
}

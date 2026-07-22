<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCtaModelesMigration extends Migration
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
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'icone' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'titre_defaut' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'texte_defaut' => [
                'type' => 'TEXT',
            ],
            'bouton_texte_defaut' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'bouton_lien_defaut' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'couleur' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'green-deep',
            ],
            'actif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('code');
        $this->forge->createTable('cta_modeles', true, [
            'ENGINE'  => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('cta_modeles', true);
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMatriculeToEnfantsParrainageMigration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('enfants_parrainage', [
            'matricule' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => true,
                'after'      => 'prenom',
            ],
        ]);
        $this->db->query('ALTER TABLE enfants_parrainage ADD UNIQUE KEY matricule (matricule)');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE enfants_parrainage DROP INDEX matricule');
        $this->forge->dropColumn('enfants_parrainage', ['matricule']);
    }
}

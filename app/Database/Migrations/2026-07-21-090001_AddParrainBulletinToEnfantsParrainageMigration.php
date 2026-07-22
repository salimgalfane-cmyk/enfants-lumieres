<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParrainBulletinToEnfantsParrainageMigration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('enfants_parrainage', [
            'parrain_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'statut',
            ],
            'parrain_accepte_bulletin' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'parrain_email',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('enfants_parrainage', ['parrain_email', 'parrain_accepte_bulletin']);
    }
}

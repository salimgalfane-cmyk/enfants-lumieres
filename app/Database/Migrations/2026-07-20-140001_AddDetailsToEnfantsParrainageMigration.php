<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailsToEnfantsParrainageMigration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('enfants_parrainage', [
            'age' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'classe',
            ],
            'anecdote' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'photo',
            ],
            'statut' => [
                'type'       => 'ENUM',
                'constraint' => ['disponible', 'parraine'],
                'default'    => 'disponible',
                'after'      => 'lien_parrainage',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('enfants_parrainage', ['age', 'anecdote', 'statut']);
    }
}

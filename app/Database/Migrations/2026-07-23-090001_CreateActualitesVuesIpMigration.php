<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActualitesVuesIpMigration extends Migration
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
            'actualite_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'ip_hash' => [
                'type'       => 'CHAR',
                'constraint' => 64,
            ],
            'vu_le' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['actualite_id', 'ip_hash']);
        $this->forge->addForeignKey('actualite_id', 'actualites', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('actualites_vues_ip', true, [
            'ENGINE'  => 'InnoDB',
            'CHARSET' => 'utf8mb4',
            'COLLATE' => 'utf8mb4_unicode_ci',
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('actualites_vues_ip', true);
    }
}

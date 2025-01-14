<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mobils extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mobil' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'merk_mobil' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_plat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'warna_mobil' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'img_mobil' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'no_stnk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia'],
                'default' => 'Tersedia',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_mobil', true);
        $this->forge->createTable('mobil_items');
    }

    public function down()
    {
        $this->forge->dropTable('mobil_items');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PinjamanMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjaman' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'id_mobil' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'i_driver' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,

            ],
            'tanggal_pinjaman' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tanggal_kembali' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Selesai', 'Belum Dikembalikan'],
                'default' => 'Belum Dikembalikan',
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

        $this->forge->addKey('id_pinjaman', true);

        $this->forge->addForeignKey('id_mobil', 'mobil_items', 'id_mobil', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('i_driver', 'driver_mobil', 'id_driver', 'SET NULL', 'CASCADE');






        $this->forge->createTable('pinjaman_mobils');
    }

    public function down()
    {
        $this->forge->dropTable('pinjaman_mobils');
    }
}

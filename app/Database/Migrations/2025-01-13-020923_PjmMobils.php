<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PjmMobils extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_mobil' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'nama_driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'Nik_driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telp_driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pinjam_mobils');
    }

    public function down()
    {
        $this->forge->dropTable('pinjam_mobils');
    }
}

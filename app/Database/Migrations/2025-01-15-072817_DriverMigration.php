<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DriverMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_driver' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,

            ],

            'nama_driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nik_driver' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Y', 'N'],
                'default' => 'Y',
            ],

        ]);

        $this->forge->addKey('id_driver', true);
        $this->forge->createTable('driver_mobil');
    }

    public function down()
    {
        $this->forge->dropTable('driver_mobil');
    }
}

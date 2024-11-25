<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pelanggan_id' => [
                'type'          => 'INT',  
                'constraint'    => '11',  
                'unsigned'      => true,  
                'auto_increment'=> true,  
            ],
            'nama_pelanggan' => [
                'type'          => 'VARCHAR',  
                'constraint'    => '255',  
            ],
            'alamat' => [
                'type'          => 'VARCHAR',  
                'constraint'    => '255',  
            ],
            'nomer_telpon' => [
                'type'          => 'VARCHAR',  
                'constraint'    => '255',  
            ]
        ]);

        $this->forge->addKey('pelanggan_id', true);
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}

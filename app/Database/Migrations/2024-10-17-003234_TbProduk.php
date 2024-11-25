<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

// Kelas migrasi untuk tabel tb_produk
class TbProduk extends Migration
{
    // Metode untuk menjalankan migrasi (membuat tabel)
    public function up()
    {
        // Menambahkan field ke dalam tabel
        $this->forge->addField([
            'produk_id' => [
                'type'          => 'INT',  // Tipe data untuk kolom produk_id
                'constraint'    => '11',  // Batasan jumlah digit
                'unsigned'      => true,  // Kolom ini tidak boleh negatif
                'auto_increment'=> true,  // Kolom ini otomatis meningkat
            ],
            'nama_produk' => [
                'type'          => 'VARCHAR',   // Tipe data untuk kolom nama_produk
                'constraint'    => '255',    // Batasan panjang maksimum
            ],
            'harga' => [
                'type'          => 'DECIMAL',   // Tipe data untuk kolom harga
                'constraint'    => '10,2',     // Total 10 digit, dengan 2 digit desimal
            ],
            'stok' => [
                'type'          => 'INT',  // Tipe data untuk kolom stok
                'constraint'    => '11',   // Batasan jumlah digit
            ],
        ]);

        // Menambahkan kunci utama pada kolom produk_id
        $this->forge->addKey('produk_id', true);
        
        // Membuat tabel tb_produk
        $this->forge->createTable('tb_produk');
    }

    // Metode untuk membatalkan migrasi (menghapus tabel)
    public function down()
    {
        // Menghapus tabel tb_produk
        $this->forge->dropTable('tb_produk');
    }
}

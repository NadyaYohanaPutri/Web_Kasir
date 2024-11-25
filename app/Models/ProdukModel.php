<?php

namespace App\Models;

use CodeIgniter\Model;

// Model untuk produk
class ProdukModel extends Model
{
    // Nama tabel di database
    protected $table = 'tb_produk';
    
    // Kunci utama tabel
    protected $primaryKey = 'produk_id';
    
    // Mengaktifkan auto increment untuk kunci utama
    protected $useAutoIncrement = true;
    
    // Tipe data yang dikembalikan saat mengambil data
    protected $returnType = 'array';
    
    // Menggunakan soft deletes (jika diaktifkan, data tidak benar-benar dihapus)
    protected $useSoftDeletes = false;
    
    // Melindungi field dari perubahan tidak disengaja
    protected $protectFields = true;
    
    // Daftar field yang diizinkan untuk diisi
    protected $allowedFields = ['nama_produk', 'harga', 'stok'];

    // Pengaturan untuk timestamp
    protected $useTimestamps = false; // Jika true, akan otomatis mengisi created_at dan updated_at
    protected $dateFormat = 'datetime'; // Format tanggal
    protected $createdField = 'created_at'; // Nama field untuk tanggal dibuat
    protected $updatedField = 'updated_at'; // Nama field untuk tanggal diperbarui
    protected $deletedField = 'deleted_at'; // Nama field untuk tanggal dihapus
}

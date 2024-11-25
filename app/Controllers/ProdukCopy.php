<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel; 
use CodeIgniter\HTTP\ResponseInterface;

class ProdukCopy extends BaseController
{
    protected $produkmodel;

    public function __construct()
    {
        $this->produkmodel = new ProdukModel();
    }

    public function index()
    {
        return view('beranda');
    }

    public function tampil_produk(){
        $produk = $this->produkmodel->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'produk'    => $produk
        ]);
    }

    public function simpan_produk()
    {
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga'       => $this->request->getVar('harga'),
            'stok'        => $this->request->getVar('stok'),
        ];

        if ($this->produkmodel->save($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data produk berhasil disimpan',
            ]);
        }
    }

    public function hapus_produk($id)
    {
        $produk = $this->produkmodel->find($id);
        if (!$produk) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan',
            ]);
        }

        if ($this->produkmodel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Produk berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus produk',
            ]);
        }
    }

    public function update_produk()
    {
        $id = $this->request->getVar('produkId'); // Ambil ID produk dari request
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga'       => $this->request->getVar('harga'),
            'stok'        => $this->request->getVar('stok'),
        ];
        
        if ($id && $this->produkmodel->update($id, $data)) { // Update produk dengan ID spesifik
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data produk berhasil diperbarui',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal memperbarui data produk',
            ]);
        }
    }

    public function detail($id) {
        $produk = $this->produkmodel->find($id);
        if ($produk) {
            return $this->response->setJSON([
                'status' => 'success',
                'produk' => $produk,
            ]);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    // Fungsi untuk mengambil data produk yang akan diedit
    public function edit_produk()
    {
        $produkID = $this->request->getVar('id');
        $produk = $this->produkmodel->find($produkID);

        if ($produk) {
            return $this->response->setJSON([
                'status' => 'success',
                'produk' => $produk
            ]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk Tidak Ditemukan'], 404);
        }
    }
}
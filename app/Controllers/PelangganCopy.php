<?php

namespace App\Controllers;

use App\Models\PelangganModel; // Import the PelangganModel
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganCopy extends BaseController

{

    protected $pelangganmodel;

    public function __construct()
    {
        $this->pelangganmodel = new PelangganModel();
    }

    public function index()
    {
        return view('beranda_pelanggan');
    }

    public function simpan_pelanggan()
    {
        //validasi input dari AJAX
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
            'nomer_telpon'  => 'required',
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'    => $validation->getErrors(),
            ]);
        }
        
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'nomer_telpon'  => $this->request->getVar('nomer_telpon'),
        ];

        $this->pelangganmodel->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data pelanggan berhasil disimpan',
        ]);
    
    }

    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganmodel->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    public function hapus_pelanggan($id)
    {
        // Cek apakah produk dengan ID yang diberikan ada di database
        $pelanggan = $this->pelangganmodel->find($id);
        if (!$pelanggan) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }

        // Hapus produk
        if ($this->pelangganmodel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Pelanggan berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus pelanggan',
            ]);
        }
    }
    public function detail_pelanggan($id)
    {
        $pelanggan = $this->pelangganmodel->find($id);
    
        if (!$pelanggan) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }
    
        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    public function updatePelanggan()
    {
        $id = $this->request->getVar('id_pelanggan');
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat'       => $this->request->getVar('alamat'),
            'nomer_telpon'        => $this->request->getVar('nomer_telpon'),
        ];

        if ($this->pelangganmodel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Pelanggan berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui pelanggan']);
        }
    }
    public function update()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomer_telpon' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'nomer_telpon' => $this->request->getVar('nomer_telpon')
        ];

        $id = $this->request->getVar('id');
        // Update the product
        $this->pelangganmodel->update($id, $data);
 
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil diperbarui',
        ]);
    }
    public function tampil_by_id($id)
    {
        $pelanggan = $this->pelangganmodel->find($id);  

        if ($pelanggan) {
            return $this->response->setJSON([
                'status' => 'success',
                'pelanggan' => $pelanggan  
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'  
            ]);
        }
    }

}

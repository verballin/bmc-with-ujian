<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\UserModel;
use App\Models\ProdukModel;

class Pembayaran extends BaseController
{
    public function form($slug)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->where('slug', $slug)->first();

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pembayaran/form', [
            'produk' => $produk,
            'title' => $produk['title']
        ]);
    }

    public function simpanpembayaran()
    {
        $model = new PembayaranModel();
        $userModel = new UserModel();
        $produkModel = new ProdukModel(); // Tambahkan model produk

        $user_id = $this->request->getPost('user_id');
        $id_produk = $this->request->getPost('id_produk');
        

        // Ambil data user
        $user = $userModel->find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Ambil data produk
        $produk = $produkModel->find($id_produk);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Siapkan data pembayaran
        $data = [
            'user_id' => $user_id,
            'id_produk' => $id_produk,
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'harga' => $produk['harga'],
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'status' => 'pending',
        ];

        // Simpan ke database
        $model->save($data);
        $id = $model->insertID();

        return redirect()->to('/pembayaran/instruksi/' . $id);
    }


    public function proses($id_produk)
    {
        $session = session();
        $user_id = $session->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $produkModel = new ProdukModel();

        $user = $userModel->find($user_id);
        $produk = $produkModel->find($id_produk);

        if (!$user || !$produk) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        return view('MainPage/pembayaran', [
            'user' => $user,
            'produk' => $produk,
        ]);
    }


    public function instruksi($id)
    {
        $session = session();
        $userId = $session->get('user_id'); // asumsikan ini ID user login
        $userRole = $session->get('role');

        $pembayaranModel = new PembayaranModel();
        $produkModel = new ProdukModel();

        $pembayaran = $pembayaranModel->find($id);

        if (!$pembayaran) {
            return redirect()->to('/courses')->with('error', 'Data pembayaran tidak ditemukan.');
        }

        // Jika bukan admin dan bukan pemilik pembayaran, tolak akses
        if ($userRole !== 'Admin' && $pembayaran['user_id'] != $userId) {
            return redirect()->to(base_url())->with('error', 'Anda tidak berhak mengakses halaman ini.');
        }

        $produk = $produkModel->find($pembayaran['id_produk']);

        return view('MainPage/instruksipembayaran', [
            'pembayaran' => $pembayaran,
            'produk' => $produk
        ]);
    }

    
    public function updateStatus($id)
    {
        $session = session();
        if ($session->get('role') !== 'Admin') {
            return redirect()->to(site_url('historipembelian'))->with('error', 'Unauthorized');
        }

        $status = $this->request->getPost('status');
        $pembayaranModel = new PembayaranModel();

        $pembayaranModel->update($id, ['status' => $status]);

        return redirect()->to(site_url('historipembelian'))->with('success', 'Status diperbarui');
    }


    public function deletepembelian($id_pembayaran) {
        $session = session();
        if($session->get('username') != '' && $session->get('login')==true){
            $pembayaranModel = new PembayaranModel();
            $pembayaranModel->delete($id_pembayaran);
            $session->setFlashdata('pesan', 
                                '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Data Berhasil Dihapus</h5></div>');
        return redirect()->to(site_url('historipembelian'));
        }else{
            return redirect()->to(base_url());
        }                    
    }


}

<?php namespace App\Controllers;

use App\Models\ProdukModel;

class Pages extends BaseController
{

    public function view($page = 'index')
    {
        // Optional: whitelist or validate the $page parameter to prevent load attacks
        $allowedPages = ['index', 'about', 'contact', 'courses', 'login', 'pembelianproduk', 'kelolauser', 'inputproduk', 'pembayaran', 
        'historipembelian', 'signup', 'infopengaturanujian', 'mulaiujian', 'pengaturanujian', 'daftarsoal', 'tambahsoal', 'editsoal', 'pilihujian']; // etc.

        if (! in_array($page, $allowedPages)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('MainPage/' . $page);
    }
    
}
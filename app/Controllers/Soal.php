<?php

namespace App\Controllers;
use App\Models\SoalModel;

class Soal extends BaseController
{

    public function index()
    {
        $soalModel = new SoalModel();
        $data['soal'] = $soalModel->findAll();

        
        return view('MainPage/daftarsoal', $data);
    }
    

    public function tambah()
    {
        return view('MainPage/tambahsoal'); // sesuai nama file: tambahsoal.php
    }

    public function simpan()
    {
        $soalModel = new SoalModel();

        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'a' => $this->request->getPost('a'),
            'b' => $this->request->getPost('b'),
            'c' => $this->request->getPost('c'),
            'd' => $this->request->getPost('d'),
            'kunci_jawaban' => $this->request->getPost('kunci_jawaban'),
        ];

        // Upload gambar jika ada
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/soal', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $result = $soalModel->insert($data);

        if ($result) {
            session()->setFlashdata('pesan', 'Soal berhasil disimpan.');
        } else {
            session()->setFlashdata('pesan', 'Gagal menyimpan Soal.');
        }

        return redirect()->to('/soal/tambah')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function edit($soal_id)
    {
        $soalModel = new SoalModel();
        $soal = $soalModel->find($soal_id);

        if (!$soal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Soal tidak ditemukan');
        }

        return view('MainPage/editsoal', ['soal' => $soal]);
    }

    public function update($soal_id)
    {
        $soalModel = new SoalModel();
        $soalLama = $soalModel->find($soal_id);

        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'a' => $this->request->getPost('a'),
            'b' => $this->request->getPost('b'),
            'c' => $this->request->getPost('c'),
            'd' => $this->request->getPost('d'),
            'kunci_jawaban' => $this->request->getPost('kunci_jawaban'),
        ];

        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Hapus gambar lama jika ada
            if (!empty($soalLama['gambar']) && file_exists('uploads/soal/' . $soalLama['gambar'])) {
                unlink('uploads/soal/' . $soalLama['gambar']);
            }

            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/soal', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $soalModel->update($soal_id, $data);


        return redirect()->to('daftarsoal')->with('success', 'Soal berhasil diperbarui.');
    }

    public function delete($soal_id)
    {
        $soalModel = new SoalModel();
        $soal = $soalModel->find($soal_id);

        if (!$soal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Soal tidak ditemukan');
        }

        // Hapus gambar jika ada
        if (!empty($soal['gambar']) && file_exists('uploads/soal/' . $soal['gambar'])) {
            unlink('uploads/soal/' . $soal['gambar']);
        }

        $soalModel->delete($soal_id);

        return redirect()->to('daftarsoal')->with('success', 'Soal berhasil dihapus.');
    }

    public function preview($id)
    {
        $soalModel = new SoalModel();
        $soal = $soalModel->find($id);

        if (!$soal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Soal dengan ID $id tidak ditemukan.");
        }

        return view('soal/preview', ['soal' => $soal]);
    }


}

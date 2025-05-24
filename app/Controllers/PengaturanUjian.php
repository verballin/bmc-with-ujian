<?php

namespace App\Controllers;

use App\Models\NilaiModel;
use App\Models\PengaturanModel;
use App\Models\PengaturanSoalModel;
use App\Models\JawabanUjianModel;
use App\Models\SoalModel;

class PengaturanUjian extends BaseController
{
    private function isAdmin()
    {
        return session()->get('role') === 'Admin';
    }

    private function isSiswa()
    {
        return session()->get('role') === 'Siswa';
    }

    private function bolehUjian()
    {
        return session()->get('boleh_ujian') == 1;
    }

    
    public function index() {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $soalModel = new SoalModel();

        $data['pengaturan'] = $pengaturanModel->findAll();
        $data['soal_list'] = $soalModel->findAll(); // Semua soal untuk dipilih saat atur ujian

        return view('MainPage/pengaturanujian', $data);
    }

    public function daftar()
    {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }      


        $pengaturanModel = new PengaturanModel();
        $pengaturanSoalModel = new PengaturanSoalModel();

        $pengaturan = $pengaturanModel->findAll();

        // Tambahkan jumlah soal dari tabel pengaturan_soal
        foreach ($pengaturan as &$p) {
            $p['jumlah_soal'] = $pengaturanSoalModel->getJumlahSoalByPengaturan($p['id_pengaturan']);
        }

        $data['pengaturan'] = $pengaturan;

        return view('MainPage/infopengaturanujian', $data);
    }



    public function simpan()
    {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $pengaturanSoalModel = new PengaturanSoalModel();

        $data = [
            'nama_ujian'    => $this->request->getPost('nama_ujian'),
            'waktu'         => $this->request->getPost('waktu'),
            'nilai_minimal' => $this->request->getPost('nilai_minimal'),
            'peraturan'     => $this->request->getPost('peraturan')
        ];

        if (!$this->validate([
            'nama_ujian' => 'required',
            'waktu' => 'required|numeric',
            'nilai_minimal' => 'required|numeric',
            'peraturan' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('pesan', 'Harap isi semua field dengan benar.');
        }

        // Simpan ke tabel pengaturan dan dapatkan ID-nya
        $pengaturanModel->insert($data);
        $idpengaturan = $pengaturanModel->insertID();

        // Simpan relasi soal
        $soalDipilih = $this->request->getPost('soal'); // array of soal_id
        if ($soalDipilih && is_array($soalDipilih)) {
            $relasi = [];
            foreach ($soalDipilih as $idSoal) {
                $relasi[] = [
                    'id_pengaturan' => $idpengaturan,
                    'id_soal' => $idSoal
                ];
            }
            $pengaturanSoalModel->insertBatch($relasi);
        }

        return redirect()->to(site_url('pengaturanujian'))->with('success', 'Pengaturan dan soal berhasil disimpan.');
    }

    public function edit($id_pengaturan)
    {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $soalModel = new SoalModel();
        $pengaturanSoalModel = new PengaturanSoalModel();

        $pengaturan = $pengaturanModel->find($id_pengaturan);
        if (!$pengaturan) {
            return redirect()->to(site_url('infopengaturanujian'))->with('error', 'Pengaturan tidak ditemukan.');
        }

        // Soal yang dipilih sebelumnya
        $soalTerkait = $pengaturanSoalModel->where('id_pengaturan', $id_pengaturan)->findAll();
        $idSoalTerkait = array_column($soalTerkait, 'id_soal');

        $data = [
            'pengaturan' => $pengaturan,
            'soal_list' => $soalModel->findAll(),
            'soal_terpilih' => $idSoalTerkait
        ];

        return view('MainPage/editpengaturanujian', $data);
    }

    public function update($id_pengaturan)
    {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $pengaturanSoalModel = new PengaturanSoalModel();

        $data = [
            'nama_ujian'    => $this->request->getPost('nama_ujian'),
            'waktu'         => $this->request->getPost('waktu'),
            'nilai_minimal' => $this->request->getPost('nilai_minimal'),
            'peraturan'     => $this->request->getPost('peraturan')
        ];

        if (!$this->validate([
            'nama_ujian' => 'required',
            'waktu' => 'required|numeric',
            'nilai_minimal' => 'required|numeric',
            'peraturan' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('pesan', 'Harap isi semua field dengan benar.');
        }

        $pengaturanModel->update($id_pengaturan, $data);

        // Update relasi soal
        $pengaturanSoalModel->where('id_pengaturan', $id_pengaturan)->delete(); // hapus dulu
        $soalDipilih = $this->request->getPost('soal');
        if ($soalDipilih && is_array($soalDipilih)) {
            $relasi = [];
            foreach ($soalDipilih as $idSoal) {
                $relasi[] = [
                    'id_pengaturan' => $id_pengaturan,
                    'id_soal' => $idSoal
                ];
            }
            $pengaturanSoalModel->insertBatch($relasi);
        }

        return redirect()->to(site_url('infopengaturanujian'))->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function delete($id_pengaturan)
    {
        if (!$this->isAdmin()) {
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $pengaturanSoalModel = new PengaturanSoalModel();

        $pengaturan = $pengaturanModel->find($id_pengaturan);
        if (!$pengaturan) {
            return redirect()->to(site_url('infopengaturanujian'))->with('error', 'Data tidak ditemukan.');
        }

        $pengaturanSoalModel->where('id_pengaturan', $id_pengaturan)->delete(); // hapus relasi dulu
        $pengaturanModel->delete($id_pengaturan);

        return redirect()->to(site_url('infopengaturanujian'))->with('success', 'Pengaturan berhasil dihapus.');
    }



    public function ujian()
    {
        if (!($this->isSiswa() && $this->bolehUjian()) && !$this->isAdmin()) {
            // Tampilkan view 403 tanpa redirect
            return view('errors/403');
        }

        $pengaturanModel = new PengaturanModel();
        $data['pengaturan'] = $pengaturanModel->findAll();

        return view('MainPage/pilihujian', $data);
    }

    public function mulai($id_pengaturan)
    {
        if (!($this->isSiswa() && $this->bolehUjian()) && !$this->isAdmin()) {
            // Tampilkan view 403 tanpa redirect
            return view('errors/403');
        }


        $pengaturanModel = new PengaturanModel();
        $pengaturanSoalModel = new PengaturanSoalModel();
        $soalModel = new SoalModel();

        $pengaturan = $pengaturanModel->find($id_pengaturan);
        if (!$pengaturan) {
            return redirect()->to(site_url('pengaturanujian/ujian'))->with('error', 'Ujian tidak ditemukan.');
        }

        // Ambil soal berdasarkan relasi
        $relasiSoal = $pengaturanSoalModel->where('id_pengaturan', $id_pengaturan)->findAll();
        $idSoal = array_column($relasiSoal, 'id_soal');
        $soalList = $soalModel->whereIn('soal_id', $idSoal)->findAll();

        $data = [
            'pengaturan' => $pengaturan,
            'soal_list' => $soalList
        ];

        return view('MainPage/mulaiujian', $data);
    }

    public function simpanjawaban($id_pengaturan)
    {
        if (!($this->isSiswa() && $this->bolehUjian()) && !$this->isAdmin()) {
            // Tampilkan view 403 tanpa redirect
            return view('errors/403');
        }

        
        $soalModel     = new SoalModel();
        $nilaiModel    = new NilaiModel();
        $jawabanModel  = new JawabanUjianModel(); // pastikan model ini ada

        $jawabanUser = $this->request->getPost('jawaban');
        $userId = session()->get('user_id');

        if (!$jawabanUser || !$userId) {
            return redirect()->back()->with('error', 'Jawaban tidak lengkap atau tidak login.');
        }

        $benar = 0;
        $salah = 0;
        $kosong = 0;
        $insertJawaban = [];

        foreach ($jawabanUser as $soalId => $jawaban) {
            $soal = $soalModel->find($soalId);
            if (!$soal) continue;

            if (empty($jawaban)) {
                $kosong++;
                continue;
            }

            $isBenar = ($soal['kunci_jawaban'] === $jawaban) ? 1 : 0;

            if ($isBenar) {
                $benar++;
            } else {
                $salah++;
            }

            $insertJawaban[] = [
                'user_id'         => $userId,
                'id_pengaturan'   => $id_pengaturan,
                'soal_id'         => $soalId,
                'jawaban_user'    => $jawaban,
                'jawaban_benar'   => $soal['kunci_jawaban'],
                'is_benar'        => $isBenar,
            ];
        }

        // Simpan semua jawaban ke tabel jawaban_ujian
        if (!empty($insertJawaban)) {
            $jawabanModel->insertBatch($insertJawaban);
        }

        $total = $benar + $salah + $kosong;
        $nilai = $total > 0 ? round(($benar / $total) * 100) : 0;
        $status = $nilai >= $this->getNilaiMinimal($id_pengaturan) ? 'Lulus' : 'Tidak Lulus';

        // CI4 Friendly: Simpan ke tabel nilai menggunakan Model
        $nilaiModel->insert([
            'user_id'        => $userId,
            'id_pengaturan'  => $id_pengaturan,
            'benar'          => $benar,
            'salah'          => $salah,
            'kosong'         => $kosong,
            'nilai'          => $nilai,
            'tanggal'        => date('Y-m-d'),
            'status'         => $status
        ]);

        return view('MainPage/hasilujian', [
            'skor'   => $benar,
            'total'  => $total,
            'nilai'  => $nilai,
            'lulus'  => ($status === 'Lulus')
        ]);
    }



    private function getNilaiMinimal($id_pengaturan)
    {
        $pengaturanModel = new PengaturanModel();
        $pengaturan = $pengaturanModel->find($id_pengaturan);
        return $pengaturan ? $pengaturan['nilai_minimal'] : 0;
    }

}

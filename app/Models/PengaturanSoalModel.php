<?php

namespace App\Models;
use CodeIgniter\Model;

class PengaturanSoalModel extends Model
{
    protected $table = 'pengaturan_soal'; // Tabel relasi
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pengaturan', 'id_soal'];


    public function getJumlahSoalByPengaturan($id_pengaturan)
    {
        return $this->where('id_pengaturan', $id_pengaturan)->countAllResults();
    }
}

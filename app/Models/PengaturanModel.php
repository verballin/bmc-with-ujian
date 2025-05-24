<?php

namespace App\Models;
use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'id_pengaturan';
    protected $allowedFields = [
        'nama_ujian', 'waktu', 'nilai_minimal', 'peraturan'
    ];
}


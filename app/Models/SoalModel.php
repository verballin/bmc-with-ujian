<?php

namespace App\Models;
use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'soal_id';
    protected $allowedFields = [
        'pertanyaan', 'gambar', 'a', 'b', 'c', 'd', 'kunci_jawaban'
    ];
}


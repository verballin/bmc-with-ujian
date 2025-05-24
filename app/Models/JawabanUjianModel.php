<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanUjianModel extends Model
{
    protected $table = 'jawaban_ujian';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'user_id',
        'id_pengaturan',
        'soal_id',
        'jawaban_user',
        'jawaban_benar',
        'is_benar',
    ];
}

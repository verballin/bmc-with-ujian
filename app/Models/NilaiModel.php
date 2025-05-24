<?php
namespace App\Models;
use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'nilai_id';
    protected $allowedFields = [
                'user_id', 'id_pengaturan', 'benar', 'salah', 'kosong', 'nilai', 'tanggal', 'status'
    ];
}

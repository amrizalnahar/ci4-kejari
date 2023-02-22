<?php

namespace App\Models;

use CodeIgniter\Model;

class katasambutanModel extends Model
{
    protected $table = 'tb_katasambutan';
    protected $primaryKey = 'id_katasambutan';
    protected $allowedFields = ['judul_katasambutan', 'isi_katasambutan', 'gambar_katasambutan', 'slug_katasambutan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getkatasambutan($slug_katasambutan = false)
    {

        if ($slug_katasambutan == false) {
            return $this->findAll();
        }

        return $this->where(['slug_katasambutan' => $slug_katasambutan])->first();
    }
}

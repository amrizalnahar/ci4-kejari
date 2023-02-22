<?php

namespace App\Models;

use CodeIgniter\Model;

class jadwalsidangModel extends Model
{
    protected $table = 'tb_jadwalsidang';
    protected $primaryKey = 'id_jadwalsidang';
    protected $allowedFields = ['judul_jadwalsidang', 'isi_jadwalsidang', 'gambar_jadwalsidang', 'slug_jadwalsidang', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getjadwalsidang($slug_jadwalsidang = false)
    {

        if ($slug_jadwalsidang == false) {
            return $this->findAll();
        }

        return $this->where(['slug_jadwalsidang' => $slug_jadwalsidang])->first();
    }
}

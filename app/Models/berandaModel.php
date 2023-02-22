<?php

namespace App\Models;

use CodeIgniter\Model;

class berandaModel extends Model
{
    protected $table = 'tb_beranda';
    protected $primaryKey = 'id_beranda';
    protected $allowedFields = ['judul_beranda', 'isi_beranda', 'gambar_beranda', 'slug_beranda', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getberanda($slug_beranda = false)
    {

        if ($slug_beranda == false) {
            return $this->findAll();
        }

        return $this->where(['slug_beranda' => $slug_beranda])->first();
    }
}

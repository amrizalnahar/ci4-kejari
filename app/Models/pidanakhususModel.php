<?php

namespace App\Models;

use CodeIgniter\Model;

class pidanakhususModel extends Model
{
    protected $table = 'tb_pidanakhusus';
    protected $primaryKey = 'id_pidanakhusus';
    protected $allowedFields = ['judul_pidanakhusus', 'isi_pidanakhusus', 'gambar_pidanakhusus', 'slug_pidanakhusus', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpidanakhusus($slug_pidanakhusus = false)
    {

        if ($slug_pidanakhusus == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pidanakhusus' => $slug_pidanakhusus])->first();
    }
}

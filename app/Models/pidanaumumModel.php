<?php

namespace App\Models;

use CodeIgniter\Model;

class pidanaumumModel extends Model
{
    protected $table = 'tb_pidanaumum';
    protected $primaryKey = 'id_pidanaumum';
    protected $allowedFields = ['judul_pidanaumum', 'isi_pidanaumum', 'gambar_pidanaumum', 'slug_pidanaumum', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpidanaumum($slug_pidanaumum = false)
    {

        if ($slug_pidanaumum == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pidanaumum' => $slug_pidanaumum])->first();
    }
}

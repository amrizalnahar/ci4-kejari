<?php

namespace App\Models;

use CodeIgniter\Model;

class pidsusModel extends Model
{
    protected $table = 'tb_pidsus';
    protected $primaryKey = 'id_pidsus';
    protected $allowedFields = ['judul_pidsus', 'isi_pidsus', 'gambar_pidsus', 'slug_pidsus', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpidsus($slug_pidsus = false)
    {

        if ($slug_pidsus == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pidsus' => $slug_pidsus])->first();
    }
}

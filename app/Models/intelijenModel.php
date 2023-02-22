<?php

namespace App\Models;

use CodeIgniter\Model;

class intelijenModel extends Model
{
    protected $table = 'tb_intelijen';
    protected $primaryKey = 'id_intelijen';
    protected $allowedFields = ['judul_intelijen', 'isi_intelijen', 'gambar_intelijen', 'slug_intelijen', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getintelijen($slug_intelijen = false)
    {

        if ($slug_intelijen == false) {
            return $this->findAll();
        }

        return $this->where(['slug_intelijen' => $slug_intelijen])->first();
    }
}

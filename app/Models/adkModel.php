<?php

namespace App\Models;

use CodeIgniter\Model;

class adkModel extends Model
{
    protected $table = 'tb_adhyaksadharmakarini';
    protected $primaryKey = 'id_adk';
    protected $allowedFields = ['judul_adk', 'isi_adk', 'gambar_adk', 'slug_adk', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getAdk($slug_adk = false)
    {

        if ($slug_adk == false) {
            return $this->findAll();
        }

        return $this->where(['slug_adk' => $slug_adk])->first();
    }
}

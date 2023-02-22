<?php

namespace App\Models;

use CodeIgniter\Model;

class datunModel extends Model
{
    protected $table = 'tb_datun';
    protected $primaryKey = 'id_datun';
    protected $allowedFields = ['judul_datun', 'isi_datun', 'gambar_datun', 'slug_datun', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getdatun($slug_datun = false)
    {

        if ($slug_datun == false) {
            return $this->findAll();
        }

        return $this->where(['slug_datun' => $slug_datun])->first();
    }
}

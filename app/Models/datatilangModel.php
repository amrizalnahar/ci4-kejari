<?php

namespace App\Models;

use CodeIgniter\Model;

class datatilangModel extends Model
{
    protected $table = 'tb_datatilang';
    protected $primaryKey = 'id_datatilang';
    protected $allowedFields = ['judul_datatilang', 'slug_datatilang', 'isi_datatilang', 'tag_datatilang', 'gambar_datatilang'];
    protected $useTimestamps = true;

    public function getdatatilang($slug_datatilang = false)
    {

        if ($slug_datatilang == false) {
            return $this->findAll();
        }

        return $this->where(['slug_datatilang' => $slug_datatilang])->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class kontakModel extends Model
{
    protected $table = 'tb_kontak';
    protected $primaryKey = 'id_kontak';
    protected $allowedFields = ['judul_kontak', 'isi_kontak', 'gambar_kontak', 'slug_kontak', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getkontak($slug_kontak = false)
    {

        if ($slug_kontak == false) {
            return $this->findAll();
        }

        return $this->where(['slug_kontak' => $slug_kontak])->first();
    }
}

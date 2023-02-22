<?php

namespace App\Models;

use CodeIgniter\Model;

class peraturanModel extends Model
{
    protected $table = 'tb_peraturan';
    protected $primaryKey = 'id_peraturan';
    protected $allowedFields = ['judul_peraturan', 'isi_peraturan', 'gambar_peraturan', 'slug_peraturan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getperaturan($slug_peraturan = false)
    {

        if ($slug_peraturan == false) {
            return $this->findAll();
        }

        return $this->where(['slug_peraturan' => $slug_peraturan])->first();
    }
}

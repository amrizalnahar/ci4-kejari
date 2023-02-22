<?php

namespace App\Models;

use CodeIgniter\Model;

class pembinaanModel extends Model
{
    protected $table = 'tb_pembinaan';
    protected $primaryKey = 'id_pembinaan';
    protected $allowedFields = ['judul_pembinaan', 'isi_pembinaan', 'gambar_pembinaan', 'slug_pembinaan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpembinaan($slug_pembinaan = false)
    {

        if ($slug_pembinaan == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pembinaan' => $slug_pembinaan])->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class visidanmisiModel extends Model
{
    protected $table = 'tb_visidanmisi';
    protected $primaryKey = 'id_visidanmisi';
    protected $allowedFields = ['judul_visidanmisi', 'isi_visidanmisi', 'gambar_visidanmisi', 'slug_visidanmisi', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getvisidanmisi($slug_visidanmisi = false)
    {

        if ($slug_visidanmisi == false) {
            return $this->findAll();
        }

        return $this->where(['slug_visidanmisi' => $slug_visidanmisi])->first();
    }
}

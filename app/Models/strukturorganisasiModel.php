<?php

namespace App\Models;

use CodeIgniter\Model;

class strukturorganisasiModel extends Model
{
    protected $table = 'tb_strukturorganisasi';
    protected $primaryKey = 'id_strukturorganisasi';
    protected $allowedFields = ['judul_strukturorganisasi', 'isi_strukturorganisasi', 'gambar_strukturorganisasi', 'slug_strukturorganisasi', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getstrukturorganisasi($slug_strukturorganisasi = false)
    {

        if ($slug_strukturorganisasi == false) {
            return $this->findAll();
        }

        return $this->where(['slug_strukturorganisasi' => $slug_strukturorganisasi])->first();
    }
}

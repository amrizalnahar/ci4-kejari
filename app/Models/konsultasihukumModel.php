<?php

namespace App\Models;

use CodeIgniter\Model;

class konsultasihukumModel extends Model
{
    protected $table = 'tb_konsultasihukum';
    protected $primaryKey = 'id_konsultasihukum';
    protected $allowedFields = ['judul_konsultasihukum', 'isi_konsultasihukum', 'gambar_konsultasihukum', 'slug_konsultasihukum', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getkonsultasihukum($slug_konsultasihukum = false)
    {

        if ($slug_konsultasihukum == false) {
            return $this->findAll();
        }

        return $this->where(['slug_konsultasihukum' => $slug_konsultasihukum])->first();
    }
}

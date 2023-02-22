<?php

namespace App\Models;

use CodeIgniter\Model;

class tentangkejariModel extends Model
{
    protected $table = 'tb_tentangkejari';
    protected $primaryKey = 'id_tentangkejari';
    protected $allowedFields = ['judul_tentangkejari', 'isi_tentangkejari', 'gambar_tentangkejari', 'slug_tentangkejari', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function gettentangkejari($slug_tentangkejari = false)
    {

        if ($slug_tentangkejari == false) {
            return $this->findAll();
        }

        return $this->where(['slug_tentangkejari' => $slug_tentangkejari])->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class eventkejaksaanModel extends Model
{
    protected $table = 'tb_eventkejaksaan';
    protected $primaryKey = 'id_eventkejaksaan';
    protected $allowedFields = ['judul_eventkejaksaan', 'slug_eventkejaksaan', 'isi_eventkejaksaan', 'tag_eventkejaksaan', 'gambar_eventkejaksaan'];
    protected $useTimestamps = true;

    public function geteventkejaksaan($slug_eventkejaksaan = false)
    {

        if ($slug_eventkejaksaan == false) {
            return $this->findAll();
        }

        return $this->where(['slug_eventkejaksaan' => $slug_eventkejaksaan])->first();
    }
}

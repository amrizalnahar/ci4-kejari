<?php

namespace App\Models;

use CodeIgniter\Model;

class posModel extends Model
{
    protected $table = 'tb_pos_kategori';
    protected $primaryKey = 'id_pos';
    protected $allowedFields = ['judul_pos', '
    isi_pos'];
    protected $useTimestamps = true;

    public function getPos($slug_pos = false)
    {

        if ($slug_pos == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pos' => $slug_pos])->first();
    }
}

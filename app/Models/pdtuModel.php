<?php

namespace App\Models;

use CodeIgniter\Model;

class pdtuModel extends Model
{
    protected $table = 'tb_pdtu';
    protected $primaryKey = 'id_pdtu';
    protected $allowedFields = ['judul_pdtu', 'isi_pdtu', 'gambar_pdtu', 'slug_pdtu', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpdtu($slug_pdtu = false)
    {

        if ($slug_pdtu == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pdtu' => $slug_pdtu])->first();
    }
}

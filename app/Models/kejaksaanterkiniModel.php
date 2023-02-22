<?php

namespace App\Models;

use CodeIgniter\Model;

class kejaksaanterkiniModel extends Model
{
    protected $table = 'tb_kejaksaanterkini';
    protected $primaryKey = 'id_kejaksaanterkini';
    protected $allowedFields = ['judul_kejaksaanterkini', 'slug_kejaksaanterkini', 'isi_kejaksaanterkini', 'tag_kejaksaanterkini', 'gambar_kejaksaanterkini'];
    protected $useTimestamps = true;

    public function getkejaksaanterkini($slug_kejaksaanterkini = false)
    {

        if ($slug_kejaksaanterkini == false) {
            return $this->findAll();
        }

        return $this->where(['slug_kejaksaanterkini' => $slug_kejaksaanterkini])->first();
    }
}

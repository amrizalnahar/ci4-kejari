<?php

namespace App\Models;

use CodeIgniter\Model;

class galeriModel extends Model
{
    protected $table = 'tb_galeri';
    protected $primaryKey = 'id_galeri';
    protected $allowedFields = ['judul_galeri', 'slug_galeri', 'isi_galeri', 'tag_galeri', 'gambar_galeri'];
    protected $useTimestamps = true;

    public function getgaleri($slug_galeri = false)
    {

        if ($slug_galeri == false) {
            return $this->findAll();
        }

        return $this->where(['slug_galeri' => $slug_galeri])->first();
    }
}

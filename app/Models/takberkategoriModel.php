<?php

namespace App\Models;

use CodeIgniter\Model;

class takberkategoriModel extends Model
{
    protected $table = 'tb_takberkategori';
    protected $primaryKey = 'id_takberkategori';
    protected $allowedFields = ['judul_takberkategori', 'slug_takberkategori', 'isi_takberkategori', 'tag_takberkategori', 'gambar_takberkategori'];
    protected $useTimestamps = true;

    public function gettakberkategori($slug_takberkategori = false)
    {

        if ($slug_takberkategori == false) {
            return $this->findAll();
        }

        return $this->where(['slug_takberkategori' => $slug_takberkategori])->first();
    }
}

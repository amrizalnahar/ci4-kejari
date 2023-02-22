<?php

namespace App\Models;

use CodeIgniter\Model;

class barbukdanbasanModel extends Model
{
    protected $table = 'tb_barbukdanbasan';
    protected $primaryKey = 'id_barbukdanbasan';
    protected $allowedFields = ['judul_barbukdanbasan', 'isi_barbukdanbasan', 'gambar_barbukdanbasan', 'slug_barbukdanbasan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getbarbukdanbasan($slug_barbukdanbasan = false)
    {

        if ($slug_barbukdanbasan == false) {
            return $this->findAll();
        }

        return $this->where(['slug_barbukdanbasan' => $slug_barbukdanbasan])->first();
    }
}

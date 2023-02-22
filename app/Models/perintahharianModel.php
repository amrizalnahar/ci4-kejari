<?php

namespace App\Models;

use CodeIgniter\Model;

class perintahharianModel extends Model
{
    protected $table = 'tb_perintahharian';
    protected $primaryKey = 'id_perintahharian';
    protected $allowedFields = ['judul_perintahharian', 'isi_perintahharian', 'gambar_perintahharian', 'slug_perintahharian', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getperintahharian($slug_perintahharian = false)
    {

        if ($slug_perintahharian == false) {
            return $this->findAll();
        }

        return $this->where(['slug_perintahharian' => $slug_perintahharian])->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class pidumModel extends Model
{
    protected $table = 'tb_pidum';
    protected $primaryKey = 'id_pidum';
    protected $allowedFields = ['judul_pidum', 'isi_pidum', 'gambar_pidum', 'slug_pidum', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getpidum($slug_pidum = false)
    {

        if ($slug_pidum == false) {
            return $this->findAll();
        }

        return $this->where(['slug_pidum' => $slug_pidum])->first();
    }
}

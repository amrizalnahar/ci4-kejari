<?php

namespace App\Models;

use CodeIgniter\Model;

class penggunaModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'fullname', 'user_image', 'password_hash'];
    protected $useTimestamps = true;
}

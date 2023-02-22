<?php

namespace App\Controllers\Admin;

use App\Models\penggunaModel;

class Semuapengguna extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->penggunaModel = new penggunaModel();
    }
    public function index()
    {
        $this->builder->select('users.id as userid, username,fullname, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        $data = [
            'title' => 'Pengguna | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pengguna',
            'currentAdminSubMenu' => 'semuapengguna'
        ];
        $data['users'] = $query->getResultArray();
        return view('pages/admin/semuapengguna', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Tambah Pengguna Baru | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pengguna',
            'currentAdminSubMenu' => 'tambahpengguna'
        ];
        return view('pages/admin/tambahpengguna', $data);
    }
}

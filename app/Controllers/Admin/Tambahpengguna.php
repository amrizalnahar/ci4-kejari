<?php

namespace App\Controllers\Admin;

class Tambahpengguna extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tambah Pengguna Baru | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pengguna',
            'currentAdminSubMenu' => 'tambahpengguna'
        ];
        return view('pages/admin/tambahpengguna', $data);
    }
}

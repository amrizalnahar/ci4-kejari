<?php

namespace App\Controllers\Admin;

class Profilpengguna extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profil Penguna | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pengguna',
            'currentAdminSubMenu' => 'profilpengguna'
        ];
        return view('pages/admin/profilpengguna', $data);
    }
}

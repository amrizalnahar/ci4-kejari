<?php

namespace App\Controllers\Admin;

class Pembaharuan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pembaharuan | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'home',
            'currentAdminSubMenu' => 'pembaharuan'
        ];
        return view('pages/admin/pembaharuan', $data);
    }
}

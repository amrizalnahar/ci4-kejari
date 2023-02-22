<?php

namespace App\Controllers\Admin;

class Home extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Dasbor | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'home',
            'currentAdminSubMenu' => 'dashboard',
        ];
        return view('pages/admin/dashboard', $data);
    }
}

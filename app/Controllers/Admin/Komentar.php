<?php

namespace App\Controllers\Admin;

class Komentar extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Komentar | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'komentar',
            'currentAdminSubMenu' => 'komentar'
        ];
        return view('pages/admin/komentar', $data);
    }
}

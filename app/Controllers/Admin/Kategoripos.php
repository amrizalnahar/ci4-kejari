<?php

namespace App\Controllers\Admin;

class Kategoripos extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Kategori Pos | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'kategoripos'
        ];
        return view('pages/admin/kategoripos', $data);
    }
}

<?php

namespace App\Controllers\Admin;

class Pengaduanmasyarakat extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pengaduan Masyarakat | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pengaduanmasyarakat',
            'currentAdminSubMenu' => 'pengaduanmasyarakat'
        ];
        return view('pages/admin/pengaduanmasyarakat', $data);
    }
}

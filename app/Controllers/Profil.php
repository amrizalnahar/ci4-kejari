<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index()
    {
        return view('pages/profil_sambutan');
    }

    public function tentang()
    {
        return view('pages/profil_tentang');
    }
}

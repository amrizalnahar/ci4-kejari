<?php

namespace App\Controllers\Admin;

use App\Models\adkModel;
use App\Models\barbukdanbasanModel;
use App\Models\berandaModel;
use App\Models\datunModel;
use App\Models\intelijenModel;
use App\Models\jadwalsidangModel;
use App\Models\katasambutanModel;
use App\Models\kejaksaanterkiniModel;
use App\Models\konsultasihukumModel;
use App\Models\kontakModel;
use App\Models\pdtuModel;
use App\Models\pembinaanModel;
use App\Models\peraturanModel;
use App\Models\perintahharianModel;
use App\Models\pidanakhususModel;
use App\Models\pidanaumumModel;
use App\Models\pidsusModel;
use App\Models\pidumModel;
use App\Models\strukturorganisasiModel;
use App\Models\tentangkejariModel;
use App\Models\visidanmisiModel;

class Semualaman extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_berita');
        $this->builder = $this->db->table('tb_datatilang');
        $this->builder = $this->db->table('tb_eventkejaksaan');
        $this->builder = $this->db->table('tb_galeri');
        $this->builder = $this->db->table('tb_kejaksaanterkini');
        $this->builder = $this->db->table('tb_takberkategori');
        $this->adkModel = new adkModel();
        $this->barbukdanbasanModel = new barbukdanbasanModel();
        $this->berandaModel = new berandaModel();
        $this->datunModel = new datunModel();
        $this->intelijenModel = new intelijenModel();
        $this->jadwalsidangModel = new jadwalsidangModel();
        $this->katasambutanModel = new katasambutanModel();
        $this->konsultasihukumModel = new konsultasihukumModel();
        $this->kontakModel = new kontakModel();
        $this->pdtuModel = new pdtuModel();
        $this->pembinaanModel = new pembinaanModel();
        $this->peraturanModel = new peraturanModel();
        $this->perintahharianModel = new perintahharianModel();
        $this->pidanakhususModel = new pidanakhususModel();
        $this->pidanaumumModel = new pidanaumumModel();
        $this->pidsusModel = new pidsusModel();
        $this->pidumModel = new pidumModel();
        $this->strukturorganisasiModel = new strukturorganisasiModel();
        $this->tentangkejariModel = new tentangkejariModel();
        $this->visidanmisiModel = new visidanmisiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Laman | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'adk' =>  $this->adkModel->getAdk(),
            'barbukdanbasan' =>  $this->barbukdanbasanModel->getbarbukdanbasan(),
            'beranda' =>  $this->berandaModel->getberanda(),
            'datun' =>  $this->datunModel->getdatun(),
            'intelijen' =>  $this->intelijenModel->getintelijen(),
            'jadwalsidang' =>  $this->jadwalsidangModel->getjadwalsidang(),
            'katasambutan' =>  $this->katasambutanModel->getkatasambutan(),
            'konsultasihukum' =>  $this->konsultasihukumModel->getkonsultasihukum(),
            'kontak' =>  $this->kontakModel->getkontak(),
            'pdtu' =>  $this->pdtuModel->getpdtu(),
            'pembinaan' =>  $this->pembinaanModel->getpembinaan(),
            'peraturan' =>  $this->peraturanModel->getperaturan(),
            'perintahharian' =>  $this->perintahharianModel->getperintahharian(),
            'pidanakhusus' =>  $this->pidanakhususModel->getpidanakhusus(),
            'pidanaumum' =>  $this->pidanaumumModel->getpidanaumum(),
            'pidsus' =>  $this->pidsusModel->getpidsus(),
            'pidum' =>  $this->pidumModel->getpidum(),
            'strukturorganisasi' =>  $this->strukturorganisasiModel->getstrukturorganisasi(),
            'tentangkejari' =>  $this->tentangkejariModel->gettentangkejari(),
            'visidanmisi' =>  $this->visidanmisiModel->getvisidanmisi(),
        ];
        return view('pages/admin/semualaman', $data);
    }
}

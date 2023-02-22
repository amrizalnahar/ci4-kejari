<?php

namespace App\Controllers\Admin;

use App\Models\beritaModel;
use App\Models\datatilangModel;
use App\Models\eventkejaksaanModel;
use App\Models\galeriModel;
use App\Models\kejaksaanterkiniModel;
use App\Models\takberkategoriModel;

class Semuapos extends BaseController
{
    protected $beritaModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_berita');
        $this->builder = $this->db->table('tb_datatilang');
        $this->builder = $this->db->table('tb_eventkejaksaan');
        $this->builder = $this->db->table('tb_galeri');
        $this->builder = $this->db->table('tb_kejaksaanterkini');
        $this->builder = $this->db->table('tb_takberkategori');
        $this->beritaModel = new beritaModel();
        $this->datatilangModel = new datatilangModel();
        $this->eventkejaksaanModel = new eventkejaksaanModel();
        $this->galeriModel = new galeriModel();
        $this->kejaksaanterkiniModel = new kejaksaanterkiniModel();
        $this->takberkategoriModel = new takberkategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Semua Pos | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semuapos',
            'currentAdminSubMenu' => 'semuapos',
            'berita' =>  $this->beritaModel->getberita(),
            'datatilang' =>  $this->datatilangModel->getdatatilang(),
            'eventkejaksaan' =>  $this->eventkejaksaanModel->geteventkejaksaan(),
            'galeri' =>  $this->galeriModel->getgaleri(),
            'kejaksaanterkini' =>  $this->kejaksaanterkiniModel->getkejaksaanterkini(),
            'takberkategori' =>  $this->takberkategoriModel->gettakberkategori(),
        ];

        return view('pages/admin/semuapos', $data);
    }

    // public function index()
    // {
    //     // $tb_berita = $this->beritaModel->findAll();
    //     $this->builder->select('*');

    //     $this->builder->join('tb_pos_kategori', 'tb_pos_kategori.id_berita = tb_berita.id_berita');

    //     $this->builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pos_kategori.id_berita');

    //     $query = $this->builder->get();
    //     $data['tb_berita'] = $query->getResultArray();
    //     $data = [
    //         'title' => 'berita | Kejaksaan Kabupaten Pekalongan',
    //         'currentAdminMenu' => 'berita',
    //         'currentAdminSubMenu' => 'semuaberita',
    //         'tb_berita' =>  $this->beritaModel->getberita()
    //     ];

    //     return view('pages/admin/semuapos', $data);
    // }

    // public function detail($slug_berita)
    // {

    //     $data = [
    //         'title' => 'Detail berita',
    //         'tb_berita' => $this->beritaModel->getberita($slug_berita)
    //     ];

    //     // jika berita tidak ada dalam tabel
    //     if (empty($data['tb_berita'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul berita ' . $slug_berita . ' tidak ditemukan.');
    //     }

    //     return view('pages/admin/semuaberita_detail', $data);
    // }

    // public function tambahberita()
    // {
    //     $data = [
    //         'title' => 'Tambah berita Baru | Kejaksaan Kabupaten Pekalongan',
    //         'currentAdminMenu' => 'berita',
    //         'currentAdminSubMenu' => 'tambahberita'
    //     ];

    //     return view('pages/admin/tambahberita', $data);
    // }

    // public function kirim()
    // {
    //     $data = [
    //         'title' => 'Tambah berita Baru | Kejaksaan Kabupaten Pekalongan',
    //         'currentAdminMenu' => 'berita',
    //         'currentAdminSubMenu' => 'tambahberita',
    //     ];
    //     $data1 = [
    //         'judul_berita' => $this->request->Getberitat('judul_berita'),
    //         'isi_berita' => str_replace('$nbsp;', '', $this->request->Getberitat('tb_berita'))
    //     ];
    //     $this->db->insert('tb_berita', $data1);

    //     return view('pages/admin/tambahberita', $data);
    // }

    // public function detaile()
    // {
    //     $data1['isi_berita'] = $this->db->get_where('tb_berita', ['id_berita' => 1])->row_array();

    //     return view('pages/admin/semuaberita_detail', $data1);
    // }
}

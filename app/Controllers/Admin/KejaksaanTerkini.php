<?php

namespace App\Controllers\Admin;

use App\Models\kejaksaanterkiniModel;

class kejaksaanterkini extends BaseController
{
    protected $kejaksaanterkiniModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_kejaksaanterkini');
        $this->kejaksaanterkiniModel  = new kejaksaanterkiniModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'Kejaksaan Terkini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'kejaksaanterkini',
            'tb_kejaksaanterkini' =>  $this->kejaksaanterkiniModel->getkejaksaanterkini()
        ];

        return view('pages/admin/kejaksaanterkini', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kejaksaan Terkini | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'kejaksaanterkini',
        ];

        return view('pages/admin/tambahkejaksaanterkini', $data);
    }

    public function detail($slug_kejaksaanterkini)
    {

        $data = [
            'title' => 'Detail Kejaksaan Terkini | Admin Kelurahan Sapugarut',
            'kejaksaanterkini' => $this->kejaksaanterkiniModel->getkejaksaanterkini($slug_kejaksaanterkini),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'kejaksaanterkini',

        ];

        return view('pages/admin/kejaksaanterkini_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_kejaksaanterkini' =>  [
                'rules' => 'required|is_unique[tb_kejaksaanterkini.judul_kejaksaanterkini]',
                'errors' => [
                    'required' => 'Judul kejaksaanterkini harus diisi.',
                    'is_unique' => 'Judul kejaksaanterkini sudah terdaftar'
                ]
            ],
            'isi_kejaksaanterkini' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi kejaksaanterkini harus diisi.',
                ]
            ],
            'gambar_kejaksaanterkini' => [
                'rules' => 'uploaded[gambar_kejaksaanterkini]|max_size[gambar_kejaksaanterkini,1024]|is_image[gambar_kejaksaanterkini]|mime_in[gambar_kejaksaanterkini,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/kejaksaanterkini/create')->withInput();
        }
        $fileGambarkejaksaanterkini = $this->request->getFile('gambar_kejaksaanterkini');
        // generate nama gambarkejaksaanterkini random
        $namaGambarkejaksaanterkini = $fileGambarkejaksaanterkini->getRandomName();
        // pindahkan file ke folder img
        $fileGambarkejaksaanterkini->move('img_simpan', $namaGambarkejaksaanterkini);

        $slug_kejaksaanterkini = url_title($this->request->getVar('judul_kejaksaanterkini'), '-', true);
        $this->kejaksaanterkiniModel->save([
            'judul_kejaksaanterkini' => $this->request->getVar('judul_kejaksaanterkini'),
            'isi_kejaksaanterkini' => $this->request->getVar('isi_kejaksaanterkini'),
            'tag_kejaksaanterkini' => $this->request->getVar('tag_kejaksaanterkini'),
            'slug_kejaksaanterkini' => $slug_kejaksaanterkini,
            'gambar_kejaksaanterkini' => $namaGambarkejaksaanterkini,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/kejaksaanterkini');
    }

    public function delete($id_kejaksaanterkini)
    {
        // cari gambar berdasarkan id
        $kejaksaanterkini = $this->kejaksaanterkiniModel->find($id_kejaksaanterkini);

        // cek jika file gambarnya default.png

        if ($kejaksaanterkini['gambar_kejaksaanterkini'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $kejaksaanterkini['gambar_kejaksaanterkini']);
        }

        $this->kejaksaanterkiniModel->delete($id_kejaksaanterkini);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/kejaksaanterkini');
    }

    public function edit($slug_kejaksaanterkini)
    {
        $data = [
            'title' => 'Form Edit Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'kejaksaanterkini' => $this->kejaksaanterkiniModel->getkejaksaanterkini($slug_kejaksaanterkini),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'kejaksaanterkini',
        ];

        return view('pages/admin/editkejaksaanterkini', $data);
    }

    public function update($id_kejaksaanterkini)
    {
        // cek judul
        $kejaksaanterkiniLama = $this->kejaksaanterkiniModel->getkejaksaanterkini($this->request->getVar('slug_kejaksaanterkini'));

        if ($kejaksaanterkiniLama['judul_kejaksaanterkini'] == $this->request->getVar('judul_kejaksaanterkini')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_kejaksaanterkini.judul_kejaksaanterkini]';
        }
        // validasi input
        if (!$this->validate([
            'judul_kejaksaanterkini' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Data Tilang harus diisi.',
                    'is_unique' => 'Judul Data Tilang sudah terdaftar'
                ]
            ],
            'gambar_kejaksaanterkini' => [
                'rules' => 'uploaded[gambar_kejaksaanterkini]|max_size[gambar_kejaksaanterkini,1024]|is_image[gambar_kejaksaanterkini]|mime_in[gambar_kejaksaanterkini,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/kejaksaanterkini/edit/' . $this->request->getVar('slug_kejaksaanterkini'))->withInput();
        }

        $filegambarkejaksaanterkini = $this->request->getFile('gambar_kejaksaanterkini');

        // cek gambar, apakah tetap gambar lama
        if ($filegambarkejaksaanterkini->getError() == 4) {
            $namagambarkejaksaanterkini = $this->request->getVar('gambar_kejaksaanterkiniLama');
        } else {
            // generate nama file random
            $namagambarkejaksaanterkini = $filegambarkejaksaanterkini->getRandomName();
            // pindahkan gambar
            $filegambarkejaksaanterkini->move('img_simpan', $namagambarkejaksaanterkini);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_kejaksaanterkiniLama'));
        }

        $slug_kejaksaanterkini = url_title($this->request->getVar('judul_kejaksaanterkini'), '-', true);
        $this->kejaksaanterkiniModel->save([
            'id_kejaksaanterkini' => $id_kejaksaanterkini,
            'judul_kejaksaanterkini' => $this->request->getVar('judul_kejaksaanterkini'),
            'slug_kejaksaanterkini' => $slug_kejaksaanterkini,
            'isi_kejaksaanterkini' => $this->request->getVar('isi_kejaksaanterkini'),
            'gambar_kejaksaanterkini' => $namagambarkejaksaanterkini
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/kejaksaanterkini');
    }
}

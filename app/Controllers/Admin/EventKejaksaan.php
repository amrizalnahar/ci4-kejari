<?php

namespace App\Controllers\Admin;

use App\Models\eventkejaksaanModel;

class eventkejaksaan extends BaseController
{
    protected $eventkejaksaanModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_eventkejaksaan');
        $this->eventkejaksaanModel  = new eventkejaksaanModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'eventkejaksaan',
            'tb_eventkejaksaan' =>  $this->eventkejaksaanModel->geteventkejaksaan()
        ];

        return view('pages/admin/eventkejaksaan', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Tilang Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'eventkejaksaan',
        ];

        return view('pages/admin/tambaheventkejaksaan', $data);
    }

    public function detail($slug_eventkejaksaan)
    {

        $data = [
            'title' => 'Detail Data Tilang | Admin Kelurahan Sapugarut',
            'eventkejaksaan' => $this->eventkejaksaanModel->geteventkejaksaan($slug_eventkejaksaan),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'eventkejaksaan',

        ];

        return view('pages/admin/eventkejaksaan_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_eventkejaksaan' =>  [
                'rules' => 'required|is_unique[tb_eventkejaksaan.judul_eventkejaksaan]',
                'errors' => [
                    'required' => 'Judul eventkejaksaan harus diisi.',
                    'is_unique' => 'Judul eventkejaksaan sudah terdaftar'
                ]
            ],
            'isi_eventkejaksaan' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi eventkejaksaan harus diisi.',
                ]
            ],
            'gambar_eventkejaksaan' => [
                'rules' => 'uploaded[gambar_eventkejaksaan]|max_size[gambar_eventkejaksaan,1024]|is_image[gambar_eventkejaksaan]|mime_in[gambar_eventkejaksaan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/eventkejaksaan/create')->withInput();
        }
        $fileGambareventkejaksaan = $this->request->getFile('gambar_eventkejaksaan');
        // generate nama gambareventkejaksaan random
        $namaGambareventkejaksaan = $fileGambareventkejaksaan->getRandomName();
        // pindahkan file ke folder img
        $fileGambareventkejaksaan->move('img_simpan', $namaGambareventkejaksaan);

        $slug_eventkejaksaan = url_title($this->request->getVar('judul_eventkejaksaan'), '-', true);
        $this->eventkejaksaanModel->save([
            'judul_eventkejaksaan' => $this->request->getVar('judul_eventkejaksaan'),
            'isi_eventkejaksaan' => $this->request->getVar('isi_eventkejaksaan'),
            'tag_eventkejaksaan' => $this->request->getVar('tag_eventkejaksaan'),
            'slug_eventkejaksaan' => $slug_eventkejaksaan,
            'gambar_eventkejaksaan' => $namaGambareventkejaksaan,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/eventkejaksaan');
    }

    public function delete($id_eventkejaksaan)
    {
        // cari gambar berdasarkan id
        $eventkejaksaan = $this->eventkejaksaanModel->find($id_eventkejaksaan);

        // cek jika file gambarnya default.png

        if ($eventkejaksaan['gambar_eventkejaksaan'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $eventkejaksaan['gambar_eventkejaksaan']);
        }

        $this->eventkejaksaanModel->delete($id_eventkejaksaan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/eventkejaksaan');
    }

    public function edit($slug_eventkejaksaan)
    {
        $data = [
            'title' => 'Form Edit Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'eventkejaksaan' => $this->eventkejaksaanModel->geteventkejaksaan($slug_eventkejaksaan),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'eventkejaksaan',
        ];

        return view('pages/admin/editeventkejaksaan', $data);
    }

    public function update($id_eventkejaksaan)
    {
        // cek judul
        $eventkejaksaanLama = $this->eventkejaksaanModel->geteventkejaksaan($this->request->getVar('slug_eventkejaksaan'));

        if ($eventkejaksaanLama['judul_eventkejaksaan'] == $this->request->getVar('judul_eventkejaksaan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_eventkejaksaan.judul_eventkejaksaan]';
        }
        // validasi input
        if (!$this->validate([
            'judul_eventkejaksaan' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Data Tilang harus diisi.',
                    'is_unique' => 'Judul Data Tilang sudah terdaftar'
                ]
            ],
            'gambar_eventkejaksaan' => [
                'rules' => 'uploaded[gambar_eventkejaksaan]|max_size[gambar_eventkejaksaan,1024]|is_image[gambar_eventkejaksaan]|mime_in[gambar_eventkejaksaan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/eventkejaksaan/edit/' . $this->request->getVar('slug_eventkejaksaan'))->withInput();
        }

        $filegambareventkejaksaan = $this->request->getFile('gambar_eventkejaksaan');

        // cek gambar, apakah tetap gambar lama
        if ($filegambareventkejaksaan->getError() == 4) {
            $namagambareventkejaksaan = $this->request->getVar('gambar_eventkejaksaanLama');
        } else {
            // generate nama file random
            $namagambareventkejaksaan = $filegambareventkejaksaan->getRandomName();
            // pindahkan gambar
            $filegambareventkejaksaan->move('img_simpan', $namagambareventkejaksaan);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_eventkejaksaanLama'));
        }

        $slug_eventkejaksaan = url_title($this->request->getVar('judul_eventkejaksaan'), '-', true);
        $this->eventkejaksaanModel->save([
            'id_eventkejaksaan' => $id_eventkejaksaan,
            'judul_eventkejaksaan' => $this->request->getVar('judul_eventkejaksaan'),
            'slug_eventkejaksaan' => $slug_eventkejaksaan,
            'isi_eventkejaksaan' => $this->request->getVar('isi_eventkejaksaan'),
            'gambar_eventkejaksaan' => $namagambareventkejaksaan
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/eventkejaksaan');
    }
}

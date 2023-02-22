<?php

namespace App\Controllers\Admin;

use App\Models\takberkategoriModel;

class takberkategori extends BaseController
{
    protected $takberkategoriModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_takberkategori');
        $this->takberkategoriModel  = new takberkategoriModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'Data | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'takberkategori',
            'tb_takberkategori' =>  $this->takberkategoriModel->gettakberkategori()
        ];

        return view('pages/admin/takberkategori', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'takberkategori',
        ];

        return view('pages/admin/tambahtakberkategori', $data);
    }

    public function detail($slug_takberkategori)
    {

        $data = [
            'title' => 'Detail | Admin Kelurahan Sapugarut',
            'takberkategori' => $this->takberkategoriModel->gettakberkategori($slug_takberkategori),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'takberkategori',

        ];

        return view('pages/admin/takberkategori_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_takberkategori' =>  [
                'rules' => 'required|is_unique[tb_takberkategori.judul_takberkategori]',
                'errors' => [
                    'required' => 'Judul takberkategori harus diisi.',
                    'is_unique' => 'Judul takberkategori sudah terdaftar'
                ]
            ],
            'isi_takberkategori' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi takberkategori harus diisi.',
                ]
            ],
            'gambar_takberkategori' => [
                'rules' => 'uploaded[gambar_takberkategori]|max_size[gambar_takberkategori,1024]|is_image[gambar_takberkategori]|mime_in[gambar_takberkategori,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/takberkategori/create')->withInput();
        }
        $fileGambartakberkategori = $this->request->getFile('gambar_takberkategori');
        // generate nama gambartakberkategori random
        $namaGambartakberkategori = $fileGambartakberkategori->getRandomName();
        // pindahkan file ke folder img
        $fileGambartakberkategori->move('img_simpan', $namaGambartakberkategori);

        $slug_takberkategori = url_title($this->request->getVar('judul_takberkategori'), '-', true);
        $this->takberkategoriModel->save([
            'judul_takberkategori' => $this->request->getVar('judul_takberkategori'),
            'isi_takberkategori' => $this->request->getVar('isi_takberkategori'),
            'tag_takberkategori' => $this->request->getVar('tag_takberkategori'),
            'slug_takberkategori' => $slug_takberkategori,
            'gambar_takberkategori' => $namaGambartakberkategori,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/takberkategori');
    }

    public function delete($id_takberkategori)
    {
        // cari gambar berdasarkan id
        $takberkategori = $this->takberkategoriModel->find($id_takberkategori);

        // cek jika file gambarnya default.png

        if ($takberkategori['gambar_takberkategori'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $takberkategori['gambar_takberkategori']);
        }

        $this->takberkategoriModel->delete($id_takberkategori);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/takberkategori');
    }

    public function edit($slug_takberkategori)
    {
        $data = [
            'title' => 'Form Edit Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'takberkategori' => $this->takberkategoriModel->gettakberkategori($slug_takberkategori),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'takberkategori',
        ];

        return view('pages/admin/edittakberkategori', $data);
    }

    public function update($id_takberkategori)
    {
        // cek judul
        $takberkategoriLama = $this->takberkategoriModel->gettakberkategori($this->request->getVar('slug_takberkategori'));

        if ($takberkategoriLama['judul_takberkategori'] == $this->request->getVar('judul_takberkategori')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_takberkategori.judul_takberkategori]';
        }
        // validasi input
        if (!$this->validate([
            'judul_takberkategori' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Data Tilang harus diisi.',
                    'is_unique' => 'Judul Data Tilang sudah terdaftar'
                ]
            ],
            'gambar_takberkategori' => [
                'rules' => 'uploaded[gambar_takberkategori]|max_size[gambar_takberkategori,1024]|is_image[gambar_takberkategori]|mime_in[gambar_takberkategori,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/takberkategori/edit/' . $this->request->getVar('slug_takberkategori'))->withInput();
        }

        $filegambartakberkategori = $this->request->getFile('gambar_takberkategori');

        // cek gambar, apakah tetap gambar lama
        if ($filegambartakberkategori->getError() == 4) {
            $namagambartakberkategori = $this->request->getVar('gambar_takberkategoriLama');
        } else {
            // generate nama file random
            $namagambartakberkategori = $filegambartakberkategori->getRandomName();
            // pindahkan gambar
            $filegambartakberkategori->move('img_simpan', $namagambartakberkategori);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_takberkategoriLama'));
        }

        $slug_takberkategori = url_title($this->request->getVar('judul_takberkategori'), '-', true);
        $this->takberkategoriModel->save([
            'id_takberkategori' => $id_takberkategori,
            'judul_takberkategori' => $this->request->getVar('judul_takberkategori'),
            'slug_takberkategori' => $slug_takberkategori,
            'isi_takberkategori' => $this->request->getVar('isi_takberkategori'),
            'gambar_takberkategori' => $namagambartakberkategori
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/takberkategori');
    }
}

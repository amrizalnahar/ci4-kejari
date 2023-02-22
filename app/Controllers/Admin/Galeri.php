<?php

namespace App\Controllers\Admin;

use App\Models\galeriModel;

class galeri extends BaseController
{
    protected $galeriModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_galeri');
        $this->galeriModel  = new galeriModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'galeri | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'galeri',
            'tb_galeri' =>  $this->galeriModel->getgaleri()
        ];

        return view('pages/admin/galeri', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah galeri Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'galeri',
        ];

        return view('pages/admin/tambahgaleri', $data);
    }

    public function detail($slug_galeri)
    {
        $data = [
            'title' => 'Detail galeri | Admin Kelurahan Sapugarut',
            'galeri' => $this->galeriModel->getgaleri($slug_galeri),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'galeri',

        ];

        return view('pages/admin/galeri_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_galeri' =>  [
                'rules' => 'required|is_unique[tb_galeri.judul_galeri]',
                'errors' => [
                    'required' => 'Judul galeri harus diisi.',
                    'is_unique' => 'Judul galeri sudah terdaftar'
                ]
            ],
            'isi_galeri' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi galeri harus diisi.',
                ]
            ],
            'gambar_galeri' => [
                'rules' => 'uploaded[gambar_galeri]|max_size[gambar_galeri,1024]|is_image[gambar_galeri]|mime_in[gambar_galeri,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/galeri/create')->withInput();
        }
        $fileGambargaleri = $this->request->getFile('gambar_galeri');
        // generate nama gambargaleri random
        $namaGambargaleri = $fileGambargaleri->getRandomName();
        // pindahkan file ke folder img
        $fileGambargaleri->move('img_simpan', $namaGambargaleri);

        $slug_galeri = url_title($this->request->getVar('judul_galeri'), '-', true);
        $this->galeriModel->save([
            'judul_galeri' => $this->request->getVar('judul_galeri'),
            'isi_galeri' => $this->request->getVar('isi_galeri'),
            'tag_galeri' => $this->request->getVar('tag_galeri'),
            'slug_galeri' => $slug_galeri,
            'gambar_galeri' => $namaGambargaleri,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/galeri');
    }

    public function delete($id_galeri)
    {
        // cari gambar berdasarkan id
        $galeri = $this->galeriModel->find($id_galeri);

        // cek jika file gambarnya default.png

        if ($galeri['gambar_galeri'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $galeri['gambar_galeri']);
        }

        $this->galeriModel->delete($id_galeri);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/galeri');
    }

    public function edit($slug_galeri)
    {
        $data = [
            'title' => 'Form Edit galeri | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'galeri' => $this->galeriModel->getgaleri($slug_galeri),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'galeri',
        ];

        return view('pages/admin/editgaleri', $data);
    }

    public function update($id_galeri)
    {
        // cek judul
        $galeriLama = $this->galeriModel->getgaleri($this->request->getVar('slug_galeri'));

        if ($galeriLama['judul_galeri'] == $this->request->getVar('judul_galeri')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_galeri.judul_galeri]';
        }
        // validasi input
        if (!$this->validate([
            'judul_galeri' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul galeri harus diisi.',
                    'is_unique' => 'Judul galeri sudah terdaftar'
                ]
            ],
            'gambar_galeri' => [
                'rules' => 'uploaded[gambar_galeri]|max_size[gambar_galeri,1024]|is_image[gambar_galeri]|mime_in[gambar_galeri,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/galeri/edit/' . $this->request->getVar('slug_galeri'))->withInput();
        }

        $filegambargaleri = $this->request->getFile('gambar_galeri');

        // cek gambar, apakah tetap gambar lama
        if ($filegambargaleri->getError() == 4) {
            $namagambargaleri = $this->request->getVar('gambar_galeriLama');
        } else {
            // generate nama file random
            $namagambargaleri = $filegambargaleri->getRandomName();
            // pindahkan gambar
            $filegambargaleri->move('img_simpan', $namagambargaleri);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_galeriLama'));
        }

        $slug_galeri = url_title($this->request->getVar('judul_galeri'), '-', true);
        $this->galeriModel->save([
            'id_galeri' => $id_galeri,
            'judul_galeri' => $this->request->getVar('judul_galeri'),
            'slug_galeri' => $slug_galeri,
            'isi_galeri' => $this->request->getVar('isi_galeri'),
            'gambar_galeri' => $namagambargaleri
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/galeri');
    }
}

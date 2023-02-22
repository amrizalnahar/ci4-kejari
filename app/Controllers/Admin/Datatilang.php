<?php

namespace App\Controllers\Admin;

use App\Models\datatilangModel;

class datatilang extends BaseController
{
    protected $datatilangModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_datatilang');
        $this->datatilangModel  = new datatilangModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'datatilang',
            'tb_datatilang' =>  $this->datatilangModel->getdatatilang()
        ];

        return view('pages/admin/datatilang', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Tilang Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'datatilang',
        ];

        return view('pages/admin/tambahdatatilang', $data);
    }

    public function detail($slug_datatilang)
    {

        $data = [
            'title' => 'Detail Data Tilang | Admin Kelurahan Sapugarut',
            'datatilang' => $this->datatilangModel->getdatatilang($slug_datatilang),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'datatilang',

        ];

        return view('pages/admin/datatilang_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_datatilang' =>  [
                'rules' => 'required|is_unique[tb_datatilang.judul_datatilang]',
                'errors' => [
                    'required' => 'Judul datatilang harus diisi.',
                    'is_unique' => 'Judul datatilang sudah terdaftar'
                ]
            ],
            'isi_datatilang' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi datatilang harus diisi.',
                ]
            ],
            'gambar_datatilang' => [
                'rules' => 'uploaded[gambar_datatilang]|max_size[gambar_datatilang,1024]|is_image[gambar_datatilang]|mime_in[gambar_datatilang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/datatilang/create')->withInput();
        }
        $fileGambardatatilang = $this->request->getFile('gambar_datatilang');
        // generate nama gambardatatilang random
        $namaGambardatatilang = $fileGambardatatilang->getRandomName();
        // pindahkan file ke folder img
        $fileGambardatatilang->move('img_simpan', $namaGambardatatilang);

        $slug_datatilang = url_title($this->request->getVar('judul_datatilang'), '-', true);
        $this->datatilangModel->save([
            'judul_datatilang' => $this->request->getVar('judul_datatilang'),
            'isi_datatilang' => $this->request->getVar('isi_datatilang'),
            'tag_datatilang' => $this->request->getVar('tag_datatilang'),
            'slug_datatilang' => $slug_datatilang,
            'gambar_datatilang' => $namaGambardatatilang,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/datatilang');
    }

    public function delete($id_datatilang)
    {
        // cari gambar berdasarkan id
        $datatilang = $this->datatilangModel->find($id_datatilang);

        // cek jika file gambarnya default.png

        if ($datatilang['gambar_datatilang'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $datatilang['gambar_datatilang']);
        }

        $this->datatilangModel->delete($id_datatilang);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/datatilang');
    }

    public function edit($slug_datatilang)
    {
        $data = [
            'title' => 'Form Edit Data Tilang | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'datatilang' => $this->datatilangModel->getdatatilang($slug_datatilang),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'datatilang',
        ];

        return view('pages/admin/editdatatilang', $data);
    }

    public function update($id_datatilang)
    {
        // cek judul
        $datatilangLama = $this->datatilangModel->getdatatilang($this->request->getVar('slug_datatilang'));

        if ($datatilangLama['judul_datatilang'] == $this->request->getVar('judul_datatilang')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_datatilang.judul_datatilang]';
        }
        // validasi input
        if (!$this->validate([
            'judul_datatilang' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Data Tilang harus diisi.',
                    'is_unique' => 'Judul Data Tilang sudah terdaftar'
                ]
            ],
            'gambar_datatilang' => [
                'rules' => 'uploaded[gambar_datatilang]|max_size[gambar_datatilang,1024]|is_image[gambar_datatilang]|mime_in[gambar_datatilang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/datatilang/edit/' . $this->request->getVar('slug_datatilang'))->withInput();
        }

        $filegambardatatilang = $this->request->getFile('gambar_datatilang');

        // cek gambar, apakah tetap gambar lama
        if ($filegambardatatilang->getError() == 4) {
            $namagambardatatilang = $this->request->getVar('gambar_datatilangLama');
        } else {
            // generate nama file random
            $namagambardatatilang = $filegambardatatilang->getRandomName();
            // pindahkan gambar
            $filegambardatatilang->move('img_simpan', $namagambardatatilang);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_datatilangLama'));
        }

        $slug_datatilang = url_title($this->request->getVar('judul_datatilang'), '-', true);
        $this->datatilangModel->save([
            'id_datatilang' => $id_datatilang,
            'judul_datatilang' => $this->request->getVar('judul_datatilang'),
            'slug_datatilang' => $slug_datatilang,
            'isi_datatilang' => $this->request->getVar('isi_datatilang'),
            'gambar_datatilang' => $namagambardatatilang
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/datatilang');
    }
}

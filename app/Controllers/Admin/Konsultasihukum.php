<?php

namespace App\Controllers\Admin;

use App\Models\konsultasihukumModel;

class konsultasihukum extends BaseController
{
    protected $konsultasihukumModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_konsultasihukum');
        $this->konsultasihukumModel  = new konsultasihukumModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'konsultasihukum' =>  $this->konsultasihukumModel->getkonsultasihukum()
        ];

        return view('pages/admin/laman/konsultasihukum', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah konsultasihukum Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_konsultasihukum', $data);
    }

    public function detail($slug_konsultasihukum)
    {
        $data = [
            'title' => 'Detail konsultasihukum | Admin Kelurahan Sapugarut',
            'konsultasihukum' => $this->konsultasihukumModel->getkonsultasihukum($slug_konsultasihukum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/konsultasihukum_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_konsultasihukum' =>  [
                'rules' => 'required|is_unique[tb_konsultasihukum.judul_konsultasihukum]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_konsultasihukum' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/konsultasihukum/create')->withInput();
        }
        // $fileGambarkonsultasihukum = $this->request->getFile('gambar_konsultasihukum');
        // // generate nama gambarkonsultasihukum random
        // $namaGambarkonsultasihukum = $fileGambarkonsultasihukum->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarkonsultasihukum->move('img_simpan', $namaGambarkonsultasihukum);

        $slug_konsultasihukum = url_title($this->request->getVar('judul_konsultasihukum'), '-', true);
        $this->konsultasihukumModel->save([
            'judul_konsultasihukum' => $this->request->getVar('judul_konsultasihukum'),
            'isi_konsultasihukum' => $this->request->getVar('isi_konsultasihukum'),
            'tag_konsultasihukum' => $this->request->getVar('tag_konsultasihukum'),
            'slug_konsultasihukum' => $slug_konsultasihukum
            // 'gambar_konsultasihukum' => $namaGambarkonsultasihukum,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/konsultasihukum');
    }

    public function delete($id_konsultasihukum)
    {
        // cari gambar berdasarkan id
        // $konsultasihukum = $this->konsultasihukumModel->find($id_konsultasihukum);

        // cek jika file gambarnya default.png

        // if ($konsultasihukum['gambar_konsultasihukum'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $konsultasihukum['gambar_konsultasihukum']);
        // }

        $this->konsultasihukumModel->delete($id_konsultasihukum);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/konsultasihukum');
    }

    public function edit($slug_konsultasihukum)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'konsultasihukum' => $this->konsultasihukumModel->getkonsultasihukum($slug_konsultasihukum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_konsultasihukum', $data);
    }

    public function update($id_konsultasihukum)
    {
        // cek judul
        $konsultasihukumLama = $this->konsultasihukumModel->getkonsultasihukum($this->request->getVar('slug_konsultasihukum'));

        if ($konsultasihukumLama['judul_konsultasihukum'] == $this->request->getVar('judul_konsultasihukum')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_konsultasihukum.judul_konsultasihukum]';
        }
        // validasi input
        if (!$this->validate([
            'judul_konsultasihukum' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_konsultasihukum' . $this->request->getVar('slug_konsultasihukum'))->withInput();
        }

        // $filegambarkonsultasihukum = $this->request->getFile('gambar_konsultasihukum');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarkonsultasihukum->getError() == 4) {
        //     $namagambarkonsultasihukum = $this->request->getVar('gambar_konsultasihukumLama');
        // } else {
        //     // generate nama file random
        //     $namagambarkonsultasihukum = $filegambarkonsultasihukum->getRandomName();
        //     // pindahkan gambar
        //     $filegambarkonsultasihukum->move('img_simpan', $namagambarkonsultasihukum);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_konsultasihukumLama'));
        // }

        $slug_konsultasihukum = url_title($this->request->getVar('judul_konsultasihukum'), '-', true);
        $this->konsultasihukumModel->save([
            'id_konsultasihukum' => $id_konsultasihukum,
            'judul_konsultasihukum' => $this->request->getVar('judul_konsultasihukum'),
            'slug_konsultasihukum' => $slug_konsultasihukum,
            'isi_konsultasihukum' => $this->request->getVar('isi_konsultasihukum'),
            // 'gambar_konsultasihukum' => $namagambarkonsultasihukum
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/konsultasihukum');
    }
}

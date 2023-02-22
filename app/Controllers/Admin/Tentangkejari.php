<?php

namespace App\Controllers\Admin;

use App\Models\tentangkejariModel;

class tentangkejari extends BaseController
{
    protected $tentangkejariModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_tentangkejari');
        $this->tentangkejariModel  = new tentangkejariModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'tentangkejari' =>  $this->tentangkejariModel->gettentangkejari()
        ];

        return view('pages/admin/laman/tentangkejari', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah tentangkejari Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_tentangkejari', $data);
    }

    public function detail($slug_tentangkejari)
    {
        $data = [
            'title' => 'Detail tentangkejari | Admin Kelurahan Sapugarut',
            'tentangkejari' => $this->tentangkejariModel->gettentangkejari($slug_tentangkejari),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tentangkejari_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_tentangkejari' =>  [
                'rules' => 'required|is_unique[tb_tentangkejari.judul_tentangkejari]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_tentangkejari' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/tentangkejari/create')->withInput();
        }
        // $fileGambartentangkejari = $this->request->getFile('gambar_tentangkejari');
        // // generate nama gambartentangkejari random
        // $namaGambartentangkejari = $fileGambartentangkejari->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambartentangkejari->move('img_simpan', $namaGambartentangkejari);

        $slug_tentangkejari = url_title($this->request->getVar('judul_tentangkejari'), '-', true);
        $this->tentangkejariModel->save([
            'judul_tentangkejari' => $this->request->getVar('judul_tentangkejari'),
            'isi_tentangkejari' => $this->request->getVar('isi_tentangkejari'),
            'tag_tentangkejari' => $this->request->getVar('tag_tentangkejari'),
            'slug_tentangkejari' => $slug_tentangkejari
            // 'gambar_tentangkejari' => $namaGambartentangkejari,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/tentangkejari');
    }

    public function delete($id_tentangkejari)
    {
        // cari gambar berdasarkan id
        // $tentangkejari = $this->tentangkejariModel->find($id_tentangkejari);

        // cek jika file gambarnya default.png

        // if ($tentangkejari['gambar_tentangkejari'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $tentangkejari['gambar_tentangkejari']);
        // }

        $this->tentangkejariModel->delete($id_tentangkejari);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/tentangkejari');
    }

    public function edit($slug_tentangkejari)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'tentangkejari' => $this->tentangkejariModel->gettentangkejari($slug_tentangkejari),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_tentangkejari', $data);
    }

    public function update($id_tentangkejari)
    {
        // cek judul
        $tentangkejariLama = $this->tentangkejariModel->gettentangkejari($this->request->getVar('slug_tentangkejari'));

        if ($tentangkejariLama['judul_tentangkejari'] == $this->request->getVar('judul_tentangkejari')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_tentangkejari.judul_tentangkejari]';
        }
        // validasi input
        if (!$this->validate([
            'judul_tentangkejari' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_tentangkejari' . $this->request->getVar('slug_tentangkejari'))->withInput();
        }

        // $filegambartentangkejari = $this->request->getFile('gambar_tentangkejari');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambartentangkejari->getError() == 4) {
        //     $namagambartentangkejari = $this->request->getVar('gambar_tentangkejariLama');
        // } else {
        //     // generate nama file random
        //     $namagambartentangkejari = $filegambartentangkejari->getRandomName();
        //     // pindahkan gambar
        //     $filegambartentangkejari->move('img_simpan', $namagambartentangkejari);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_tentangkejariLama'));
        // }

        $slug_tentangkejari = url_title($this->request->getVar('judul_tentangkejari'), '-', true);
        $this->tentangkejariModel->save([
            'id_tentangkejari' => $id_tentangkejari,
            'judul_tentangkejari' => $this->request->getVar('judul_tentangkejari'),
            'slug_tentangkejari' => $slug_tentangkejari,
            'isi_tentangkejari' => $this->request->getVar('isi_tentangkejari'),
            // 'gambar_tentangkejari' => $namagambartentangkejari
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/tentangkejari');
    }
}

<?php

namespace App\Controllers\Admin;

use App\Models\strukturorganisasiModel;

class strukturorganisasi extends BaseController
{
    protected $strukturorganisasiModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_strukturorganisasi');
        $this->strukturorganisasiModel  = new strukturorganisasiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'strukturorganisasi' =>  $this->strukturorganisasiModel->getstrukturorganisasi()
        ];

        return view('pages/admin/laman/strukturorganisasi', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah strukturorganisasi Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_strukturorganisasi', $data);
    }

    public function detail($slug_strukturorganisasi)
    {
        $data = [
            'title' => 'Detail strukturorganisasi | Admin Kelurahan Sapugarut',
            'strukturorganisasi' => $this->strukturorganisasiModel->getstrukturorganisasi($slug_strukturorganisasi),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/strukturorganisasi_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_strukturorganisasi' =>  [
                'rules' => 'required|is_unique[tb_strukturorganisasi.judul_strukturorganisasi]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_strukturorganisasi' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/strukturorganisasi/create')->withInput();
        }
        // $fileGambarstrukturorganisasi = $this->request->getFile('gambar_strukturorganisasi');
        // // generate nama gambarstrukturorganisasi random
        // $namaGambarstrukturorganisasi = $fileGambarstrukturorganisasi->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarstrukturorganisasi->move('img_simpan', $namaGambarstrukturorganisasi);

        $slug_strukturorganisasi = url_title($this->request->getVar('judul_strukturorganisasi'), '-', true);
        $this->strukturorganisasiModel->save([
            'judul_strukturorganisasi' => $this->request->getVar('judul_strukturorganisasi'),
            'isi_strukturorganisasi' => $this->request->getVar('isi_strukturorganisasi'),
            'tag_strukturorganisasi' => $this->request->getVar('tag_strukturorganisasi'),
            'slug_strukturorganisasi' => $slug_strukturorganisasi
            // 'gambar_strukturorganisasi' => $namaGambarstrukturorganisasi,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/strukturorganisasi');
    }

    public function delete($id_strukturorganisasi)
    {
        // cari gambar berdasarkan id
        // $strukturorganisasi = $this->strukturorganisasiModel->find($id_strukturorganisasi);

        // cek jika file gambarnya default.png

        // if ($strukturorganisasi['gambar_strukturorganisasi'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $strukturorganisasi['gambar_strukturorganisasi']);
        // }

        $this->strukturorganisasiModel->delete($id_strukturorganisasi);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/strukturorganisasi');
    }

    public function edit($slug_strukturorganisasi)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'strukturorganisasi' => $this->strukturorganisasiModel->getstrukturorganisasi($slug_strukturorganisasi),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_strukturorganisasi', $data);
    }

    public function update($id_strukturorganisasi)
    {
        // cek judul
        $strukturorganisasiLama = $this->strukturorganisasiModel->getstrukturorganisasi($this->request->getVar('slug_strukturorganisasi'));

        if ($strukturorganisasiLama['judul_strukturorganisasi'] == $this->request->getVar('judul_strukturorganisasi')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_strukturorganisasi.judul_strukturorganisasi]';
        }
        // validasi input
        if (!$this->validate([
            'judul_strukturorganisasi' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_strukturorganisasi' . $this->request->getVar('slug_strukturorganisasi'))->withInput();
        }

        // $filegambarstrukturorganisasi = $this->request->getFile('gambar_strukturorganisasi');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarstrukturorganisasi->getError() == 4) {
        //     $namagambarstrukturorganisasi = $this->request->getVar('gambar_strukturorganisasiLama');
        // } else {
        //     // generate nama file random
        //     $namagambarstrukturorganisasi = $filegambarstrukturorganisasi->getRandomName();
        //     // pindahkan gambar
        //     $filegambarstrukturorganisasi->move('img_simpan', $namagambarstrukturorganisasi);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_strukturorganisasiLama'));
        // }

        $slug_strukturorganisasi = url_title($this->request->getVar('judul_strukturorganisasi'), '-', true);
        $this->strukturorganisasiModel->save([
            'id_strukturorganisasi' => $id_strukturorganisasi,
            'judul_strukturorganisasi' => $this->request->getVar('judul_strukturorganisasi'),
            'slug_strukturorganisasi' => $slug_strukturorganisasi,
            'isi_strukturorganisasi' => $this->request->getVar('isi_strukturorganisasi'),
            // 'gambar_strukturorganisasi' => $namagambarstrukturorganisasi
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/strukturorganisasi');
    }
}

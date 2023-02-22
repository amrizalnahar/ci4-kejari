<?php

namespace App\Controllers\Admin;

use App\Models\visidanmisiModel;

class visidanmisi extends BaseController
{
    protected $visidanmisiModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_visidanmisi');
        $this->visidanmisiModel  = new visidanmisiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'visidanmisi' =>  $this->visidanmisiModel->getvisidanmisi()
        ];

        return view('pages/admin/laman/visidanmisi', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah visidanmisi Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_visidanmisi', $data);
    }

    public function detail($slug_visidanmisi)
    {
        $data = [
            'title' => 'Detail visidanmisi | Admin Kelurahan Sapugarut',
            'visidanmisi' => $this->visidanmisiModel->getvisidanmisi($slug_visidanmisi),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/visidanmisi_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_visidanmisi' =>  [
                'rules' => 'required|is_unique[tb_visidanmisi.judul_visidanmisi]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_visidanmisi' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/visidanmisi/create')->withInput();
        }
        // $fileGambarvisidanmisi = $this->request->getFile('gambar_visidanmisi');
        // // generate nama gambarvisidanmisi random
        // $namaGambarvisidanmisi = $fileGambarvisidanmisi->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarvisidanmisi->move('img_simpan', $namaGambarvisidanmisi);

        $slug_visidanmisi = url_title($this->request->getVar('judul_visidanmisi'), '-', true);
        $this->visidanmisiModel->save([
            'judul_visidanmisi' => $this->request->getVar('judul_visidanmisi'),
            'isi_visidanmisi' => $this->request->getVar('isi_visidanmisi'),
            'tag_visidanmisi' => $this->request->getVar('tag_visidanmisi'),
            'slug_visidanmisi' => $slug_visidanmisi
            // 'gambar_visidanmisi' => $namaGambarvisidanmisi,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/visidanmisi');
    }

    public function delete($id_visidanmisi)
    {
        // cari gambar berdasarkan id
        // $visidanmisi = $this->visidanmisiModel->find($id_visidanmisi);

        // cek jika file gambarnya default.png

        // if ($visidanmisi['gambar_visidanmisi'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $visidanmisi['gambar_visidanmisi']);
        // }

        $this->visidanmisiModel->delete($id_visidanmisi);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/visidanmisi');
    }

    public function edit($slug_visidanmisi)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'visidanmisi' => $this->visidanmisiModel->getvisidanmisi($slug_visidanmisi),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_visidanmisi', $data);
    }

    public function update($id_visidanmisi)
    {
        // cek judul
        $visidanmisiLama = $this->visidanmisiModel->getvisidanmisi($this->request->getVar('slug_visidanmisi'));

        if ($visidanmisiLama['judul_visidanmisi'] == $this->request->getVar('judul_visidanmisi')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_visidanmisi.judul_visidanmisi]';
        }
        // validasi input
        if (!$this->validate([
            'judul_visidanmisi' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_visidanmisi' . $this->request->getVar('slug_visidanmisi'))->withInput();
        }

        // $filegambarvisidanmisi = $this->request->getFile('gambar_visidanmisi');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarvisidanmisi->getError() == 4) {
        //     $namagambarvisidanmisi = $this->request->getVar('gambar_visidanmisiLama');
        // } else {
        //     // generate nama file random
        //     $namagambarvisidanmisi = $filegambarvisidanmisi->getRandomName();
        //     // pindahkan gambar
        //     $filegambarvisidanmisi->move('img_simpan', $namagambarvisidanmisi);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_visidanmisiLama'));
        // }

        $slug_visidanmisi = url_title($this->request->getVar('judul_visidanmisi'), '-', true);
        $this->visidanmisiModel->save([
            'id_visidanmisi' => $id_visidanmisi,
            'judul_visidanmisi' => $this->request->getVar('judul_visidanmisi'),
            'slug_visidanmisi' => $slug_visidanmisi,
            'isi_visidanmisi' => $this->request->getVar('isi_visidanmisi'),
            // 'gambar_visidanmisi' => $namagambarvisidanmisi
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/visidanmisi');
    }
}

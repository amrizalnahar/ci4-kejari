<?php

namespace App\Controllers\Admin;

use App\Models\kontakModel;

class kontak extends BaseController
{
    protected $kontakModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_kontak');
        $this->kontakModel  = new kontakModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'kontak' =>  $this->kontakModel->getkontak()
        ];

        return view('pages/admin/laman/kontak', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah kontak Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_kontak', $data);
    }

    public function detail($slug_kontak)
    {
        $data = [
            'title' => 'Detail kontak | Admin Kelurahan Sapugarut',
            'kontak' => $this->kontakModel->getkontak($slug_kontak),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/kontak_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_kontak' =>  [
                'rules' => 'required|is_unique[tb_kontak.judul_kontak]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_kontak' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/kontak/create')->withInput();
        }
        // $fileGambarkontak = $this->request->getFile('gambar_kontak');
        // // generate nama gambarkontak random
        // $namaGambarkontak = $fileGambarkontak->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarkontak->move('img_simpan', $namaGambarkontak);

        $slug_kontak = url_title($this->request->getVar('judul_kontak'), '-', true);
        $this->kontakModel->save([
            'judul_kontak' => $this->request->getVar('judul_kontak'),
            'isi_kontak' => $this->request->getVar('isi_kontak'),
            'tag_kontak' => $this->request->getVar('tag_kontak'),
            'slug_kontak' => $slug_kontak
            // 'gambar_kontak' => $namaGambarkontak,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/kontak');
    }

    public function delete($id_kontak)
    {
        // cari gambar berdasarkan id
        // $kontak = $this->kontakModel->find($id_kontak);

        // cek jika file gambarnya default.png

        // if ($kontak['gambar_kontak'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $kontak['gambar_kontak']);
        // }

        $this->kontakModel->delete($id_kontak);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/kontak');
    }

    public function edit($slug_kontak)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'kontak' => $this->kontakModel->getkontak($slug_kontak),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_kontak', $data);
    }

    public function update($id_kontak)
    {
        // cek judul
        $kontakLama = $this->kontakModel->getkontak($this->request->getVar('slug_kontak'));

        if ($kontakLama['judul_kontak'] == $this->request->getVar('judul_kontak')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_kontak.judul_kontak]';
        }
        // validasi input
        if (!$this->validate([
            'judul_kontak' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_kontak' . $this->request->getVar('slug_kontak'))->withInput();
        }

        // $filegambarkontak = $this->request->getFile('gambar_kontak');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarkontak->getError() == 4) {
        //     $namagambarkontak = $this->request->getVar('gambar_kontakLama');
        // } else {
        //     // generate nama file random
        //     $namagambarkontak = $filegambarkontak->getRandomName();
        //     // pindahkan gambar
        //     $filegambarkontak->move('img_simpan', $namagambarkontak);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_kontakLama'));
        // }

        $slug_kontak = url_title($this->request->getVar('judul_kontak'), '-', true);
        $this->kontakModel->save([
            'id_kontak' => $id_kontak,
            'judul_kontak' => $this->request->getVar('judul_kontak'),
            'slug_kontak' => $slug_kontak,
            'isi_kontak' => $this->request->getVar('isi_kontak'),
            // 'gambar_kontak' => $namagambarkontak
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/kontak');
    }
}

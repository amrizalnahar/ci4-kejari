<?php

namespace App\Controllers\Admin;

use App\Models\perintahharianModel;

class perintahharian extends BaseController
{
    protected $perintahharianModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_perintahharian');
        $this->perintahharianModel  = new perintahharianModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'perintahharian' =>  $this->perintahharianModel->getperintahharian()
        ];

        return view('pages/admin/laman/perintahharian', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah perintahharian Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_perintahharian', $data);
    }

    public function detail($slug_perintahharian)
    {
        $data = [
            'title' => 'Detail perintahharian | Admin Kelurahan Sapugarut',
            'perintahharian' => $this->perintahharianModel->getperintahharian($slug_perintahharian),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/perintahharian_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_perintahharian' =>  [
                'rules' => 'required|is_unique[tb_perintahharian.judul_perintahharian]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_perintahharian' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/perintahharian/create')->withInput();
        }
        // $fileGambarperintahharian = $this->request->getFile('gambar_perintahharian');
        // // generate nama gambarperintahharian random
        // $namaGambarperintahharian = $fileGambarperintahharian->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarperintahharian->move('img_simpan', $namaGambarperintahharian);

        $slug_perintahharian = url_title($this->request->getVar('judul_perintahharian'), '-', true);
        $this->perintahharianModel->save([
            'judul_perintahharian' => $this->request->getVar('judul_perintahharian'),
            'isi_perintahharian' => $this->request->getVar('isi_perintahharian'),
            'tag_perintahharian' => $this->request->getVar('tag_perintahharian'),
            'slug_perintahharian' => $slug_perintahharian
            // 'gambar_perintahharian' => $namaGambarperintahharian,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/perintahharian');
    }

    public function delete($id_perintahharian)
    {
        // cari gambar berdasarkan id
        // $perintahharian = $this->perintahharianModel->find($id_perintahharian);

        // cek jika file gambarnya default.png

        // if ($perintahharian['gambar_perintahharian'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $perintahharian['gambar_perintahharian']);
        // }

        $this->perintahharianModel->delete($id_perintahharian);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/perintahharian');
    }

    public function edit($slug_perintahharian)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'perintahharian' => $this->perintahharianModel->getperintahharian($slug_perintahharian),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_perintahharian', $data);
    }

    public function update($id_perintahharian)
    {
        // cek judul
        $perintahharianLama = $this->perintahharianModel->getperintahharian($this->request->getVar('slug_perintahharian'));

        if ($perintahharianLama['judul_perintahharian'] == $this->request->getVar('judul_perintahharian')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_perintahharian.judul_perintahharian]';
        }
        // validasi input
        if (!$this->validate([
            'judul_perintahharian' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_perintahharian' . $this->request->getVar('slug_perintahharian'))->withInput();
        }

        // $filegambarperintahharian = $this->request->getFile('gambar_perintahharian');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarperintahharian->getError() == 4) {
        //     $namagambarperintahharian = $this->request->getVar('gambar_perintahharianLama');
        // } else {
        //     // generate nama file random
        //     $namagambarperintahharian = $filegambarperintahharian->getRandomName();
        //     // pindahkan gambar
        //     $filegambarperintahharian->move('img_simpan', $namagambarperintahharian);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_perintahharianLama'));
        // }

        $slug_perintahharian = url_title($this->request->getVar('judul_perintahharian'), '-', true);
        $this->perintahharianModel->save([
            'id_perintahharian' => $id_perintahharian,
            'judul_perintahharian' => $this->request->getVar('judul_perintahharian'),
            'slug_perintahharian' => $slug_perintahharian,
            'isi_perintahharian' => $this->request->getVar('isi_perintahharian'),
            // 'gambar_perintahharian' => $namagambarperintahharian
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/perintahharian');
    }
}

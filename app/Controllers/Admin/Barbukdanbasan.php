<?php

namespace App\Controllers\Admin;

use App\Models\barbukdanbasanModel;

class Barbukdanbasan extends BaseController
{
    protected $barbukdanbasanModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_barbukdanbasan');
        $this->barbukdanbasanModel  = new barbukdanbasanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Barbuk dan Basan | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'barbukdanbasan' =>  $this->barbukdanbasanModel->getbarbukdanbasan()
        ];

        return view('pages/admin/laman/barbukdanbasan', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Barbuk dan Basan Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_barbukdanbasan', $data);
    }

    public function detail($slug_barbukdanbasan)
    {
        $data = [
            'title' => 'Detail barbukdanbasan | Admin Kelurahan Sapugarut',
            'barbukdanbasan' => $this->barbukdanbasanModel->getbarbukdanbasan($slug_barbukdanbasan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/barbukdanbasan_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_barbukdanbasan' =>  [
                'rules' => 'required|is_unique[tb_barbukdanbasan.judul_barbukdanbasan]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_barbukdanbasan' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/barbukdanbasan/create')->withInput();
        }
        // $fileGambarbarbukdanbasan = $this->request->getFile('gambar_barbukdanbasan');
        // // generate nama gambarbarbukdanbasan random
        // $namaGambarbarbukdanbasan = $fileGambarbarbukdanbasan->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarbarbukdanbasan->move('img_simpan', $namaGambarbarbukdanbasan);

        $slug_barbukdanbasan = url_title($this->request->getVar('judul_barbukdanbasan'), '-', true);
        $this->barbukdanbasanModel->save([
            'judul_barbukdanbasan' => $this->request->getVar('judul_barbukdanbasan'),
            'isi_barbukdanbasan' => $this->request->getVar('isi_barbukdanbasan'),
            'slug_barbukdanbasan' => $slug_barbukdanbasan
            // 'gambar_barbukdanbasan' => $namaGambarbarbukdanbasan,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/barbukdanbasan');
    }

    public function delete($id_barbukdanbasan)
    {
        // cari gambar berdasarkan id
        // $barbukdanbasan = $this->barbukdanbasanModel->find($id_barbukdanbasan);

        // cek jika file gambarnya default.png

        // if ($barbukdanbasan['gambar_barbukdanbasan'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $barbukdanbasan['gambar_barbukdanbasan']);
        // }

        $this->barbukdanbasanModel->delete($id_barbukdanbasan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/barbukdanbasan');
    }

    public function edit($slug_barbukdanbasan)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'barbukdanbasan' => $this->barbukdanbasanModel->getbarbukdanbasan($slug_barbukdanbasan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_barbukdanbasan', $data);
    }

    public function update($id_barbukdanbasan)
    {
        // cek judul
        $barbukdanbasanLama = $this->barbukdanbasanModel->getbarbukdanbasan($this->request->getVar('slug_barbukdanbasan'));

        if ($barbukdanbasanLama['judul_barbukdanbasan'] == $this->request->getVar('judul_barbukdanbasan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_barbukdanbasan.judul_barbukdanbasan]';
        }
        // validasi input
        if (!$this->validate([
            'judul_barbukdanbasan' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_barbukdanbasan' . $this->request->getVar('slug_barbukdanbasan'))->withInput();
        }

        // $filegambarbarbukdanbasan = $this->request->getFile('gambar_barbukdanbasan');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarbarbukdanbasan->getError() == 4) {
        //     $namagambarbarbukdanbasan = $this->request->getVar('gambar_barbukdanbasanLama');
        // } else {
        //     // generate nama file random
        //     $namagambarbarbukdanbasan = $filegambarbarbukdanbasan->getRandomName();
        //     // pindahkan gambar
        //     $filegambarbarbukdanbasan->move('img_simpan', $namagambarbarbukdanbasan);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_barbukdanbasanLama'));
        // }

        $slug_barbukdanbasan = url_title($this->request->getVar('judul_barbukdanbasan'), '-', true);
        $this->barbukdanbasanModel->save([
            'id_barbukdanbasan' => $id_barbukdanbasan,
            'judul_barbukdanbasan' => $this->request->getVar('judul_barbukdanbasan'),
            'slug_barbukdanbasan' => $slug_barbukdanbasan,
            'isi_barbukdanbasan' => $this->request->getVar('isi_barbukdanbasan'),
            // 'gambar_barbukdanbasan' => $namagambarbarbukdanbasan
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/barbukdanbasan');
    }
}

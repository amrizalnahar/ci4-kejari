<?php

namespace App\Controllers\Admin;

use App\Models\pidanaumumModel;

class pidanaumum extends BaseController
{
    protected $pidanaumumModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pidanaumum');
        $this->pidanaumumModel  = new pidanaumumModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pidanaumum' =>  $this->pidanaumumModel->getpidanaumum()
        ];

        return view('pages/admin/laman/pidanaumum', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pidanaumum Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pidanaumum', $data);
    }

    public function detail($slug_pidanaumum)
    {
        $data = [
            'title' => 'Detail pidanaumum | Admin Kelurahan Sapugarut',
            'pidanaumum' => $this->pidanaumumModel->getpidanaumum($slug_pidanaumum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pidanaumum_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pidanaumum' =>  [
                'rules' => 'required|is_unique[tb_pidanaumum.judul_pidanaumum]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pidanaumum' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pidanaumum/create')->withInput();
        }
        // $fileGambarpidanaumum = $this->request->getFile('gambar_pidanaumum');
        // // generate nama gambarpidanaumum random
        // $namaGambarpidanaumum = $fileGambarpidanaumum->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpidanaumum->move('img_simpan', $namaGambarpidanaumum);

        $slug_pidanaumum = url_title($this->request->getVar('judul_pidanaumum'), '-', true);
        $this->pidanaumumModel->save([
            'judul_pidanaumum' => $this->request->getVar('judul_pidanaumum'),
            'isi_pidanaumum' => $this->request->getVar('isi_pidanaumum'),
            'tag_pidanaumum' => $this->request->getVar('tag_pidanaumum'),
            'slug_pidanaumum' => $slug_pidanaumum
            // 'gambar_pidanaumum' => $namaGambarpidanaumum,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pidanaumum');
    }

    public function delete($id_pidanaumum)
    {
        // cari gambar berdasarkan id
        // $pidanaumum = $this->pidanaumumModel->find($id_pidanaumum);

        // cek jika file gambarnya default.png

        // if ($pidanaumum['gambar_pidanaumum'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pidanaumum['gambar_pidanaumum']);
        // }

        $this->pidanaumumModel->delete($id_pidanaumum);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pidanaumum');
    }

    public function edit($slug_pidanaumum)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pidanaumum' => $this->pidanaumumModel->getpidanaumum($slug_pidanaumum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pidanaumum', $data);
    }

    public function update($id_pidanaumum)
    {
        // cek judul
        $pidanaumumLama = $this->pidanaumumModel->getpidanaumum($this->request->getVar('slug_pidanaumum'));

        if ($pidanaumumLama['judul_pidanaumum'] == $this->request->getVar('judul_pidanaumum')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pidanaumum.judul_pidanaumum]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pidanaumum' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pidanaumum' . $this->request->getVar('slug_pidanaumum'))->withInput();
        }

        // $filegambarpidanaumum = $this->request->getFile('gambar_pidanaumum');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpidanaumum->getError() == 4) {
        //     $namagambarpidanaumum = $this->request->getVar('gambar_pidanaumumLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpidanaumum = $filegambarpidanaumum->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpidanaumum->move('img_simpan', $namagambarpidanaumum);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pidanaumumLama'));
        // }

        $slug_pidanaumum = url_title($this->request->getVar('judul_pidanaumum'), '-', true);
        $this->pidanaumumModel->save([
            'id_pidanaumum' => $id_pidanaumum,
            'judul_pidanaumum' => $this->request->getVar('judul_pidanaumum'),
            'slug_pidanaumum' => $slug_pidanaumum,
            'isi_pidanaumum' => $this->request->getVar('isi_pidanaumum'),
            // 'gambar_pidanaumum' => $namagambarpidanaumum
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pidanaumum');
    }
}

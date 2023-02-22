<?php

namespace App\Controllers\Admin;

use App\Models\katasambutanModel;

class katasambutan extends BaseController
{
    protected $katasambutanModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_katasambutan');
        $this->katasambutanModel  = new katasambutanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'katasambutan' =>  $this->katasambutanModel->getkatasambutan()
        ];

        return view('pages/admin/laman/katasambutan', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah katasambutan Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_katasambutan', $data);
    }

    public function detail($slug_katasambutan)
    {
        $data = [
            'title' => 'Detail katasambutan | Admin Kelurahan Sapugarut',
            'katasambutan' => $this->katasambutanModel->getkatasambutan($slug_katasambutan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/katasambutan_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_katasambutan' =>  [
                'rules' => 'required|is_unique[tb_katasambutan.judul_katasambutan]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_katasambutan' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/katasambutan/create')->withInput();
        }
        // $fileGambarkatasambutan = $this->request->getFile('gambar_katasambutan');
        // // generate nama gambarkatasambutan random
        // $namaGambarkatasambutan = $fileGambarkatasambutan->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarkatasambutan->move('img_simpan', $namaGambarkatasambutan);

        $slug_katasambutan = url_title($this->request->getVar('judul_katasambutan'), '-', true);
        $this->katasambutanModel->save([
            'judul_katasambutan' => $this->request->getVar('judul_katasambutan'),
            'isi_katasambutan' => $this->request->getVar('isi_katasambutan'),
            'tag_katasambutan' => $this->request->getVar('tag_katasambutan'),
            'slug_katasambutan' => $slug_katasambutan
            // 'gambar_katasambutan' => $namaGambarkatasambutan,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/katasambutan');
    }

    public function delete($id_katasambutan)
    {
        // cari gambar berdasarkan id
        // $katasambutan = $this->katasambutanModel->find($id_katasambutan);

        // cek jika file gambarnya default.png

        // if ($katasambutan['gambar_katasambutan'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $katasambutan['gambar_katasambutan']);
        // }

        $this->katasambutanModel->delete($id_katasambutan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/katasambutan');
    }

    public function edit($slug_katasambutan)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'katasambutan' => $this->katasambutanModel->getkatasambutan($slug_katasambutan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_katasambutan', $data);
    }

    public function update($id_katasambutan)
    {
        // cek judul
        $katasambutanLama = $this->katasambutanModel->getkatasambutan($this->request->getVar('slug_katasambutan'));

        if ($katasambutanLama['judul_katasambutan'] == $this->request->getVar('judul_katasambutan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_katasambutan.judul_katasambutan]';
        }
        // validasi input
        if (!$this->validate([
            'judul_katasambutan' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_katasambutan' . $this->request->getVar('slug_katasambutan'))->withInput();
        }

        // $filegambarkatasambutan = $this->request->getFile('gambar_katasambutan');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarkatasambutan->getError() == 4) {
        //     $namagambarkatasambutan = $this->request->getVar('gambar_katasambutanLama');
        // } else {
        //     // generate nama file random
        //     $namagambarkatasambutan = $filegambarkatasambutan->getRandomName();
        //     // pindahkan gambar
        //     $filegambarkatasambutan->move('img_simpan', $namagambarkatasambutan);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_katasambutanLama'));
        // }

        $slug_katasambutan = url_title($this->request->getVar('judul_katasambutan'), '-', true);
        $this->katasambutanModel->save([
            'id_katasambutan' => $id_katasambutan,
            'judul_katasambutan' => $this->request->getVar('judul_katasambutan'),
            'slug_katasambutan' => $slug_katasambutan,
            'isi_katasambutan' => $this->request->getVar('isi_katasambutan'),
            // 'gambar_katasambutan' => $namagambarkatasambutan
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/katasambutan');
    }
}

<?php

namespace App\Controllers\Admin;

use App\Models\peraturanModel;

class peraturan extends BaseController
{
    protected $peraturanModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_peraturan');
        $this->peraturanModel  = new peraturanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'peraturan' =>  $this->peraturanModel->getperaturan()
        ];

        return view('pages/admin/laman/peraturan', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah peraturan Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_peraturan', $data);
    }

    public function detail($slug_peraturan)
    {
        $data = [
            'title' => 'Detail peraturan | Admin Kelurahan Sapugarut',
            'peraturan' => $this->peraturanModel->getperaturan($slug_peraturan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/peraturan_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_peraturan' =>  [
                'rules' => 'required|is_unique[tb_peraturan.judul_peraturan]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_peraturan' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/peraturan/create')->withInput();
        }
        // $fileGambarperaturan = $this->request->getFile('gambar_peraturan');
        // // generate nama gambarperaturan random
        // $namaGambarperaturan = $fileGambarperaturan->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarperaturan->move('img_simpan', $namaGambarperaturan);

        $slug_peraturan = url_title($this->request->getVar('judul_peraturan'), '-', true);
        $this->peraturanModel->save([
            'judul_peraturan' => $this->request->getVar('judul_peraturan'),
            'isi_peraturan' => $this->request->getVar('isi_peraturan'),
            'tag_peraturan' => $this->request->getVar('tag_peraturan'),
            'slug_peraturan' => $slug_peraturan
            // 'gambar_peraturan' => $namaGambarperaturan,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/peraturan');
    }

    public function delete($id_peraturan)
    {
        // cari gambar berdasarkan id
        // $peraturan = $this->peraturanModel->find($id_peraturan);

        // cek jika file gambarnya default.png

        // if ($peraturan['gambar_peraturan'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $peraturan['gambar_peraturan']);
        // }

        $this->peraturanModel->delete($id_peraturan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/peraturan');
    }

    public function edit($slug_peraturan)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'peraturan' => $this->peraturanModel->getperaturan($slug_peraturan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_peraturan', $data);
    }

    public function update($id_peraturan)
    {
        // cek judul
        $peraturanLama = $this->peraturanModel->getperaturan($this->request->getVar('slug_peraturan'));

        if ($peraturanLama['judul_peraturan'] == $this->request->getVar('judul_peraturan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_peraturan.judul_peraturan]';
        }
        // validasi input
        if (!$this->validate([
            'judul_peraturan' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_peraturan' . $this->request->getVar('slug_peraturan'))->withInput();
        }

        // $filegambarperaturan = $this->request->getFile('gambar_peraturan');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarperaturan->getError() == 4) {
        //     $namagambarperaturan = $this->request->getVar('gambar_peraturanLama');
        // } else {
        //     // generate nama file random
        //     $namagambarperaturan = $filegambarperaturan->getRandomName();
        //     // pindahkan gambar
        //     $filegambarperaturan->move('img_simpan', $namagambarperaturan);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_peraturanLama'));
        // }

        $slug_peraturan = url_title($this->request->getVar('judul_peraturan'), '-', true);
        $this->peraturanModel->save([
            'id_peraturan' => $id_peraturan,
            'judul_peraturan' => $this->request->getVar('judul_peraturan'),
            'slug_peraturan' => $slug_peraturan,
            'isi_peraturan' => $this->request->getVar('isi_peraturan'),
            // 'gambar_peraturan' => $namagambarperaturan
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/peraturan');
    }
}

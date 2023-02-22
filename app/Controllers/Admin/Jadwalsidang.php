<?php

namespace App\Controllers\Admin;

use App\Models\jadwalsidangModel;

class jadwalsidang extends BaseController
{
    protected $jadwalsidangModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_jadwalsidang');
        $this->jadwalsidangModel  = new jadwalsidangModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'jadwalsidang' =>  $this->jadwalsidangModel->getjadwalsidang()
        ];

        return view('pages/admin/laman/jadwalsidang', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah jadwalsidang Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_jadwalsidang', $data);
    }

    public function detail($slug_jadwalsidang)
    {
        $data = [
            'title' => 'Detail jadwalsidang | Admin Kelurahan Sapugarut',
            'jadwalsidang' => $this->jadwalsidangModel->getjadwalsidang($slug_jadwalsidang),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/jadwalsidang_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_jadwalsidang' =>  [
                'rules' => 'required|is_unique[tb_jadwalsidang.judul_jadwalsidang]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_jadwalsidang' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/jadwalsidang/create')->withInput();
        }
        // $fileGambarjadwalsidang = $this->request->getFile('gambar_jadwalsidang');
        // // generate nama gambarjadwalsidang random
        // $namaGambarjadwalsidang = $fileGambarjadwalsidang->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarjadwalsidang->move('img_simpan', $namaGambarjadwalsidang);

        $slug_jadwalsidang = url_title($this->request->getVar('judul_jadwalsidang'), '-', true);
        $this->jadwalsidangModel->save([
            'judul_jadwalsidang' => $this->request->getVar('judul_jadwalsidang'),
            'isi_jadwalsidang' => $this->request->getVar('isi_jadwalsidang'),
            'tag_jadwalsidang' => $this->request->getVar('tag_jadwalsidang'),
            'slug_jadwalsidang' => $slug_jadwalsidang
            // 'gambar_jadwalsidang' => $namaGambarjadwalsidang,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/jadwalsidang');
    }

    public function delete($id_jadwalsidang)
    {
        // cari gambar berdasarkan id
        // $jadwalsidang = $this->jadwalsidangModel->find($id_jadwalsidang);

        // cek jika file gambarnya default.png

        // if ($jadwalsidang['gambar_jadwalsidang'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $jadwalsidang['gambar_jadwalsidang']);
        // }

        $this->jadwalsidangModel->delete($id_jadwalsidang);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/jadwalsidang');
    }

    public function edit($slug_jadwalsidang)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'jadwalsidang' => $this->jadwalsidangModel->getjadwalsidang($slug_jadwalsidang),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_jadwalsidang', $data);
    }

    public function update($id_jadwalsidang)
    {
        // cek judul
        $jadwalsidangLama = $this->jadwalsidangModel->getjadwalsidang($this->request->getVar('slug_jadwalsidang'));

        if ($jadwalsidangLama['judul_jadwalsidang'] == $this->request->getVar('judul_jadwalsidang')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_jadwalsidang.judul_jadwalsidang]';
        }
        // validasi input
        if (!$this->validate([
            'judul_jadwalsidang' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_jadwalsidang' . $this->request->getVar('slug_jadwalsidang'))->withInput();
        }

        // $filegambarjadwalsidang = $this->request->getFile('gambar_jadwalsidang');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarjadwalsidang->getError() == 4) {
        //     $namagambarjadwalsidang = $this->request->getVar('gambar_jadwalsidangLama');
        // } else {
        //     // generate nama file random
        //     $namagambarjadwalsidang = $filegambarjadwalsidang->getRandomName();
        //     // pindahkan gambar
        //     $filegambarjadwalsidang->move('img_simpan', $namagambarjadwalsidang);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_jadwalsidangLama'));
        // }

        $slug_jadwalsidang = url_title($this->request->getVar('judul_jadwalsidang'), '-', true);
        $this->jadwalsidangModel->save([
            'id_jadwalsidang' => $id_jadwalsidang,
            'judul_jadwalsidang' => $this->request->getVar('judul_jadwalsidang'),
            'slug_jadwalsidang' => $slug_jadwalsidang,
            'isi_jadwalsidang' => $this->request->getVar('isi_jadwalsidang'),
            // 'gambar_jadwalsidang' => $namagambarjadwalsidang
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/jadwalsidang');
    }
}

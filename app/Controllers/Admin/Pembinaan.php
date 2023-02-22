<?php

namespace App\Controllers\Admin;

use App\Models\pembinaanModel;

class pembinaan extends BaseController
{
    protected $pembinaanModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pembinaan');
        $this->pembinaanModel  = new pembinaanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pembinaan' =>  $this->pembinaanModel->getpembinaan()
        ];

        return view('pages/admin/laman/pembinaan', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pembinaan Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pembinaan', $data);
    }

    public function detail($slug_pembinaan)
    {
        $data = [
            'title' => 'Detail pembinaan | Admin Kelurahan Sapugarut',
            'pembinaan' => $this->pembinaanModel->getpembinaan($slug_pembinaan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pembinaan_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pembinaan' =>  [
                'rules' => 'required|is_unique[tb_pembinaan.judul_pembinaan]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pembinaan' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pembinaan/create')->withInput();
        }
        // $fileGambarpembinaan = $this->request->getFile('gambar_pembinaan');
        // // generate nama gambarpembinaan random
        // $namaGambarpembinaan = $fileGambarpembinaan->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpembinaan->move('img_simpan', $namaGambarpembinaan);

        $slug_pembinaan = url_title($this->request->getVar('judul_pembinaan'), '-', true);
        $this->pembinaanModel->save([
            'judul_pembinaan' => $this->request->getVar('judul_pembinaan'),
            'isi_pembinaan' => $this->request->getVar('isi_pembinaan'),
            'tag_pembinaan' => $this->request->getVar('tag_pembinaan'),
            'slug_pembinaan' => $slug_pembinaan
            // 'gambar_pembinaan' => $namaGambarpembinaan,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pembinaan');
    }

    public function delete($id_pembinaan)
    {
        // cari gambar berdasarkan id
        // $pembinaan = $this->pembinaanModel->find($id_pembinaan);

        // cek jika file gambarnya default.png

        // if ($pembinaan['gambar_pembinaan'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pembinaan['gambar_pembinaan']);
        // }

        $this->pembinaanModel->delete($id_pembinaan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pembinaan');
    }

    public function edit($slug_pembinaan)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pembinaan' => $this->pembinaanModel->getpembinaan($slug_pembinaan),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pembinaan', $data);
    }

    public function update($id_pembinaan)
    {
        // cek judul
        $pembinaanLama = $this->pembinaanModel->getpembinaan($this->request->getVar('slug_pembinaan'));

        if ($pembinaanLama['judul_pembinaan'] == $this->request->getVar('judul_pembinaan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pembinaan.judul_pembinaan]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pembinaan' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pembinaan' . $this->request->getVar('slug_pembinaan'))->withInput();
        }

        // $filegambarpembinaan = $this->request->getFile('gambar_pembinaan');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpembinaan->getError() == 4) {
        //     $namagambarpembinaan = $this->request->getVar('gambar_pembinaanLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpembinaan = $filegambarpembinaan->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpembinaan->move('img_simpan', $namagambarpembinaan);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pembinaanLama'));
        // }

        $slug_pembinaan = url_title($this->request->getVar('judul_pembinaan'), '-', true);
        $this->pembinaanModel->save([
            'id_pembinaan' => $id_pembinaan,
            'judul_pembinaan' => $this->request->getVar('judul_pembinaan'),
            'slug_pembinaan' => $slug_pembinaan,
            'isi_pembinaan' => $this->request->getVar('isi_pembinaan'),
            // 'gambar_pembinaan' => $namagambarpembinaan
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pembinaan');
    }
}

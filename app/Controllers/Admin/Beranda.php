<?php

namespace App\Controllers\Admin;

use App\Models\berandaModel;

class beranda extends BaseController
{
    protected $berandaModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_beranda');
        $this->berandaModel  = new berandaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Beranda | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'beranda' =>  $this->berandaModel->getberanda()
        ];

        return view('pages/admin/laman/beranda', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah beranda Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_beranda', $data);
    }

    public function detail($slug_beranda)
    {
        $data = [
            'title' => 'Detail beranda | Admin Kelurahan Sapugarut',
            'beranda' => $this->berandaModel->getberanda($slug_beranda),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/beranda_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_beranda' =>  [
                'rules' => 'required|is_unique[tb_beranda.judul_beranda]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_beranda' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/beranda/create')->withInput();
        }
        // $fileGambarberanda = $this->request->getFile('gambar_beranda');
        // // generate nama gambarberanda random
        // $namaGambarberanda = $fileGambarberanda->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarberanda->move('img_simpan', $namaGambarberanda);

        $slug_beranda = url_title($this->request->getVar('judul_beranda'), '-', true);
        $this->berandaModel->save([
            'judul_beranda' => $this->request->getVar('judul_beranda'),
            'isi_beranda' => $this->request->getVar('isi_beranda'),
            'tag_beranda' => $this->request->getVar('tag_beranda'),
            'slug_beranda' => $slug_beranda
            // 'gambar_beranda' => $namaGambarberanda,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/beranda');
    }

    public function delete($id_beranda)
    {
        // cari gambar berdasarkan id
        // $beranda = $this->berandaModel->find($id_beranda);

        // cek jika file gambarnya default.png

        // if ($beranda['gambar_beranda'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $beranda['gambar_beranda']);
        // }

        $this->berandaModel->delete($id_beranda);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/beranda');
    }

    public function edit($slug_beranda)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'beranda' => $this->berandaModel->getberanda($slug_beranda),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_beranda', $data);
    }

    public function update($id_beranda)
    {
        // cek judul
        $berandaLama = $this->berandaModel->getberanda($this->request->getVar('slug_beranda'));

        if ($berandaLama['judul_beranda'] == $this->request->getVar('judul_beranda')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_beranda.judul_beranda]';
        }
        // validasi input
        if (!$this->validate([
            'judul_beranda' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_beranda' . $this->request->getVar('slug_beranda'))->withInput();
        }

        // $filegambarberanda = $this->request->getFile('gambar_beranda');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarberanda->getError() == 4) {
        //     $namagambarberanda = $this->request->getVar('gambar_berandaLama');
        // } else {
        //     // generate nama file random
        //     $namagambarberanda = $filegambarberanda->getRandomName();
        //     // pindahkan gambar
        //     $filegambarberanda->move('img_simpan', $namagambarberanda);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_berandaLama'));
        // }

        $slug_beranda = url_title($this->request->getVar('judul_beranda'), '-', true);
        $this->berandaModel->save([
            'id_beranda' => $id_beranda,
            'judul_beranda' => $this->request->getVar('judul_beranda'),
            'slug_beranda' => $slug_beranda,
            'isi_beranda' => $this->request->getVar('isi_beranda'),
            // 'gambar_beranda' => $namagambarberanda
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/beranda');
    }
}

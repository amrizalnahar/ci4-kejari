<?php

namespace App\Controllers\Admin;

use App\Models\datunModel;

class datun extends BaseController
{
    protected $datunModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_datun');
        $this->datunModel  = new datunModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'datun' =>  $this->datunModel->getdatun()
        ];

        return view('pages/admin/laman/datun', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah datun Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_datun', $data);
    }

    public function detail($slug_datun)
    {
        $data = [
            'title' => 'Detail datun | Admin Kelurahan Sapugarut',
            'datun' => $this->datunModel->getdatun($slug_datun),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/datun_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_datun' =>  [
                'rules' => 'required|is_unique[tb_datun.judul_datun]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_datun' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/datun/create')->withInput();
        }
        // $fileGambardatun = $this->request->getFile('gambar_datun');
        // // generate nama gambardatun random
        // $namaGambardatun = $fileGambardatun->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambardatun->move('img_simpan', $namaGambardatun);

        $slug_datun = url_title($this->request->getVar('judul_datun'), '-', true);
        $this->datunModel->save([
            'judul_datun' => $this->request->getVar('judul_datun'),
            'isi_datun' => $this->request->getVar('isi_datun'),
            'tag_datun' => $this->request->getVar('tag_datun'),
            'slug_datun' => $slug_datun
            // 'gambar_datun' => $namaGambardatun,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/datun');
    }

    public function delete($id_datun)
    {
        // cari gambar berdasarkan id
        // $datun = $this->datunModel->find($id_datun);

        // cek jika file gambarnya default.png

        // if ($datun['gambar_datun'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $datun['gambar_datun']);
        // }

        $this->datunModel->delete($id_datun);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/datun');
    }

    public function edit($slug_datun)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'datun' => $this->datunModel->getdatun($slug_datun),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_datun', $data);
    }

    public function update($id_datun)
    {
        // cek judul
        $datunLama = $this->datunModel->getdatun($this->request->getVar('slug_datun'));

        if ($datunLama['judul_datun'] == $this->request->getVar('judul_datun')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_datun.judul_datun]';
        }
        // validasi input
        if (!$this->validate([
            'judul_datun' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_datun' . $this->request->getVar('slug_datun'))->withInput();
        }

        // $filegambardatun = $this->request->getFile('gambar_datun');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambardatun->getError() == 4) {
        //     $namagambardatun = $this->request->getVar('gambar_datunLama');
        // } else {
        //     // generate nama file random
        //     $namagambardatun = $filegambardatun->getRandomName();
        //     // pindahkan gambar
        //     $filegambardatun->move('img_simpan', $namagambardatun);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_datunLama'));
        // }

        $slug_datun = url_title($this->request->getVar('judul_datun'), '-', true);
        $this->datunModel->save([
            'id_datun' => $id_datun,
            'judul_datun' => $this->request->getVar('judul_datun'),
            'slug_datun' => $slug_datun,
            'isi_datun' => $this->request->getVar('isi_datun'),
            // 'gambar_datun' => $namagambardatun
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/datun');
    }
}

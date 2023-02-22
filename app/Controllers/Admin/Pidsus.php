<?php

namespace App\Controllers\Admin;

use App\Models\pidsusModel;

class pidsus extends BaseController
{
    protected $pidsusModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pidsus');
        $this->pidsusModel  = new pidsusModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pidsus' =>  $this->pidsusModel->getpidsus()
        ];

        return view('pages/admin/laman/pidsus', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pidsus Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pidsus', $data);
    }

    public function detail($slug_pidsus)
    {
        $data = [
            'title' => 'Detail pidsus | Admin Kelurahan Sapugarut',
            'pidsus' => $this->pidsusModel->getpidsus($slug_pidsus),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pidsus_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pidsus' =>  [
                'rules' => 'required|is_unique[tb_pidsus.judul_pidsus]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pidsus' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pidsus/create')->withInput();
        }
        // $fileGambarpidsus = $this->request->getFile('gambar_pidsus');
        // // generate nama gambarpidsus random
        // $namaGambarpidsus = $fileGambarpidsus->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpidsus->move('img_simpan', $namaGambarpidsus);

        $slug_pidsus = url_title($this->request->getVar('judul_pidsus'), '-', true);
        $this->pidsusModel->save([
            'judul_pidsus' => $this->request->getVar('judul_pidsus'),
            'isi_pidsus' => $this->request->getVar('isi_pidsus'),
            'tag_pidsus' => $this->request->getVar('tag_pidsus'),
            'slug_pidsus' => $slug_pidsus
            // 'gambar_pidsus' => $namaGambarpidsus,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pidsus');
    }

    public function delete($id_pidsus)
    {
        // cari gambar berdasarkan id
        // $pidsus = $this->pidsusModel->find($id_pidsus);

        // cek jika file gambarnya default.png

        // if ($pidsus['gambar_pidsus'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pidsus['gambar_pidsus']);
        // }

        $this->pidsusModel->delete($id_pidsus);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pidsus');
    }

    public function edit($slug_pidsus)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pidsus' => $this->pidsusModel->getpidsus($slug_pidsus),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pidsus', $data);
    }

    public function update($id_pidsus)
    {
        // cek judul
        $pidsusLama = $this->pidsusModel->getpidsus($this->request->getVar('slug_pidsus'));

        if ($pidsusLama['judul_pidsus'] == $this->request->getVar('judul_pidsus')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pidsus.judul_pidsus]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pidsus' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pidsus' . $this->request->getVar('slug_pidsus'))->withInput();
        }

        // $filegambarpidsus = $this->request->getFile('gambar_pidsus');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpidsus->getError() == 4) {
        //     $namagambarpidsus = $this->request->getVar('gambar_pidsusLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpidsus = $filegambarpidsus->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpidsus->move('img_simpan', $namagambarpidsus);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pidsusLama'));
        // }

        $slug_pidsus = url_title($this->request->getVar('judul_pidsus'), '-', true);
        $this->pidsusModel->save([
            'id_pidsus' => $id_pidsus,
            'judul_pidsus' => $this->request->getVar('judul_pidsus'),
            'slug_pidsus' => $slug_pidsus,
            'isi_pidsus' => $this->request->getVar('isi_pidsus'),
            // 'gambar_pidsus' => $namagambarpidsus
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pidsus');
    }
}

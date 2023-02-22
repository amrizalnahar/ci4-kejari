<?php

namespace App\Controllers\Admin;

use App\Models\pidanakhususModel;

class pidanakhusus extends BaseController
{
    protected $pidanakhususModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pidanakhusus');
        $this->pidanakhususModel  = new pidanakhususModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pidanakhusus' =>  $this->pidanakhususModel->getpidanakhusus()
        ];

        return view('pages/admin/laman/pidanakhusus', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pidanakhusus Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pidanakhusus', $data);
    }

    public function detail($slug_pidanakhusus)
    {
        $data = [
            'title' => 'Detail pidanakhusus | Admin Kelurahan Sapugarut',
            'pidanakhusus' => $this->pidanakhususModel->getpidanakhusus($slug_pidanakhusus),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pidanakhusus_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pidanakhusus' =>  [
                'rules' => 'required|is_unique[tb_pidanakhusus.judul_pidanakhusus]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pidanakhusus' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pidanakhusus/create')->withInput();
        }
        // $fileGambarpidanakhusus = $this->request->getFile('gambar_pidanakhusus');
        // // generate nama gambarpidanakhusus random
        // $namaGambarpidanakhusus = $fileGambarpidanakhusus->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpidanakhusus->move('img_simpan', $namaGambarpidanakhusus);

        $slug_pidanakhusus = url_title($this->request->getVar('judul_pidanakhusus'), '-', true);
        $this->pidanakhususModel->save([
            'judul_pidanakhusus' => $this->request->getVar('judul_pidanakhusus'),
            'isi_pidanakhusus' => $this->request->getVar('isi_pidanakhusus'),
            'tag_pidanakhusus' => $this->request->getVar('tag_pidanakhusus'),
            'slug_pidanakhusus' => $slug_pidanakhusus
            // 'gambar_pidanakhusus' => $namaGambarpidanakhusus,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pidanakhusus');
    }

    public function delete($id_pidanakhusus)
    {
        // cari gambar berdasarkan id
        // $pidanakhusus = $this->pidanakhususModel->find($id_pidanakhusus);

        // cek jika file gambarnya default.png

        // if ($pidanakhusus['gambar_pidanakhusus'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pidanakhusus['gambar_pidanakhusus']);
        // }

        $this->pidanakhususModel->delete($id_pidanakhusus);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pidanakhusus');
    }

    public function edit($slug_pidanakhusus)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pidanakhusus' => $this->pidanakhususModel->getpidanakhusus($slug_pidanakhusus),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pidanakhusus', $data);
    }

    public function update($id_pidanakhusus)
    {
        // cek judul
        $pidanakhususLama = $this->pidanakhususModel->getpidanakhusus($this->request->getVar('slug_pidanakhusus'));

        if ($pidanakhususLama['judul_pidanakhusus'] == $this->request->getVar('judul_pidanakhusus')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pidanakhusus.judul_pidanakhusus]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pidanakhusus' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pidanakhusus' . $this->request->getVar('slug_pidanakhusus'))->withInput();
        }

        // $filegambarpidanakhusus = $this->request->getFile('gambar_pidanakhusus');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpidanakhusus->getError() == 4) {
        //     $namagambarpidanakhusus = $this->request->getVar('gambar_pidanakhususLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpidanakhusus = $filegambarpidanakhusus->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpidanakhusus->move('img_simpan', $namagambarpidanakhusus);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pidanakhususLama'));
        // }

        $slug_pidanakhusus = url_title($this->request->getVar('judul_pidanakhusus'), '-', true);
        $this->pidanakhususModel->save([
            'id_pidanakhusus' => $id_pidanakhusus,
            'judul_pidanakhusus' => $this->request->getVar('judul_pidanakhusus'),
            'slug_pidanakhusus' => $slug_pidanakhusus,
            'isi_pidanakhusus' => $this->request->getVar('isi_pidanakhusus'),
            // 'gambar_pidanakhusus' => $namagambarpidanakhusus
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pidanakhusus');
    }
}

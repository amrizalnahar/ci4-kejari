<?php

namespace App\Controllers\Admin;

use App\Models\intelijenModel;

class intelijen extends BaseController
{
    protected $intelijenModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_intelijen');
        $this->intelijenModel  = new intelijenModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'intelijen' =>  $this->intelijenModel->getintelijen()
        ];

        return view('pages/admin/laman/intelijen', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah intelijen Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_intelijen', $data);
    }

    public function detail($slug_intelijen)
    {
        $data = [
            'title' => 'Detail intelijen | Admin Kelurahan Sapugarut',
            'intelijen' => $this->intelijenModel->getintelijen($slug_intelijen),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/intelijen_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_intelijen' =>  [
                'rules' => 'required|is_unique[tb_intelijen.judul_intelijen]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_intelijen' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/intelijen/create')->withInput();
        }
        // $fileGambarintelijen = $this->request->getFile('gambar_intelijen');
        // // generate nama gambarintelijen random
        // $namaGambarintelijen = $fileGambarintelijen->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarintelijen->move('img_simpan', $namaGambarintelijen);

        $slug_intelijen = url_title($this->request->getVar('judul_intelijen'), '-', true);
        $this->intelijenModel->save([
            'judul_intelijen' => $this->request->getVar('judul_intelijen'),
            'isi_intelijen' => $this->request->getVar('isi_intelijen'),
            'tag_intelijen' => $this->request->getVar('tag_intelijen'),
            'slug_intelijen' => $slug_intelijen
            // 'gambar_intelijen' => $namaGambarintelijen,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/intelijen');
    }

    public function delete($id_intelijen)
    {
        // cari gambar berdasarkan id
        // $intelijen = $this->intelijenModel->find($id_intelijen);

        // cek jika file gambarnya default.png

        // if ($intelijen['gambar_intelijen'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $intelijen['gambar_intelijen']);
        // }

        $this->intelijenModel->delete($id_intelijen);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/intelijen');
    }

    public function edit($slug_intelijen)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'intelijen' => $this->intelijenModel->getintelijen($slug_intelijen),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_intelijen', $data);
    }

    public function update($id_intelijen)
    {
        // cek judul
        $intelijenLama = $this->intelijenModel->getintelijen($this->request->getVar('slug_intelijen'));

        if ($intelijenLama['judul_intelijen'] == $this->request->getVar('judul_intelijen')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_intelijen.judul_intelijen]';
        }
        // validasi input
        if (!$this->validate([
            'judul_intelijen' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_intelijen' . $this->request->getVar('slug_intelijen'))->withInput();
        }

        // $filegambarintelijen = $this->request->getFile('gambar_intelijen');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarintelijen->getError() == 4) {
        //     $namagambarintelijen = $this->request->getVar('gambar_intelijenLama');
        // } else {
        //     // generate nama file random
        //     $namagambarintelijen = $filegambarintelijen->getRandomName();
        //     // pindahkan gambar
        //     $filegambarintelijen->move('img_simpan', $namagambarintelijen);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_intelijenLama'));
        // }

        $slug_intelijen = url_title($this->request->getVar('judul_intelijen'), '-', true);
        $this->intelijenModel->save([
            'id_intelijen' => $id_intelijen,
            'judul_intelijen' => $this->request->getVar('judul_intelijen'),
            'slug_intelijen' => $slug_intelijen,
            'isi_intelijen' => $this->request->getVar('isi_intelijen'),
            // 'gambar_intelijen' => $namagambarintelijen
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/intelijen');
    }
}

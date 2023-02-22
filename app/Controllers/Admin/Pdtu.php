<?php

namespace App\Controllers\Admin;

use App\Models\pdtuModel;

class pdtu extends BaseController
{
    protected $pdtuModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pdtu');
        $this->pdtuModel  = new pdtuModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pdtu' =>  $this->pdtuModel->getpdtu()
        ];

        return view('pages/admin/laman/pdtu', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pdtu Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pdtu', $data);
    }

    public function detail($slug_pdtu)
    {
        $data = [
            'title' => 'Detail pdtu | Admin Kelurahan Sapugarut',
            'pdtu' => $this->pdtuModel->getpdtu($slug_pdtu),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pdtu_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pdtu' =>  [
                'rules' => 'required|is_unique[tb_pdtu.judul_pdtu]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pdtu' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pdtu/create')->withInput();
        }
        // $fileGambarpdtu = $this->request->getFile('gambar_pdtu');
        // // generate nama gambarpdtu random
        // $namaGambarpdtu = $fileGambarpdtu->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpdtu->move('img_simpan', $namaGambarpdtu);

        $slug_pdtu = url_title($this->request->getVar('judul_pdtu'), '-', true);
        $this->pdtuModel->save([
            'judul_pdtu' => $this->request->getVar('judul_pdtu'),
            'isi_pdtu' => $this->request->getVar('isi_pdtu'),
            'tag_pdtu' => $this->request->getVar('tag_pdtu'),
            'slug_pdtu' => $slug_pdtu
            // 'gambar_pdtu' => $namaGambarpdtu,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pdtu');
    }

    public function delete($id_pdtu)
    {
        // cari gambar berdasarkan id
        // $pdtu = $this->pdtuModel->find($id_pdtu);

        // cek jika file gambarnya default.png

        // if ($pdtu['gambar_pdtu'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pdtu['gambar_pdtu']);
        // }

        $this->pdtuModel->delete($id_pdtu);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pdtu');
    }

    public function edit($slug_pdtu)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pdtu' => $this->pdtuModel->getpdtu($slug_pdtu),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pdtu', $data);
    }

    public function update($id_pdtu)
    {
        // cek judul
        $pdtuLama = $this->pdtuModel->getpdtu($this->request->getVar('slug_pdtu'));

        if ($pdtuLama['judul_pdtu'] == $this->request->getVar('judul_pdtu')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pdtu.judul_pdtu]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pdtu' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pdtu' . $this->request->getVar('slug_pdtu'))->withInput();
        }

        // $filegambarpdtu = $this->request->getFile('gambar_pdtu');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpdtu->getError() == 4) {
        //     $namagambarpdtu = $this->request->getVar('gambar_pdtuLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpdtu = $filegambarpdtu->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpdtu->move('img_simpan', $namagambarpdtu);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pdtuLama'));
        // }

        $slug_pdtu = url_title($this->request->getVar('judul_pdtu'), '-', true);
        $this->pdtuModel->save([
            'id_pdtu' => $id_pdtu,
            'judul_pdtu' => $this->request->getVar('judul_pdtu'),
            'slug_pdtu' => $slug_pdtu,
            'isi_pdtu' => $this->request->getVar('isi_pdtu'),
            // 'gambar_pdtu' => $namagambarpdtu
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pdtu');
    }
}

<?php

namespace App\Controllers\Admin;

use App\Models\adkModel;

class Adhyaksadharmakarini extends BaseController
{
    protected $adkModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_adhyaksadharmakarini');
        $this->adkModel  = new adkModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'adk' =>  $this->adkModel->getAdk()
        ];

        return view('pages/admin/laman/adhyaksadharmakarini', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah adk Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_adk', $data);
    }

    public function detail($slug_adk)
    {
        $data = [
            'title' => 'Detail adk | Admin Kelurahan Sapugarut',
            'adk' => $this->adkModel->getAdk($slug_adk),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/adk_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_adk' =>  [
                'rules' => 'required|is_unique[tb_adhyaksadharmakarini.judul_adk]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_adk' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/adhyaksadharmakarini/create')->withInput();
        }
        // $fileGambaradk = $this->request->getFile('gambar_adk');
        // // generate nama gambaradk random
        // $namaGambaradk = $fileGambaradk->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambaradk->move('img_simpan', $namaGambaradk);

        $slug_adk = url_title($this->request->getVar('judul_adk'), '-', true);
        $this->adkModel->save([
            'judul_adk' => $this->request->getVar('judul_adk'),
            'isi_adk' => $this->request->getVar('isi_adk'),
            'tag_adk' => $this->request->getVar('tag_adk'),
            'slug_adk' => $slug_adk
            // 'gambar_adk' => $namaGambaradk,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/adhyaksadharmakarini');
    }

    public function delete($id_adk)
    {
        // cari gambar berdasarkan id
        // $adk = $this->adkModel->find($id_adk);

        // cek jika file gambarnya default.png

        // if ($adk['gambar_adk'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $adk['gambar_adk']);
        // }

        $this->adkModel->delete($id_adk);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/adhyaksadharmakarini');
    }

    public function edit($slug_adk)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'adk' => $this->adkModel->getAdk($slug_adk),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_adk', $data);
    }

    public function update($id_adk)
    {
        // cek judul
        $adkLama = $this->adkModel->getAdk($this->request->getVar('slug_adk'));

        if ($adkLama['judul_adk'] == $this->request->getVar('judul_adk')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_adhyaksadharmakarini.judul_adk]';
        }
        // validasi input
        if (!$this->validate([
            'judul_adk' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_adk' . $this->request->getVar('slug_adk'))->withInput();
        }

        // $filegambaradk = $this->request->getFile('gambar_adk');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambaradk->getError() == 4) {
        //     $namagambaradk = $this->request->getVar('gambar_adkLama');
        // } else {
        //     // generate nama file random
        //     $namagambaradk = $filegambaradk->getRandomName();
        //     // pindahkan gambar
        //     $filegambaradk->move('img_simpan', $namagambaradk);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_adkLama'));
        // }

        $slug_adk = url_title($this->request->getVar('judul_adk'), '-', true);
        $this->adkModel->save([
            'id_adk' => $id_adk,
            'judul_adk' => $this->request->getVar('judul_adk'),
            'slug_adk' => $slug_adk,
            'isi_adk' => $this->request->getVar('isi_adk'),
            // 'gambar_adk' => $namagambaradk
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/adhyaksadharmakarini');
    }
}

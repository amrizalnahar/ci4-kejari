<?php

namespace App\Controllers\Admin;

use App\Models\pidumModel;

class pidum extends BaseController
{
    protected $pidumModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_pidum');
        $this->pidumModel  = new pidumModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Adhyaksa Dharma Karini | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
            'pidum' =>  $this->pidumModel->getpidum()
        ];

        return view('pages/admin/laman/pidum', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah pidum Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/tambah_pidum', $data);
    }

    public function detail($slug_pidum)
    {
        $data = [
            'title' => 'Detail pidum | Admin Kelurahan Sapugarut',
            'pidum' => $this->pidumModel->getpidum($slug_pidum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/pidum_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_pidum' =>  [
                'rules' => 'required|is_unique[tb_pidum.judul_pidum]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ],
            'isi_pidum' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/admin/pidum/create')->withInput();
        }
        // $fileGambarpidum = $this->request->getFile('gambar_pidum');
        // // generate nama gambarpidum random
        // $namaGambarpidum = $fileGambarpidum->getRandomName();
        // // pindahkan file ke folder img
        // $fileGambarpidum->move('img_simpan', $namaGambarpidum);

        $slug_pidum = url_title($this->request->getVar('judul_pidum'), '-', true);
        $this->pidumModel->save([
            'judul_pidum' => $this->request->getVar('judul_pidum'),
            'isi_pidum' => $this->request->getVar('isi_pidum'),
            'tag_pidum' => $this->request->getVar('tag_pidum'),
            'slug_pidum' => $slug_pidum
            // 'gambar_pidum' => $namaGambarpidum,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pidum');
    }

    public function delete($id_pidum)
    {
        // cari gambar berdasarkan id
        // $pidum = $this->pidumModel->find($id_pidum);

        // cek jika file gambarnya default.png

        // if ($pidum['gambar_pidum'] != 'default.png') {
        //     // hapus gambar
        //     unlink('img_simpan/' . $pidum['gambar_pidum']);
        // }

        $this->pidumModel->delete($id_pidum);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pidum');
    }

    public function edit($slug_pidum)
    {
        $data = [
            'title' => 'Form Edit | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'pidum' => $this->pidumModel->getpidum($slug_pidum),
            'currentAdminMenu' => 'semualaman',
            'currentAdminSubMenu' => 'semualaman',
        ];

        return view('pages/admin/laman/edit_pidum', $data);
    }

    public function update($id_pidum)
    {
        // cek judul
        $pidumLama = $this->pidumModel->getpidum($this->request->getVar('slug_pidum'));

        if ($pidumLama['judul_pidum'] == $this->request->getVar('judul_pidum')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_pidum.judul_pidum]';
        }
        // validasi input
        if (!$this->validate([
            'judul_pidum' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('pages/admin/laman/edit_pidum' . $this->request->getVar('slug_pidum'))->withInput();
        }

        // $filegambarpidum = $this->request->getFile('gambar_pidum');

        // // cek gambar, apakah tetap gambar lama
        // if ($filegambarpidum->getError() == 4) {
        //     $namagambarpidum = $this->request->getVar('gambar_pidumLama');
        // } else {
        //     // generate nama file random
        //     $namagambarpidum = $filegambarpidum->getRandomName();
        //     // pindahkan gambar
        //     $filegambarpidum->move('img_simpan', $namagambarpidum);
        //     // hapus file yang lama
        //     unlink('img_simpan/' . $this->request->getVar('gambar_pidumLama'));
        // }

        $slug_pidum = url_title($this->request->getVar('judul_pidum'), '-', true);
        $this->pidumModel->save([
            'id_pidum' => $id_pidum,
            'judul_pidum' => $this->request->getVar('judul_pidum'),
            'slug_pidum' => $slug_pidum,
            'isi_pidum' => $this->request->getVar('isi_pidum'),
            // 'gambar_pidum' => $namagambarpidum
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/pidum');
    }
}

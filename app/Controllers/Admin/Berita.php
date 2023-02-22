<?php

namespace App\Controllers\Admin;

use App\Models\beritaModel;

class Berita extends BaseController
{
    protected $beritaModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tb_berita');
        $this->beritaModel  = new beritaModel();
    }

    public function index()
    {
        helper('text');
        $data = [
            'title' => 'Berita | Kejaksaan Kabupaten Pekalongan',
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'berita',
            'tb_berita' =>  $this->beritaModel->getBerita()
        ];

        return view('pages/admin/berita', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Berita Baru | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'berita',
        ];

        return view('pages/admin/tambahberita', $data);
    }

    public function detail($slug_berita)
    {
        $data = [
            'title' => 'Detail Berita | Admin Kelurahan Sapugarut',
            'berita' => $this->beritaModel->getBerita($slug_berita),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'berita',

        ];

        return view('pages/admin/berita_detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul_berita' =>  [
                'rules' => 'required|is_unique[tb_berita.judul_berita]',
                'errors' => [
                    'required' => 'Judul berita harus diisi.',
                    'is_unique' => 'Judul berita sudah terdaftar'
                ]
            ],
            'isi_berita' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi berita harus diisi.',
                ]
            ],
            'gambar_berita' => [
                'rules' => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/berita/create')->withInput();
        }
        $fileGambarBerita = $this->request->getFile('gambar_berita');
        // generate nama gambarBerita random
        $namaGambarBerita = $fileGambarBerita->getRandomName();
        // pindahkan file ke folder img
        $fileGambarBerita->move('img_simpan', $namaGambarBerita);

        $slug_berita = url_title($this->request->getVar('judul_berita'), '-', true);
        $this->beritaModel->save([
            'judul_berita' => $this->request->getVar('judul_berita'),
            'isi_berita' => $this->request->getVar('isi_berita'),
            'tag_berita' => $this->request->getVar('tag_berita'),
            'slug_berita' => $slug_berita,
            'gambar_berita' => $namaGambarBerita,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/berita');
    }

    public function delete($id_berita)
    {
        // cari gambar berdasarkan id
        $berita = $this->beritaModel->find($id_berita);

        // cek jika file gambarnya default.png

        if ($berita['gambar_berita'] != 'default.png') {
            // hapus gambar
            unlink('img_simpan/' . $berita['gambar_berita']);
        }

        $this->beritaModel->delete($id_berita);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/berita');
    }

    public function edit($slug_berita)
    {
        $data = [
            'title' => 'Form Edit Berita | Kejaksaan Kabupaten Pekalongan',
            'validation' => \Config\Services::validation(),
            'berita' => $this->beritaModel->getBerita($slug_berita),
            'currentAdminMenu' => 'pos',
            'currentAdminSubMenu' => 'berita',
        ];

        return view('pages/admin/editberita', $data);
    }

    public function update($id_berita)
    {
        // cek judul
        $beritaLama = $this->beritaModel->getBerita($this->request->getVar('slug_berita'));

        if ($beritaLama['judul_berita'] == $this->request->getVar('judul_berita')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[tb_berita.judul_berita]';
        }
        // validasi input
        if (!$this->validate([
            'judul_berita' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul berita harus diisi.',
                    'is_unique' => 'Judul berita sudah terdaftar'
                ]
            ],
            'gambar_berita' => [
                'rules' => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar melebihi 1 MB',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/berita/edit/' . $this->request->getVar('slug_berita'))->withInput();
        }

        $filegambarBerita = $this->request->getFile('gambar_berita');

        // cek gambar, apakah tetap gambar lama
        if ($filegambarBerita->getError() == 4) {
            $namagambarBerita = $this->request->getVar('gambar_beritaLama');
        } else {
            // generate nama file random
            $namagambarBerita = $filegambarBerita->getRandomName();
            // pindahkan gambar
            $filegambarBerita->move('img_simpan', $namagambarBerita);
            // hapus file yang lama
            unlink('img_simpan/' . $this->request->getVar('gambar_beritaLama'));
        }

        $slug_berita = url_title($this->request->getVar('judul_berita'), '-', true);
        $this->beritaModel->save([
            'id_berita' => $id_berita,
            'judul_berita' => $this->request->getVar('judul_berita'),
            'slug_berita' => $slug_berita,
            'isi_berita' => $this->request->getVar('isi_berita'),
            'gambar_berita' => $namagambarBerita
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/admin/berita');
    }
}

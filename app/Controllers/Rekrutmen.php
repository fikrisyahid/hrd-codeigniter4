<?php

namespace App\Controllers;

use App\Models\RekrutmenModel;
use App\Models\PelanggaranModel;

class Rekrutmen extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $RekrutmenModel;
    protected $PelanggaranModel;

    public function __construct()
    {
        $this->RekrutmenModel = new RekrutmenModel();
        $this->PelanggaranModel = new PelanggaranModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Rekrutmen',
            'rekrutmen' => $this->RekrutmenModel->getRekrutmen()
        ];

        return view('rekrutmen/index', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Detail Rekrutmen',
            'rekrutmen' => $this->RekrutmenModel->getRekrutmen($id)
        ];

        if (empty($data['rekrutmen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Rekrutmen dengan id $id tidak dapat ditemukan");
        }

        return view('rekrutmen/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Rekrutmen',
            'validation' => \Config\Services::validation()
        ];
        return view('rekrutmen/create', $data);
    }

    public function save()
    {

        $tgl_apply_hari = $this->request->getVar('tgl_apply_hari');
        $tgl_apply_bulan = $this->request->getVar('tgl_apply_bulan');
        $tgl_apply_tahun = $this->request->getVar('tgl_apply_tahun');
        $tgl_apply = "$tgl_apply_tahun-$tgl_apply_bulan-$tgl_apply_hari";

        if (!$this->validate([
            'nik' => [
                'rules' => "required|numeric|min_length[16]|max_length[16]",
                'errors' => [
                    'required' => 'NIK wajib diisi.',
                    'numeric' => 'NIK harus berupa angka.',
                    'min_length' => 'NIK harus 16 digit.',
                    'max_length' => 'NIK harus 16 digit.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib diisi.'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin wajib diisi.'
                ]
            ],
            'tgl_apply_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tgl_apply_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tgl_apply_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan terakhir wajib diisi.'
                ]
            ],
            'nilai_akhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai akhir wajib diisi.'
                ]
            ],
            'no_tlfn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. telepon wajib diisi.'
                ]
            ],
            'foto_profil' => [
                'rules' => 'max_size[foto_profil,2048]|mime_in[foto_profil,image/png,image/jpg,image/jpeg]|is_image[foto_profil]',
                'errors' => [
                    'max_size' => 'Ukuran file tidak boleh lebih besar dari 2MB',
                    'mime_in' => 'File yang  diupload harus berupa gambar',
                    'is_image' => 'File yang diupload harus berupa gambar'
                ]
            ]
        ])) {
            return redirect()->to('/rekrutmen/create')->withInput();
        }

        // Mengecek apakah foto diinput atau tidak
        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil->getName() == '') {
            $namaFotoProfil = 'default.jpg';
        } else {
            $namaFotoProfil = $fotoProfil->getName();
            $fotoProfil->move("img/foto_profil_rekrutmen/", $namaFotoProfil);
        }

        $this->RekrutmenModel->save([
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tgl_apply' => $tgl_apply,
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir'),
            'email' => $this->request->getVar('email'),
            'no_tlfn' => $this->request->getVar('no_tlfn'),
            'status' => $this->request->getVar('status'),
            'foto_profil' => $namaFotoProfil
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/rekrutmen');
    }

    public function delete($id)
    {
        $this->RekrutmenModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/rekrutmen');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Rekrutmen',
            'validation' => \Config\Services::validation(),
            'rekrutmen' => $this->RekrutmenModel->getRekrutmen($id)
        ];
        return view('rekrutmen/edit', $data);
    }

    public function update($id)
    {
        $tgl_apply_hari = $this->request->getVar('tgl_apply_hari');
        $tgl_apply_bulan = $this->request->getVar('tgl_apply_bulan');
        $tgl_apply_tahun = $this->request->getVar('tgl_apply_tahun');

        $tgl_apply = "$tgl_apply_tahun-$tgl_apply_bulan-$tgl_apply_hari";

        $rekrutmen = $this->RekrutmenModel->getrekrutmen($id);
        $paramForReturn = $rekrutmen['id'];

        if (!$this->validate([
            'nik' => [
                'rules' => "required|numeric|min_length[16]|max_length[16]",
                'errors' => [
                    'required' => 'NIK wajib diisi.',
                    'numeric' => 'NIK harus berupa angka.',
                    'min_length' => 'NIK harus 16 digit.',
                    'max_length' => 'NIK harus 16 digit.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib diisi.'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin wajib diisi.'
                ]
            ],
            'tgl_apply_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tgl_apply_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tgl_apply_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan terakhir wajib diisi.'
                ]
            ],
            'nilai_akhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai akhir wajib diisi.'
                ]
            ],
            'no_tlfn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. telepon wajib diisi.'
                ]
            ],
            'foto_profil' => [
                'rules' => 'max_size[foto_profil,2048]|mime_in[foto_profil,image/png,image/jpg,image/jpeg]|is_image[foto_profil]',
                'errors' => [
                    'max_size' => 'Ukuran file tidak boleh lebih besar dari 2MB',
                    'mime_in' => 'File yang  diupload harus berupa gambar',
                    'is_image' => 'File yang diupload harus berupa gambar'
                ]
            ]
        ])) {
            return redirect()->to("/rekrutmen/edit/$paramForReturn")->withInput();
        }

        // Mengecek apakah foto diinput atau tidak
        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil->getName() == '') {
            $namaFotoProfil = 'default.jpg';
            if ($this->request->getVar('pp') == $rekrutmen['foto_profil']) {
                $namaFotoProfil = $rekrutmen['foto_profil'];
            }
        } else {
            $namaFotoProfil = $fotoProfil->getName();
            $fotoProfil->move("img/foto_profil_rekrutmen/", $namaFotoProfil);
        }

        $this->RekrutmenModel->save([
            'id' => $rekrutmen['id'],
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tgl_apply' => $tgl_apply,
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir'),
            'email' => $this->request->getVar('email'),
            'no_tlfn' => $this->request->getVar('no_tlfn'),
            'status' => $this->request->getVar('status'),
            'foto_profil' => $namaFotoProfil
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/rekrutmen');
    }
}

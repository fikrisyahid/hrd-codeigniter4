<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PendidikanModel;

class Pendidikan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $PendidikanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->PendidikanModel = new PendidikanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Riwayat Pendidikan',
            'pendidikan' => $this->PendidikanModel->getPendidikan()
        ];

        return view('pendidikan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data pendidikan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('pendidikan/create', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'nama_karyawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih karyawan.'
                ]
            ],
            'tingkat_pendidikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib mengisi tingkat pendidikan.'
                ]
            ],
            'tahun_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih tahun masuk.'
                ]
            ],
            'tahun_lulus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih tahun lulus.'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama instansi wajib diisi.'
                ]
            ],
            'nilai_akhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai akhir wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/pendidikan/create")->withInput();
        }

        $this->PendidikanModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['id'],
            'id_karyawan' => $this->request->getVar('nama_karyawan'),
            'nama_karyawan' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['nama'],
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'tingkat_pendidikan' => $this->request->getVar('tingkat_pendidikan'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir')
        ]);

        return redirect()->to("/pendidikan");
    }

    public function delete($id)
    {
        $this->PendidikanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/pendidikan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data pendidikan',
            'validation' => \Config\Services::validation(),
            'pendidikan' => $this->PendidikanModel->getPendidikan($id)
        ];
        return view('pendidikan/edit', $data);
    }

    public function update($id)
    {
        $pendidikan = $this->PendidikanModel->getPendidikan($id);

        if (!$this->validate([
            'tingkat_pendidikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tingkat pendidikan wajib diisi.'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama instansi wajib diisi.'
                ]
            ],
            'tahun_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun masuk wajib diisi.'
                ]
            ],
            'tahun_lulus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun lulus wajib diisi.'
                ]
            ],
            'nilai_akhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai akhir wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $pendidikan['id_pendidikan'];
            return redirect()->to("/pendidikan/edit/$idparam")->withInput();
        }

        $this->PendidikanModel->save([
            'id_pendidikan' => $id,
            'id' => $pendidikan['id'],
            'id_karyawan' => $pendidikan['id_karyawan'],
            'nama_karyawan' => $pendidikan['nama_karyawan'],
            'tingkat_pendidikan' => $this->request->getVar('tingkat_pendidikan'),
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'nilai_akhir' => $this->request->getVar('nilai_akhir')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/pendidikan');
    }
}

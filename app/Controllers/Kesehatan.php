<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KesehatanModel;

class Kesehatan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $KesehatanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->KesehatanModel = new KesehatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Riwayat Kesehatan',
            'kesehatan' => $this->KesehatanModel->getKesehatan()
        ];

        return view('kesehatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kesehatan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('kesehatan/create', $data);
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
            'nama_penyakit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib mengisi nama penyakit.'
                ]
            ],
            'tahun_sakit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih tahun sakit.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/kesehatan/create")->withInput();
        }

        $this->KesehatanModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['id'],
            'id_karyawan' => $this->request->getVar('nama_karyawan'),
            'nama_karyawan' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['nama'],
            'nama_penyakit' => $this->request->getVar('nama_penyakit'),
            'tahun_sakit' => $this->request->getVar('tahun_sakit'),
            'tahun_sembuh' => $this->request->getVar('tahun_sembuh'),
            'status' => $this->request->getVar('status')
        ]);

        return redirect()->to("/kesehatan");
    }

    public function delete($id)
    {
        $this->KesehatanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kesehatan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data kesehatan',
            'validation' => \Config\Services::validation(),
            'kesehatan' => $this->KesehatanModel->getKesehatan($id)
        ];
        return view('kesehatan/edit', $data);
    }

    public function update($id)
    {
        $kesehatan = $this->KesehatanModel->getKesehatan($id);

        if (!$this->validate([
            'nama_penyakit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama penyakit wajib diisi.'
                ]
            ],
            'tahun_sakit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun sakit wajib diisi.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $kesehatan['id_kesehatan'];
            return redirect()->to("/kesehatan/edit/$idparam")->withInput();
        }

        $this->KesehatanModel->save([
            'id_kesehatan' => $id,
            'id' => $kesehatan['id'],
            'id_karyawan' => $kesehatan['id_karyawan'],
            'nama_karyawan' => $kesehatan['nama_karyawan'],
            'nama_penyakit' => $this->request->getVar('nama_penyakit'),
            'tahun_sakit' => $this->request->getVar('tahun_sakit'),
            'tahun_sembuh' => $this->request->getVar('tahun_sembuh'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kesehatan');
    }
}

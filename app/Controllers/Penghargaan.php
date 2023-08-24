<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PenghargaanModel;

class Penghargaan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $PenghargaanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->PenghargaanModel = new PenghargaanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Penghargaan',
            'penghargaan' => $this->PenghargaanModel->getPenghargaan()
        ];

        return view('penghargaan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data penghargaan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('penghargaan/create', $data);
    }

    public function save()
    {
        $tanggal_hari = $this->request->getVar('tanggal_hari');
        $tanggal_bulan = $this->request->getVar('tanggal_bulan');
        $tanggal_tahun = $this->request->getVar('tanggal_tahun');
        $tanggal = "$tanggal_tahun-$tanggal_bulan-$tanggal_hari";

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih karyawan.'
                ]
            ],
            'tanggal_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan wajib diisi.'
                ]
            ],
            'jenis_penghargaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis penghargaan wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/penghargaan/create")->withInput();
        }

        $this->PenghargaanModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['id'],
            'id_karyawan' => $this->request->getVar('nama'),
            'nama' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['nama'],
            'tanggal' => $tanggal,
            'jenis_penghargaan' => $this->request->getVar('jenis_penghargaan'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        return redirect()->to("/penghargaan");
    }

    public function delete($id)
    {
        $this->PenghargaanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/penghargaan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data penghargaan',
            'validation' => \Config\Services::validation(),
            'penghargaan' => $this->PenghargaanModel->getPenghargaan($id)
        ];
        return view('penghargaan/edit', $data);
    }

    public function update($id)
    {
        $penghargaan = $this->PenghargaanModel->getPenghargaan($id);

        $tanggal_hari = $this->request->getVar('tanggal_hari');
        $tanggal_bulan = $this->request->getVar('tanggal_bulan');
        $tanggal_tahun = $this->request->getVar('tanggal_tahun');
        $tanggal = "$tanggal_tahun-$tanggal_bulan-$tanggal_hari";

        if (!$this->validate([
            'tanggal_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan wajib diisi.'
                ]
            ],
            'jenis_penghargaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis penghargaan wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $penghargaan['id_penghargaan'];
            return redirect()->to("/penghargaan/edit/$idparam")->withInput();
        }

        $this->PenghargaanModel->save([
            'id_penghargaan' => $id,
            'id' => $penghargaan['id'],
            'id_karyawan' => $penghargaan['id_karyawan'],
            'nama' => $penghargaan['nama'],
            'tanggal' => $tanggal,
            'jenis_penghargaan' => $this->request->getVar('jenis_penghargaan'),
            'keterangan' => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/penghargaan');
    }
}

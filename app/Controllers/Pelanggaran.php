<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PelanggaranModel;

class Pelanggaran extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $PelanggaranModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->PelanggaranModel = new PelanggaranModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pelanggaran',
            'pelanggaran' => $this->PelanggaranModel->getPelanggaran()
        ];

        return view('pelanggaran/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelanggaran',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('pelanggaran/create', $data);
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
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan wajib diisi.'
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
            'jenis_pelanggaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis pelanggaran wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/pelanggaran/create")->withInput();
        }

        $this->PelanggaranModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['id'],
            'id_karyawan' => $this->request->getVar('nama'),
            'nama' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['nama'],
            'tanggal' => $tanggal,
            'jenis_pelanggaran' => $this->request->getVar('jenis_pelanggaran'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        return redirect()->to("/pelanggaran");
    }

    public function delete($id)
    {
        $this->PelanggaranModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/pelanggaran');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pelanggaran',
            'validation' => \Config\Services::validation(),
            'pelanggaran' => $this->PelanggaranModel->getPelanggaran($id)
        ];
        return view('pelanggaran/edit', $data);
    }

    public function update($id)
    {
        $pelanggaran = $this->PelanggaranModel->getPelanggaran($id);

        $tanggal_hari = $this->request->getVar('tanggal_hari');
        $tanggal_bulan = $this->request->getVar('tanggal_bulan');
        $tanggal_tahun = $this->request->getVar('tanggal_tahun');
        $tanggal = "$tanggal_tahun-$tanggal_bulan-$tanggal_hari";

        if (!$this->validate([
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan wajib diisi.'
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
            'jenis_pelanggaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis pelanggaran wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $pelanggaran['id_pelanggaran'];
            return redirect()->to("/pelanggaran/edit/$idparam")->withInput();
        }

        $this->PelanggaranModel->save([
            'id_pelanggaran' => $id,
            'id' => $pelanggaran['id'],
            'id_karyawan' => $pelanggaran['id_karyawan'],
            'nama' => $pelanggaran['nama'],
            'tanggal' => $tanggal,
            'jenis_pelanggaran' => $this->request->getVar('jenis_pelanggaran'),
            'keterangan' => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/pelanggaran');
    }
}

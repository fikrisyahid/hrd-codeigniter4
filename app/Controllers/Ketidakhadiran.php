<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KetidakhadiranModel;

class Ketidakhadiran extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $KetidakhadiranModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->KetidakhadiranModel = new KetidakhadiranModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Ketidakhadiran',
            'ketidakhadiran' => $this->KetidakhadiranModel->getKetidakhadiran()
        ];

        return view('ketidakhadiran/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Ketidakhadiran',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('ketidakhadiran/create', $data);
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
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/ketidakhadiran/create")->withInput();
        }

        $this->KetidakhadiranModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['id'],
            'id_karyawan' => $this->request->getVar('nama'),
            'nama' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['nama'],
            'tanggal' => $tanggal,
            'jenis' => $this->request->getVar('jenis'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        return redirect()->to("/ketidakhadiran");
    }

    public function delete($id)
    {
        $this->KetidakhadiranModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/ketidakhadiran');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Ketidakhadiran',
            'validation' => \Config\Services::validation(),
            'ketidakhadiran' => $this->KetidakhadiranModel->getKetidakhadiran($id)
        ];
        return view('ketidakhadiran/edit', $data);
    }

    public function update($id)
    {
        $ketidakhadiran = $this->KetidakhadiranModel->getKetidakhadiran($id);

        $tanggal_hari = $this->request->getVar('tanggal_hari');
        $tanggal_bulan = $this->request->getVar('tanggal_bulan');
        $tanggal_tahun = $this->request->getVar('tanggal_tahun');
        $tanggal = "$tanggal_tahun-$tanggal_bulan-$tanggal_hari";

        if (!$this->validate([
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis wajib diisi.'
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
        ])) {
            $idparam = $ketidakhadiran['id_ketidakhadiran'];
            return redirect()->to("/ketidakhadiran/edit/$idparam")->withInput();
        }

        $this->KetidakhadiranModel->save([
            'id_ketidakhadiran' => $id,
            'id' => $ketidakhadiran['id'],
            'id_karyawan' => $ketidakhadiran['id_karyawan'],
            'nama' => $ketidakhadiran['nama'],
            'tanggal' => $tanggal,
            'jenis' => $this->request->getVar('jenis'),
            'keterangan' => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/ketidakhadiran');
    }
}

<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\JabatanModel;

class Jabatan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $JabatanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->JabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Riwayat Jabatan',
            'jabatan' => $this->JabatanModel->getjabatan()
        ];

        return view('jabatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data jabatan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('jabatan/create', $data);
    }

    public function save()
    {

        $tanggal_mulai_hari = $this->request->getVar('tanggal_mulai_hari');
        $tanggal_mulai_bulan = $this->request->getVar('tanggal_mulai_bulan');
        $tanggal_mulai_tahun = $this->request->getVar('tanggal_mulai_tahun');
        $tanggal_mulai = "$tanggal_mulai_tahun-$tanggal_mulai_bulan-$tanggal_mulai_hari";

        $tanggal_selesai_hari = $this->request->getVar('tanggal_selesai_hari');
        $tanggal_selesai_bulan = $this->request->getVar('tanggal_selesai_bulan');
        $tanggal_selesai_tahun = $this->request->getVar('tanggal_selesai_tahun');
        $tanggal_selesai = "$tanggal_selesai_tahun-$tanggal_selesai_bulan-$tanggal_selesai_hari";

        if (!$this->validate([
            'nama_karyawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih karyawan.'
                ]
            ],
            'nama_jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib mengisi nama jabatan.'
                ]
            ],
            'tanggal_mulai_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'tanggal_mulai_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'tanggal_mulai_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'tanggal_selesai_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'tanggal_selesai_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'tanggal_selesai_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi.'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama instansi wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/jabatan/create")->withInput();
        }

        $this->JabatanModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['id'],
            'id_karyawan' => $this->request->getVar('nama_karyawan'),
            'nama_karyawan' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama_karyawan'))['nama'],
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        ]);

        return redirect()->to("/jabatan");
    }

    public function delete($id)
    {
        $this->JabatanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/jabatan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data jabatan',
            'validation' => \Config\Services::validation(),
            'jabatan' => $this->JabatanModel->getjabatan($id)
        ];
        return view('jabatan/edit', $data);
    }

    public function update($id)
    {
        $jabatan = $this->JabatanModel->getjabatan($id);

        $tanggal_mulai_hari = $this->request->getVar('tanggal_mulai_hari');
        $tanggal_mulai_bulan = $this->request->getVar('tanggal_mulai_bulan');
        $tanggal_mulai_tahun = $this->request->getVar('tanggal_mulai_tahun');
        $tanggal_mulai = "$tanggal_mulai_tahun-$tanggal_mulai_bulan-$tanggal_mulai_hari";

        $tanggal_selesai_hari = $this->request->getVar('tanggal_selesai_hari');
        $tanggal_selesai_bulan = $this->request->getVar('tanggal_selesai_bulan');
        $tanggal_selesai_tahun = $this->request->getVar('tanggal_selesai_tahun');
        $tanggal_selesai = "$tanggal_selesai_tahun-$tanggal_selesai_bulan-$tanggal_selesai_hari";

        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama jabatan wajib diisi.'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama instansi wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $jabatan['id_jabatan'];
            return redirect()->to("/jabatan/edit/$idparam")->withInput();
        }

        $this->JabatanModel->save([
            'id_jabatan' => $id,
            'id' => $jabatan['id'],
            'id_karyawan' => $jabatan['id_karyawan'],
            'nama_karyawan' => $jabatan['nama_karyawan'],
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/jabatan');
    }
}

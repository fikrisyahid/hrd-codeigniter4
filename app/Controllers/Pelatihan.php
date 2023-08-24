<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PelatihanModel;

class Pelatihan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $PelatihanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->PelatihanModel = new PelatihanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pelatihan',
            'pelatihan' => $this->PelatihanModel->getPelatihan()
        ];

        return view('pelatihan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelatihan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('pelatihan/create', $data);
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
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih karyawan.'
                ]
            ],
            'tanggal_mulai_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_mulai_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_mulai_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'penyelenggara' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penyelenggara wajib diisi.'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'lokasi wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/pelatihan/create")->withInput();
        }

        $this->PelatihanModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['id'],
            'id_karyawan' => $this->request->getVar('nama'),
            'nama' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['nama'],
            'penyelenggara' => $this->request->getVar('penyelenggara'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_pelatihan' => $this->request->getVar('jenis_pelatihan'),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tingkat_pelatihan' => $this->request->getVar('tingkat_pelatihan'),
            'sertifikat' => $this->request->getVar('sertifikat')
        ]);

        return redirect()->to("/pelatihan");
    }

    public function delete($id)
    {
        $this->PelatihanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/pelatihan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pelatihan',
            'validation' => \Config\Services::validation(),
            'pelatihan' => $this->PelatihanModel->getPelatihan($id)
        ];
        return view('pelatihan/edit', $data);
    }

    public function update($id)
    {
        $pelatihan = $this->PelatihanModel->getPelatihan($id);

        $tanggal_mulai_hari = $this->request->getVar('tanggal_mulai_hari');
        $tanggal_mulai_bulan = $this->request->getVar('tanggal_mulai_bulan');
        $tanggal_mulai_tahun = $this->request->getVar('tanggal_mulai_tahun');
        $tanggal_mulai = "$tanggal_mulai_tahun-$tanggal_mulai_bulan-$tanggal_mulai_hari";

        $tanggal_selesai_hari = $this->request->getVar('tanggal_selesai_hari');
        $tanggal_selesai_bulan = $this->request->getVar('tanggal_selesai_bulan');
        $tanggal_selesai_tahun = $this->request->getVar('tanggal_selesai_tahun');
        $tanggal_selesai = "$tanggal_selesai_tahun-$tanggal_selesai_bulan-$tanggal_selesai_hari";

        if (!$this->validate([
            'tanggal_mulai_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_mulai_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_mulai_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'penyelenggara' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penyelenggara wajib diisi.'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'lokasi wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $pelatihan['id_pelatihan'];
            return redirect()->to("/pelatihan/edit/$idparam")->withInput();
        }

        $this->PelatihanModel->save([
            'id_pelatihan' => $id,
            'id' => $pelatihan['id'],
            'id_karyawan' => $pelatihan['id_karyawan'],
            'nama' => $pelatihan['nama'],
            'penyelenggara' => $this->request->getVar('penyelenggara'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_pelatihan' => $this->request->getVar('jenis_pelatihan'),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tingkat_pelatihan' => $this->request->getVar('tingkat_pelatihan'),
            'sertifikat' => $this->request->getVar('sertifikat')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/pelatihan');
    }
}

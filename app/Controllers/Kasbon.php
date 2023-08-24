<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KasbonModel;

class Kasbon extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $KasbonModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->KasbonModel = new KasbonModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Kasbon',
            'kasbon' => $this->KasbonModel->getkasbon()
        ];

        return view('kasbon/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kasbon',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('kasbon/create', $data);
    }

    public function save()
    {
        $tanggal_kasbon_hari = $this->request->getVar('tanggal_kasbon_hari');
        $tanggal_kasbon_bulan = $this->request->getVar('tanggal_kasbon_bulan');
        $tanggal_kasbon_tahun = $this->request->getVar('tanggal_kasbon_tahun');
        $tanggal_kasbon = "$tanggal_kasbon_tahun-$tanggal_kasbon_bulan-$tanggal_kasbon_hari";

        $tanggal_lunas_hari = $this->request->getVar('tanggal_lunas_hari');
        $tanggal_lunas_bulan = $this->request->getVar('tanggal_lunas_bulan');
        $tanggal_lunas_tahun = $this->request->getVar('tanggal_lunas_tahun');
        $tanggal_lunas = "$tanggal_lunas_tahun-$tanggal_lunas_bulan-$tanggal_lunas_hari";

        $jenisCicilan = $this->request->getVar('jenis_cicilan');
        $bayarCicilan = $this->request->getVar('bayar_cicilan');
        if ($bayarCicilan == '') {
            $bayarCicilan = 1;
        }
        $bayarTotal = $this->request->getVar('bayar_total');
        $jangkaWaktu = (float)$bayarTotal / (float)$bayarCicilan;

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib memilih karyawan.'
                ]
            ],
            'tanggal_kasbon_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_kasbon_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_kasbon_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'bayar_total' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah total kasbon wajib diisi.',
                    'numeric' => 'Jumlah total kasbon wajib berupa angka'
                ]
            ],
            'bayar_cicilan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah cicilan wajib diisi.',
                    'numeric' => 'Jumlah cicilan wajib berupa angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi.'
                ]
            ],
            'jenis_cicilan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis cicilan wajib diisi.'
                ]
            ]
        ])) {
            return redirect()->to("/kasbon/create")->withInput();
        }

        $this->KasbonModel->save([
            'id' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['id'],
            'id_karyawan' => $this->request->getVar('nama'),
            'nama' => $this->KaryawanModel->getKaryawanid($this->request->getVar('nama'))['nama'],
            'tanggal_kasbon' => $tanggal_kasbon,
            'tanggal_lunas' => $tanggal_lunas,
            'bayar_total' => $bayarTotal,
            'bayar_cicilan' => $bayarCicilan,
            'sudah_bayar' => $this->request->getVar('sudah_bayar'),
            'jenis_cicilan' => $jenisCicilan,
            'jangka_waktu' => $jangkaWaktu,
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        return redirect()->to("/kasbon");
    }

    public function delete($id)
    {
        $this->KasbonModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kasbon');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data kasbon',
            'validation' => \Config\Services::validation(),
            'kasbon' => $this->KasbonModel->getkasbon($id)
        ];
        return view('kasbon/edit', $data);
    }

    public function update($id)
    {
        $kasbon = $this->KasbonModel->getkasbon($id);

        $jenisCicilan = $this->request->getVar('jenis_cicilan');
        $bayarCicilan = $this->request->getVar('bayar_cicilan');
        if ($bayarCicilan == '') {
            $bayarCicilan = 1;
        }
        $bayarTotal = $this->request->getVar('bayar_total');
        $jangkaWaktu = (float)$bayarTotal / (float)$bayarCicilan;

        $tanggal_kasbon_hari = $this->request->getVar('tanggal_kasbon_hari');
        $tanggal_kasbon_bulan = $this->request->getVar('tanggal_kasbon_bulan');
        $tanggal_kasbon_tahun = $this->request->getVar('tanggal_kasbon_tahun');
        $tanggal_kasbon = "$tanggal_kasbon_tahun-$tanggal_kasbon_bulan-$tanggal_kasbon_hari";

        $tanggal_lunas_hari = $this->request->getVar('tanggal_lunas_hari');
        $tanggal_lunas_bulan = $this->request->getVar('tanggal_lunas_bulan');
        $tanggal_lunas_tahun = $this->request->getVar('tanggal_lunas_tahun');
        $tanggal_lunas = "$tanggal_lunas_tahun-$tanggal_lunas_bulan-$tanggal_lunas_hari";

        if (!$this->validate([
            'tanggal_kasbon_hari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Hari wajib diisi.'
                ]
            ],
            'tanggal_kasbon_bulan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan wajib diisi.'
                ]
            ],
            'tanggal_kasbon_tahun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun wajib diisi.'
                ]
            ],
            'bayar_total' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah total kasbon wajib diisi.',
                    'numeric' => 'Jumlah total kasbon wajib berupa angka'
                ]
            ],
            'bayar_cicilan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah cicilan wajib diisi.',
                    'numeric' => 'Jumlah cicilan wajib berupa angka'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi.'
                ]
            ],
            'jenis_cicilan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis cicilan wajib diisi.'
                ]
            ]
        ])) {
            $idparam = $kasbon['id_kasbon'];
            return redirect()->to("/kasbon/edit/$idparam")->withInput();
        }

        $this->KasbonModel->save([
            'id_kasbon' => $id,
            'id' => $kasbon['id'],
            'id_karyawan' => $kasbon['id_karyawan'],
            'nama' => $kasbon['nama'],
            'tanggal_kasbon' => $tanggal_kasbon,
            'tanggal_lunas' => $tanggal_lunas,
            'bayar_total' => $bayarTotal,
            'bayar_cicilan' => $bayarCicilan,
            'sudah_bayar' => $this->request->getVar('sudah_bayar'),
            'jenis_cicilan' => $jenisCicilan,
            'jangka_waktu' => $jangkaWaktu,
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kasbon');
    }
}

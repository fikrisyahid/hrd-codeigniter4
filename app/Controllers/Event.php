<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\EventModel;

class Event extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;
    protected $EventModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
        $this->EventModel = new EventModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar event',
            'event' => $this->EventModel->getevent()
        ];

        return view('event/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data event',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];
        return view('event/create', $data);
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
                    'required' => 'Nama wajib diisi'
                ]
            ],
            'pemasukan' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Pemasukan wajib berupa angka'
                ]
            ],
            'pengeluaran' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'pengeluaran wajib berupa angka'
                ]
            ]
        ])) {
            return redirect()->to("/event/create")->withInput();
        }

        if ($this->request->getVar('lokasi') == null) {
            $lokasi = 'Tidak diketahui';
        } else {
            $lokasi = $this->request->getVar('lokasi');
        }
        if ($this->request->getVar('pemasukan') == null) {
            $pemasukan = 0;
        } else {
            $pemasukan = $this->request->getVar('pemasukan');
        }
        if ($this->request->getVar('pengeluaran') == null) {
            $pengeluaran = 0;
        } else {
            $pengeluaran = $this->request->getVar('pengeluaran');
        }

        $this->EventModel->save([
            'nama' => $this->request->getVar('nama'),
            'tgl_mulai' => $tanggal_mulai,
            'tgl_selesai' => $tanggal_selesai,
            'lokasi' => $lokasi,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ]);

        return redirect()->to("/event");
    }

    public function delete($id)
    {
        $this->EventModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/event');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data event',
            'validation' => \Config\Services::validation(),
            'event' => $this->EventModel->getevent($id)
        ];
        return view('event/edit', $data);
    }

    public function update($id)
    {
        $event = $this->EventModel->getevent($id);

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
                    'required' => 'Nama wajib diisi'
                ]
            ],
            'pemasukan' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Pemasukan wajib berupa angka'
                ]
            ],
            'pengeluaran' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'pengeluaran wajib berupa angka'
                ]
            ]
        ])) {
            $idparam = $event['id_event'];
            return redirect()->to("/event/edit/$idparam")->withInput();
        }

        if ($this->request->getVar('lokasi') == null) {
            $lokasi = 'Tidak diketahui';
        } else {
            $lokasi = $this->request->getVar('lokasi');
        }
        if ($this->request->getVar('pemasukan') == null) {
            $pemasukan = 0;
        } else {
            $pemasukan = $this->request->getVar('pemasukan');
        }
        if ($this->request->getVar('pengeluaran') == null) {
            $pengeluaran = 0;
        } else {
            $pengeluaran = $this->request->getVar('pengeluaran');
        }

        $this->EventModel->save([
            'nama' => $this->request->getVar('nama'),
            'id' => $id,
            'tgl_mulai' => $tanggal_mulai,
            'tgl_selesai' => $tanggal_selesai,
            'lokasi' => $lokasi,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/event');
    }
}

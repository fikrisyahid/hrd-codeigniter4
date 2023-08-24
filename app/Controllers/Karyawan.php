<?php

namespace App\Controllers;

use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $KaryawanModel;

    public function __construct()
    {
        $this->KaryawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar karyawan',
            'karyawan' => $this->KaryawanModel->getKaryawanLast()
        ];

        return view('karyawan/index', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Detail karyawan',
            'karyawan' => $this->KaryawanModel->getKaryawan($id)
        ];

        if (empty($data['karyawan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Karyawan dengan id $id tidak dapat ditemukan");
        }

        return view('karyawan/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data karyawan',
            'validation' => \Config\Services::validation()
        ];
        return view('karyawan/create', $data);
    }

    public function save()
    {
        $id_karyawan = $this->request->getVar('id_karyawan');

        $tanggal_lahir_hari = $this->request->getVar('tanggal_lahir_hari');
        $tanggal_lahir_bulan = $this->request->getVar('tanggal_lahir_bulan');
        $tanggal_lahir_tahun = $this->request->getVar('tanggal_lahir_tahun');
        $tanggal_lahir = "$tanggal_lahir_tahun-$tanggal_lahir_bulan-$tanggal_lahir_hari";

        $tanggal_gabung_hari = $this->request->getVar('tanggal_gabung_hari');
        $tanggal_gabung_bulan = $this->request->getVar('tanggal_gabung_bulan');
        $tanggal_gabung_tahun = $this->request->getVar('tanggal_gabung_tahun');
        $tanggal_gabung = "$tanggal_gabung_tahun-$tanggal_gabung_bulan-$tanggal_gabung_hari";

        $tanggal_pk_hari = $this->request->getVar('tanggal_pk_hari');
        $tanggal_pk_bulan = $this->request->getVar('tanggal_pk_bulan');
        $tanggal_pk_tahun = $this->request->getVar('tanggal_pk_tahun');
        $tanggal_pk = "$tanggal_pk_tahun-$tanggal_pk_bulan-$tanggal_pk_hari";

        $tanggal_tes_covid_hari = $this->request->getVar('tanggal_tes_covid_hari');
        $tanggal_tes_covid_bulan = $this->request->getVar('tanggal_tes_covid_bulan');
        $tanggal_tes_covid_tahun = $this->request->getVar('tanggal_tes_covid_tahun');
        $tanggal_tes_covid = "$tanggal_tes_covid_tahun-$tanggal_tes_covid_bulan-$tanggal_tes_covid_hari";

        if (!$this->validate([
            'id_karyawan' => [
                'rules' => "required|numeric|min_length[4]|max_length[6]",
                'errors' => [
                    'required' => 'ID wajib diisi.',
                    'numeric' => 'ID harus berupa angka.',
                    'min_length' => 'ID harus 4-6 digit.',
                    'max_length' => 'ID harus 4-6 digit.'
                ]
            ],
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
            'foto_profil' => [
                'rules' => 'max_size[foto_profil,2048]|mime_in[foto_profil,image/png,image/jpg,image/jpeg]|is_image[foto_profil]',
                'errors' => [
                    'max_size' => 'Ukuran file tidak boleh lebih besar dari 2MB',
                    'mime_in' => 'File yang  diupload harus berupa gambar',
                    'is_image' => 'File yang diupload harus berupa gambar'
                ]
            ],
            'jumlah_anak' => [
                'rules' => "numeric",
                'errors' => [
                    'numeric' => 'Jumlah anak harus berupa angka.'
                ]
            ],
            'gaji' => [
                'rules' => "numeric",
                'errors' => [
                    'numeric' => 'Gaji harus berupa angka.'
                ]
            ]
        ])) {
            // Cek apakah ID sudah ada ketika nama masih kosong
            if ($this->KaryawanModel->getKaryawanid($id_karyawan)) {
                session()->setFlashdata('pesan', 'ID karyawan sudah terpakai.');
            }
            return redirect()->to('/karyawan/create')->withInput();
        }

        // Cek apakah ID sudah ada ketika nama terisi
        if ($this->KaryawanModel->getKaryawanid($id_karyawan)) {
            session()->setFlashdata('pesan', 'ID karyawan sudah terpakai.');
            return redirect()->to('/karyawan/create')->withInput();
        }

        // Mengecek apakah foto diinput atau tidak
        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil->getName() == '') {
            $namaFotoProfil = 'default.jpg';
        } else {
            $namaFotoProfil = $fotoProfil->getRandomName();
            $fotoProfil->move("img/foto_profil/", $namaFotoProfil);
        }

        $this->KaryawanModel->save([
            'id_karyawan' => $id_karyawan,
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => $this->request->getVar('agama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'alamat' => $this->request->getVar('alamat'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
            'jumlah_anak' => $this->request->getVar('jumlah_anak'),
            'tanggal_gabung' => $tanggal_gabung,
            'anak_perusahaan' => $this->request->getVar('anak_perusahaan'),
            'jenis_karyawan' => $this->request->getVar('jenis_karyawan'),
            'sk' => $this->request->getVar('sk'),
            'jabatan' => $this->request->getVar('jabatan'),
            'divisi' => $this->request->getVar('divisi'),
            'bagian' => $this->request->getVar('bagian'),
            'tanggal_pk' => $tanggal_pk,
            'keterampilan' => $this->request->getVar('keterampilan'),
            'tempat_tinggal' => $this->request->getVar('tempat_tinggal'),
            'bpjs_kesehatan' => $this->request->getVar('bpjs_kesehatan'),
            'bpjs_ketenagakerjaan' => $this->request->getVar('bpjs_ketenagakerjaan'),
            'status_covid' => $this->request->getVar('status_covid'),
            'tanggal_tes_covid' => $tanggal_tes_covid,
            'status_karyawan' => $this->request->getVar('status_karyawan'),
            'gaji' => $this->request->getVar('gaji'),
            'foto_profil' => $namaFotoProfil
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $this->KaryawanModel->delete_data($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/karyawan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data karyawan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->KaryawanModel->getKaryawan($id)
        ];
        return view('karyawan/edit', $data);
    }

    public function update($id)
    {
        $tanggal_lahir_hari = $this->request->getVar('tanggal_lahir_hari');
        $tanggal_lahir_bulan = $this->request->getVar('tanggal_lahir_bulan');
        $tanggal_lahir_tahun = $this->request->getVar('tanggal_lahir_tahun');
        $tanggal_gabung_hari = $this->request->getVar('tanggal_gabung_hari');
        $tanggal_gabung_bulan = $this->request->getVar('tanggal_gabung_bulan');
        $tanggal_gabung_tahun = $this->request->getVar('tanggal_gabung_tahun');

        $tanggal_lahir = "$tanggal_lahir_tahun-$tanggal_lahir_bulan-$tanggal_lahir_hari";
        $tanggal_gabung = "$tanggal_gabung_tahun-$tanggal_gabung_bulan-$tanggal_gabung_hari";

        $tanggal_pk_hari = $this->request->getVar('tanggal_pk_hari');
        $tanggal_pk_bulan = $this->request->getVar('tanggal_pk_bulan');
        $tanggal_pk_tahun = $this->request->getVar('tanggal_pk_tahun');
        $tanggal_pk = "$tanggal_pk_tahun-$tanggal_pk_bulan-$tanggal_pk_hari";

        $tanggal_tes_covid_hari = $this->request->getVar('tanggal_tes_covid_hari');
        $tanggal_tes_covid_bulan = $this->request->getVar('tanggal_tes_covid_bulan');
        $tanggal_tes_covid_tahun = $this->request->getVar('tanggal_tes_covid_tahun');
        $tanggal_tes_covid = "$tanggal_tes_covid_tahun-$tanggal_tes_covid_bulan-$tanggal_tes_covid_hari";

        $id_karyawan = $this->request->getVar('id_karyawan');
        $karyawan = $this->KaryawanModel->getKaryawan($id);
        $paramForReturn = $karyawan['id'];

        if (!$this->validate([
            'id_karyawan' => [
                'rules' => "required|numeric|min_length[4]|max_length[6]",
                'errors' => [
                    'required' => 'ID wajib diisi.',
                    'numeric' => 'ID harus berupa angka.',
                    'min_length' => 'ID harus 4-6 digit.',
                    'max_length' => 'ID harus 4-6 digit.'
                ]
            ],
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
            'foto_profil' => [
                'rules' => 'max_size[foto_profil,2048]|mime_in[foto_profil,image/png,image/jpg,image/jpeg]|is_image[foto_profil]',
                'errors' => [
                    'max_size' => 'Ukuran file tidak boleh lebih besar dari 2MB',
                    'mime_in' => 'File yang  diupload harus berupa gambar',
                    'is_image' => 'File yang diupload harus berupa gambar'
                ]
            ],
            'jumlah_anak' => [
                'rules' => "numeric",
                'errors' => [
                    'numeric' => 'Jumlah anak harus berupa angka.'
                ]
            ],
            'gaji' => [
                'rules' => "numeric",
                'errors' => [
                    'numeric' => 'Gaji harus berupa angka.'
                ]
            ]
        ])) {
            // Cek apakah ID sudah ada dan bukan ID yang sedang diedit ketika ada error validasi
            if ($karyawan['id_karyawan'] != $id_karyawan && $this->KaryawanModel->getKaryawan($id_karyawan) != null) {
                session()->setFlashdata('pesan', 'ID karyawan sudah terpakai.');
            }
            return redirect()->to("/karyawan/edit/$paramForReturn")->withInput();
        }

        // Cek apakah ID sudah ada dan bukan ID yang sedang diedit ketika tidak ada error validasi
        if ($karyawan['id_karyawan'] != $id_karyawan && $this->KaryawanModel->getKaryawan($id_karyawan) != null) {
            session()->setFlashdata('pesan', 'ID karyawan sudah terpakai.');
            return redirect()->to("/karyawan/edit/$paramForReturn")->withInput();
        }

        // Mengecek apakah foto diinput atau tidak
        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil->getName() == '') {
            $namaFotoProfil = $karyawan['foto_profil'];
        } else {
            $namaFotoProfil = $fotoProfil->getRandomName();
            $fotoProfil->move("img/foto_profil/", $namaFotoProfil);
        }

        $this->KaryawanModel->save([
            'id' => $karyawan['id'],
            'id_karyawan' => $id_karyawan,
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tanggal_lahir' => $tanggal_lahir,
            'agama' => $this->request->getVar('agama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'alamat' => $this->request->getVar('alamat'),
            'status_perkawinan' => $this->request->getVar('status_perkawinan'),
            'jumlah_anak' => $this->request->getVar('jumlah_anak'),
            'tanggal_gabung' => $tanggal_gabung,
            'anak_perusahaan' => $this->request->getVar('anak_perusahaan'),
            'jenis_karyawan' => $this->request->getVar('jenis_karyawan'),
            'sk' => $this->request->getVar('sk'),
            'tanggal_pk' => $tanggal_pk,
            'jabatan' => $this->request->getVar('jabatan'),
            'divisi' => $this->request->getVar('divisi'),
            'bagian' => $this->request->getVar('bagian'),
            'keterampilan' => $this->request->getVar('keterampilan'),
            'tempat_tinggal' => $this->request->getVar('tempat_tinggal'),
            'bpjs_kesehatan' => $this->request->getVar('bpjs_kesehatan'),
            'status_covid' => $this->request->getVar('status_covid'),
            'tanggal_tes_covid' => $tanggal_tes_covid,
            'status_karyawan' => $this->request->getVar('status_karyawan'),
            'gaji' => $this->request->getVar('gaji'),
            'foto_profil' => $namaFotoProfil
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/karyawan');
    }
}

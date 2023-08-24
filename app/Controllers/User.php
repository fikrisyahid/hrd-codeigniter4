<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\RekrutmenModel;

class User extends BaseController
{
	protected $KaryawanModel;
	protected $RekrutmenModel;

	public function __construct()
	{
		$this->KaryawanModel = new KaryawanModel();
		$this->RekrutmenModel = new RekrutmenModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'tanggal_gabung_asc' => $this->KaryawanModel->getKaryawanGabungFirst(),
			'tanggal_gabung_desc' => $this->KaryawanModel->getKaryawanGabungLast(),
			'karyawan_aktif' => $this->KaryawanModel->getKaryawanWhere('Aktif'),
			'karyawan_cuti' => $this->KaryawanModel->getKaryawanWhere('Cuti'),
			'karyawan_resign' => $this->KaryawanModel->getKaryawanWhere('Resign'),
			'rekrutmen_antri' => $this->RekrutmenModel->getRekrutmenWhere('Antri'),
			'rekrutmen_direkomendasikan' => $this->RekrutmenModel->getRekrutmenWhere('Direkomendasikan'),
			'rekrutmen_ditolak' => $this->RekrutmenModel->getRekrutmenWhere('Ditolak'),
		];
		return view('user/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Halaman Profile';
		return view('user/profil', $data);
	}

	public function biasalah()
	{
		return view('welcome_message');
	}
}

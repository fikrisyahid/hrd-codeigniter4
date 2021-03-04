<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data=[
			'title' => 'Beranda',
			'isi'	=> 'v_home',
		];
		echo view('layout/v_wrapper.php', $data);
	}

	public function dataPegawai()
	{
		$data=[
			'title' => 'Data Pegawai',
			'isi'	=> 'v_dataPegawai',
		];
		echo view('layout/v_wrapper.php', $data);
	}

	public function absensi()
	{
		$data=[
			'title' => 'Absensi Pegawai',
			'isi'	=> 'v_absensi',
		];
		echo view('layout/v_wrapper.php', $data);
	}

	public function gaji()
	{
		$data=[
			'title' => 'Gaji Pegawai',
			'isi'	=> 'v_gaji',
		];
		echo view('layout/v_wrapper.php', $data);
	}
}

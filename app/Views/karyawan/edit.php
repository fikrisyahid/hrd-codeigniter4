<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>

<?php
// Fungsi untuk output tanggal dan tahun
function angka($awal = 0, $akhir = 0)
{
  if ($awal < $akhir) {
    for ($x = $awal; $x <= $akhir; $x++) {
      echo "<option value='$x'>$x</option>";
    }
  } elseif ($awal > $akhir) {
    for ($x = $awal; $x >= $akhir; $x--) {
      echo "<option value='$x'>$x</option>";
    }
  } elseif ($awal == $akhir) {
    echo "<option value='$awal'>$awal</option>";
  }
}

function angkaWithSelected($awal = 0, $akhir = 0, $selectedValue = 0)
{
  if ($awal < $akhir) {
    for ($x = $awal; $x <= $akhir; $x++) {
      if ($x == $selectedValue) {
        echo "<option selected value='$x'>$x</option>";
      } else {
        echo "<option value='$x'>$x</option>";
      }
    }
  } elseif ($awal > $akhir) {
    for ($x = $awal; $x >= $akhir; $x--) {
      if ($x == $selectedValue) {
        echo "<option selected value='$x'>$x</option>";
      } else {
        echo "<option value='$x'>$x</option>";
      }
    }
  }
}

function bulanWithSelected($selectedValue = 0)
{
  $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  for ($x = 0; $x < 12; $x++) {
    $temp = $x + 1;
    if ($temp == $selectedValue) {
      echo "<option selected value='$temp'>$bulan[$x]</option>";
    } else {
      echo "<option value='$temp'>$bulan[$x]</option>";
    }
  }
}

// Format YYYY-MM-DD
// Format 0123456789
// YYYY = 04
// MM = 52
// DD = 82
$tanggal_lahir_hari = (int)substr($karyawan['tanggal_lahir'], 8, 2);
$tanggal_lahir_bulan = (int)substr($karyawan['tanggal_lahir'], 5, 2);
$tanggal_lahir_tahun = (int)substr($karyawan['tanggal_lahir'], 0, 4);

$tanggal_gabung_hari = (int)substr($karyawan['tanggal_gabung'], 8, 2);
$tanggal_gabung_bulan = (int)substr($karyawan['tanggal_gabung'], 5, 2);
$tanggal_gabung_tahun = (int)substr($karyawan['tanggal_gabung'], 0, 4);

$tanggal_pk_hari = (int)substr($karyawan['tanggal_pk'], 8, 2);
$tanggal_pk_bulan = (int)substr($karyawan['tanggal_pk'], 5, 2);
$tanggal_pk_tahun = (int)substr($karyawan['tanggal_pk'], 0, 4);

$tanggal_tes_covid_hari = (int)substr($karyawan['tanggal_tes_covid'], 8, 2);
$tanggal_tes_covid_bulan = (int)substr($karyawan['tanggal_tes_covid'], 5, 2);
$tanggal_tes_covid_tahun = (int)substr($karyawan['tanggal_tes_covid'], 0, 4);

if ($karyawan['foto_profil'] == '') {
  $foto_profil = 'default.jpg';
} else {
  $foto_profil = $karyawan['foto_profil'];
}

?>

<?php
$adaErrorValidasi = false;
$adaErrorID = false;
$validation->hasError('id_karyawan') ? $adaErrorValidasi = true : $adaErrorValidasi = false;
session()->getFlashdata('pesan') ? $adaErrorID = true : $adaErrorID = false;
?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Edit Data Karyawan</h1>
    <form action="/karyawan/update/<?= $karyawan['id'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-4">
          <label for="id_karyawan" class="col-sm-3 col-form-label">ID Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($adaErrorValidasi or $adaErrorID) ? 'is-invalid' : '' ?>" id="id_karyawan" name="id_karyawan" placeholder="Masukkan 4 digit angka" autofocus value="<?= $karyawan['id_karyawan'] ?>">
            <div class="invalid-feedback">
              <?php if ($adaErrorValidasi) : ?>
                <?= $validation->getError('id_karyawan') ?>
              <?php elseif ($adaErrorID) : ?>
                ID karyawan sudah terpakai.
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nik" class="col-sm-3 col-form-label">NIK</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" placeholder="Masukkan 16 digit angka" value="<?= $karyawan['nik'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nik') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= $karyawan['nama'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nama') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
          <div class="col-sm-9">
            <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
              <?php if ($karyawan['jenis_kelamin'] == 'Laki-laki') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Laki-laki" selected>Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              <?php elseif ($karyawan['jenis_kelamin'] == 'Perempuan') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan" selected>Perempuan</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
          <div class="col-sm-3">
            <select class="custom-select" id="tanggal_lahir_hari" name="tanggal_lahir_hari">
              <?php if ($tanggal_lahir_hari != 0) : ?>
                <?php angkaWithSelected(1, 31, $tanggal_lahir_hari); ?>
              <?php else : ?>
                <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3">
            <select class="custom-select" id="tanggal_lahir_bulan" name="tanggal_lahir_bulan">
              <?php if ($tanggal_lahir_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_lahir_bulan); ?>
              <?php else : ?>
                <option selected value="0">Bulan</option>
                <option value='1'>Januari</option>
                <option value='2'>Februari</option>
                <option value='3'>Maret</option>
                <option value='4'>April</option>
                <option value='5'>Mei</option>
                <option value='6'>Juni</option>
                <option value='7'>Juli</option>
                <option value='8'>Agustus</option>
                <option value='9'>September</option>
                <option value='10'>Oktober</option>
                <option value='11'>November</option>
                <option value='12'>Desember</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3">
            <select class="custom-select" id="tanggal_lahir_tahun" name="tanggal_lahir_tahun">
              <?php if ($tanggal_lahir_tahun != 0) : ?>
                <?php angkaWithSelected(2050, 1950, $tanggal_lahir_tahun); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
                <?php angka(2050, 1950); ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="agama">Agama</label>
          <div class="col-sm-5">
            <select class="custom-select" id="agama" name="agama">
              <?php if ($karyawan['agama'] == 'Islam') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php elseif ($karyawan['agama'] == 'Protestan') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option selected value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php elseif ($karyawan['agama'] == 'Katolik') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option selected value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php elseif ($karyawan['agama'] == 'Hindu') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option selected value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php elseif ($karyawan['agama'] == 'Budha') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option selected value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php elseif ($karyawan['agama'] == 'Konghucu') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option selected value="Konghucu">Konghucu</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Islam">Islam</option>
                <option value="Protestan">Protestan</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="gol_darah" class="col-sm-3 col-form-label">Golongan Darah</label>
          <div class="col-sm-5 mt-2">
            <select class="custom-select" id="gol_darah" name="gol_darah">
              <?php if ($karyawan['gol_darah'] == 'A') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
              <?php elseif ($karyawan['gol_darah'] == 'B') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="A">A</option>
                <option selected value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
              <?php elseif ($karyawan['gol_darah'] == 'O') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option selected value="O">O</option>
                <option value="AB">AB</option>
              <?php elseif ($karyawan['gol_darah'] == 'AB') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option selected value="AB">AB</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control" aria-label="With textarea" id="alamat" name="alamat" placeholder="Masukkan alamat"><?= $karyawan['alamat'] ?></textarea>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="status_perkawinan">Status Perkawinan</label>
          <div class="col-sm-9 mt-2">
            <select class="custom-select" id="status_perkawinan" name="status_perkawinan">
              <?php if ($karyawan['status_perkawinan'] == 'Lajang') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Lajang">Lajang</option>
                <option value="Menikah">Menikah</option>
              <?php elseif ($karyawan['status_perkawinan'] == 'Menikah') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Lajang">Lajang</option>
                <option selected value="Menikah">Menikah</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Lajang">Lajang</option>
                <option value="Menikah">Menikah</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="jumlah_anak" class="col-sm-3 col-form-label">Jumlah Anak</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->getError('jumlah_anak')) ? 'is-invalid' : '' ?>" id="jumlah_anak" name="jumlah_anak" placeholder="Masukkan jumlah anak (opsional)" value="<?= $karyawan['jumlah_anak'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('jumlah_anak') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_gabung" class="col-sm-3 col-form-label">Tanggal Gabung</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select" id="tanggal_gabung_hari" name="tanggal_gabung_hari">
              <?php if ($tanggal_gabung_hari != 0) : ?>
                <?php angkaWithSelected(1, 31, $tanggal_gabung_hari); ?>
              <?php else : ?>
                <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select" id="tanggal_gabung_bulan" name="tanggal_gabung_bulan">
              <?php if ($tanggal_gabung_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_gabung_bulan); ?>
              <?php else : ?>
                <option selected value="0">Bulan</option>
                <option value='1'>Januari</option>
                <option value='2'>Februari</option>
                <option value='3'>Maret</option>
                <option value='4'>April</option>
                <option value='5'>Mei</option>
                <option value='6'>Juni</option>
                <option value='7'>Juli</option>
                <option value='8'>Agustus</option>
                <option value='9'>September</option>
                <option value='10'>Oktober</option>
                <option value='11'>November</option>
                <option value='12'>Desember</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select" id="tanggal_gabung_tahun" name="tanggal_gabung_tahun">
              <?php if ($tanggal_gabung_tahun != 0) : ?>
                <?php angkaWithSelected(2050, 1950, $tanggal_gabung_tahun); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
                <?php angka(2050, 1950); ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="anak_perusahaan">Anak Perusahaan</label>
          <div class="col-sm-9">
            <select class="custom-select" id="anak_perusahaan" name="anak_perusahaan">
              <?php if ($karyawan['anak_perusahaan'] == 'PT. Asar Community') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option selected value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php elseif ($karyawan['anak_perusahaan'] == 'PT. Asar Humanity') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option selected value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php elseif ($karyawan['anak_perusahaan'] == 'PT. Giava Kalam Building') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option selected value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php elseif ($karyawan['anak_perusahaan'] == 'PT. Mega Amanah Bangsa') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option selected value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php elseif ($karyawan['anak_perusahaan'] == 'PT. Samara') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option selected value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php elseif ($karyawan['anak_perusahaan'] == 'PT. Graha Taman Sukabumi') : ?>
                <option value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option selected value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php else : ?>
                <option selected value="PT. Prima Duta Nusantara">PT. Prima Duta Nusantara</option>
                <option value="PT. Asar Community">PT. Asar Community</option>
                <option value="PT. Asar Humanity">PT. Asar Humanity</option>
                <option value="PT. Giava Kalam Building">PT. Giava Kalam Building</option>
                <option value="PT. Mega Amanah Bangsa">PT. Mega Amanah Bangsa</option>
                <option value="PT. Samara">PT. Samara</option>
                <option value="PT. Graha Taman Sukabumi">PT. Graha Taman Sukabumi</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="status_karyawan">Status Karyawan</label>
          <div class="col-sm-5 mt-2">
            <select class="custom-select" id="status_karyawan" name="status_karyawan">
              <?php if ($karyawan['status_karyawan'] == 'Cuti') : ?>
                <option value="Aktif">Aktif</option>
                <option selected value="Cuti">Cuti</option>
                <option value="Resign">Resign</option>
              <?php elseif ($karyawan['status_karyawan'] == 'Resign') : ?>
                <option value="Aktif">Aktif</option>
                <option value="Cuti">Cuti</option>
                <option selected value="Resign">Resign</option>
              <?php else : ?>
                <option selected value="Aktif">Aktif</option>
                <option value="Cuti">Cuti</option>
                <option value="Resign">Resign</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="foto_profil">Foto Profil</label>
          <div class="col-sm-2">
            <img src="/img/foto_profil/<?= $foto_profil ?>" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-7 mt-1">
            <div class="custom-file">
              <input class="custom-file-input <?= ($validation->hasError('foto_profil')) ? 'is-invalid' : ''; ?>" type="file" id="foto_profil" name="foto_profil" onchange="ubahpp()">
              <label class="custom-file-label" for="foto_profil"><?= $foto_profil ?></label>
              <div class="invalid-feedback">
                <?= $validation->getError('foto_profil') ?>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <button type="submit" class="btn btn-success" class="d-inline">Edit Data</button>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/karyawan/detail/<?= $karyawan['id'] ?>">Kembali ke detail karyawan</a>
          </div>
        </div>

      </div>

      <div class="col-sm-5 ml-5">

        <div class="form-group row my-3">
          <label for="jenis_karyawan" class="col-sm-3 col-form-label">Jenis Karyawan</label>
          <div class="col-sm-9 mt-2">
            <select class="custom-select" id="jenis_karyawan" name="jenis_karyawan">
              <?php if ($karyawan['jenis_karyawan'] == 'Harian') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Harian">Harian</option>
                <option value="Karyawan Tetap">Karyawan Tetap</option>
                <option value="Jangka Panjang">Jangka Panjang</option>
              <?php elseif ($karyawan['jenis_karyawan'] == 'Karyawan Tetap') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Harian">Harian</option>
                <option selected value="Karyawan Tetap">Karyawan Tetap</option>
                <option value="Jangka Panjang">Jangka Panjang</option>
              <?php elseif ($karyawan['jenis_karyawan'] == 'Jangka Panjang') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Harian">Harian</option>
                <option value="Karyawan Tetap">Karyawan Tetap</option>
                <option selected value="Jangka Panjang">Jangka Panjang</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Harian">Harian</option>
                <option value="Karyawan Tetap">Karyawan Tetap</option>
                <option value="Jangka Panjang">Jangka Panjang</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_pk" class="col-sm-3 col-form-label">Tanggal Penentuan Karyawan</label>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_pk_hari" name="tanggal_pk_hari">
              <?php if ($tanggal_pk_hari != 0) : ?>
                <?php angkaWithSelected(1, 31, $tanggal_pk_hari); ?>
              <?php else : ?>
                <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_pk_bulan" name="tanggal_pk_bulan">
              <?php if ($tanggal_pk_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_pk_bulan); ?>
              <?php else : ?>
                <option selected value="0">Bulan</option>
                <option value='1'>Januari</option>
                <option value='2'>Februari</option>
                <option value='3'>Maret</option>
                <option value='4'>April</option>
                <option value='5'>Mei</option>
                <option value='6'>Juni</option>
                <option value='7'>Juli</option>
                <option value='8'>Agustus</option>
                <option value='9'>September</option>
                <option value='10'>Oktober</option>
                <option value='11'>November</option>
                <option value='12'>Desember</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_pk_tahun" name="tanggal_pk_tahun">
              <?php if ($tanggal_pk_tahun != 0) : ?>
                <?php angkaWithSelected(2050, 1950, $tanggal_pk_tahun); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
                <?php angka(2050, 1950); ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="sk">SK</label>
          <div class="col-sm-5 mt-1">
            <select class="custom-select" id="sk" name="sk">
              <?php if ($karyawan['sk'] == 'Tidak Diketahui') : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php elseif ($karyawan['sk'] == 'Ya') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php elseif ($karyawan['sk'] == 'Tidak') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option selected value="Tidak">Tidak</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="jabatan">Jabatan</label>
          <div class="col-sm-7 mt-1">
            <select class="custom-select" id="jabatan" name="jabatan">
              <?php if ($karyawan['jabatan'] == 'Direktur') : ?>
                <option value="-">-</option>
                <option selected value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Kepala Divisi/General Manager') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option selected value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Kepala Bagian/Manager') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option selected value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Pengawas/Supervisor') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option selected value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Penanggung Jawab') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option selected value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Asisten PJ/Second Man') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option selected value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php elseif ($karyawan['jabatan'] == 'Staff') : ?>
                <option value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option selected value="Staff">Staff</option>
              <?php else : ?>
                <option selected value="-">-</option>
                <option value="Direktur">Direktur</option>
                <option value="Kepala Divisi/General Manager">Kepala Divisi / General Manager</option>
                <option value="Kepala Bagian/Manager">Kepala Bagian / Manager</option>
                <option value="Pengawas/Supervisor">Pengawas / Supervisor</option>
                <option value="Penanggung Jawab">Penanggung Jawab</option>
                <option value="Asisten PJ/Second Man">Asisten PJ / Second Man</option>
                <option value="Staff">Staff</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="divisi">Divisi</label>
          <div class="col-sm-6 mt-1">
            <select class="custom-select" id="divisi" name="divisi">
              <?php if ($karyawan['divisi'] == 'Operasional') : ?>
                <option value="-">-</option>
                <option selected value="Operasional">Operasional</option>
                <option value="Produksi">Produksi</option>
                <option value="Administrasi/Accounting">Administrasi / Accounting</option>
                <option value="Marketing">Marketing</option>
              <?php elseif ($karyawan['divisi'] == 'Produksi') : ?>
                <option value="-">-</option>
                <option value="Operasional">Operasional</option>
                <option selected value="Produksi">Produksi</option>
                <option value="Administrasi/Accounting">Administrasi / Accounting</option>
                <option value="Marketing">Marketing</option>
              <?php elseif ($karyawan['divisi'] == 'Administrasi/Accounting') : ?>
                <option value="-">-</option>
                <option value="Operasional">Operasional</option>
                <option value="Produksi">Produksi</option>
                <option selected value="Administrasi/Accounting">Administrasi / Accounting</option>
                <option value="Marketing">Marketing</option>
              <?php elseif ($karyawan['divisi'] == 'Marketing') : ?>
                <option value="-">-</option>
                <option value="Operasional">Operasional</option>
                <option value="Produksi">Produksi</option>
                <option value="Administrasi/Accounting">Administrasi / Accounting</option>
                <option selected value="Marketing">Marketing</option>
              <?php else : ?>
                <option selected value="-">-</option>
                <option value="Operasional">Operasional</option>
                <option value="Produksi">Produksi</option>
                <option value="Administrasi/Accounting">Administrasi / Accounting</option>
                <option value="Marketing">Marketing</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="bagian">Bagian</label>
          <div class="col-sm-4 mt-1">
            <select class="custom-select" id="bagian" name="bagian">
              <?php if ($karyawan['bagian'] == 'HRD&Umum') : ?>
                <option value="-">-</option>
                <option selected value="HRD&Umum">HRD & Umum</option>
                <option value="Kasir">Kasir</option>
                <option value="R&D">R&D</option>
              <?php elseif ($karyawan['bagian'] == 'Kasir') : ?>
                <option value="-">-</option>
                <option value="HRD&Umum">HRD & Umum</option>
                <option selected value="Kasir">Kasir</option>
                <option value="R&D">R&D</option>
              <?php elseif ($karyawan['bagian'] == 'R&D') : ?>
                <option value="-">-</option>
                <option value="HRD&Umum">HRD & Umum</option>
                <option value="Kasir">Kasir</option>
                <option selected value="R&D">R&D</option>
              <?php else : ?>
                <option selected value="-">-</option>
                <option value="HRD&Umum">HRD & Umum</option>
                <option value="Kasir">Kasir</option>
                <option value="R&D">R&D</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="keterampilan">Keterampilan</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control" aria-label="With textarea" id="keterampilan" name="keterampilan" placeholder="Masukkan keterampilan"><?= $karyawan['keterampilan'] ?></textarea>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="tempat_tinggal">Status Tempat Tinggal</label>
          <div class="col-sm-5 mt-2">
            <select class="custom-select" id="tempat_tinggal" name="tempat_tinggal">
              <?php if ($karyawan['tempat_tinggal'] == 'Tidak Diketahui') : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Milik Orang Tua">Milik Orang Tua</option>
                <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option value="Milik Pribadi">Milik Pribadi</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['tempat_tinggal'] == 'Milik Orang Tua') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Milik Orang Tua">Milik Orang Tua</option>
                <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option value="Milik Pribadi">Milik Pribadi</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['tempat_tinggal'] == 'Kontrak/Sewa') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Milik Orang Tua">Milik Orang Tua</option>
                <option selected value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option value="Milik Pribadi">Milik Pribadi</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['tempat_tinggal'] == 'Milik Pribadi') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Milik Orang Tua">Milik Orang Tua</option>
                <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option selected value="Milik Pribadi">Milik Pribadi</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['tempat_tinggal'] == 'Lainnya') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Milik Orang Tua">Milik Orang Tua</option>
                <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option value="Milik Pribadi">Milik Pribadi</option>
                <option selected value="Lainnya">Lainnya</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Milik Orang Tua">Milik Orang Tua</option>
                <option value="Kontrak/Sewa">Kontrak/Sewa</option>
                <option value="Milik Pribadi">Milik Pribadi</option>
                <option value="Lainnya">Lainnya</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="bpjs_kesehatan">BPJS Kesehatan</label>
          <div class="col-sm-5">
            <select class="custom-select" id="bpjs_kesehatan" name="bpjs_kesehatan">
              <?php if ($karyawan['bpjs_kesehatan'] == 'Tidak Diketahui') : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['bpjs_kesehatan'] == 'Kelas 1') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['bpjs_kesehatan'] == 'Kelas 2') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Kelas 1">Kelas 1</option>
                <option selected value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['bpjs_kesehatan'] == 'Kelas 3') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option selected value="Kelas 3">Kelas 3</option>
                <option value="Lainnya">Lainnya</option>
              <?php elseif ($karyawan['bpjs_kesehatan'] == 'Lainnya') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option selected value="Lainnya">Lainnya</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option value="Lainnya">Lainnya</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="bpjs_ketenagakerjaan">BPJS Ketenagakerjaan</label>
          <div class="col-sm-5 mt-2">
            <select class="custom-select" id="bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan">
              <?php if ($karyawan['bpjs_ketenagakerjaan'] == 'Tidak Diketahui') : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php elseif ($karyawan['bpjs_ketenagakerjaan'] == 'Ya') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php elseif ($karyawan['bpjs_ketenagakerjaan'] == 'Tidak') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option selected value="Tidak">Tidak</option>
              <?php else : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="status_covid">Status Covid</label>
          <div class="col-sm-5">
            <select class="custom-select" id="status_covid" name="status_covid">
              <?php if ($karyawan['status_covid'] == 'Tidak Diketahui') : ?>
                <option selected value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Positif">Positif</option>
                <option value="Negatif">Negatif</option>
                <option value="Sembuh">Sembuh</option>
              <?php elseif ($karyawan['status_covid'] == 'Positif') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option selected value="Positif">Positif</option>
                <option value="Negatif">Negatif</option>
                <option value="Sembuh">Sembuh</option>
              <?php elseif ($karyawan['status_covid'] == 'Negatif') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Positif">Positif</option>
                <option selected value="Negatif">Negatif</option>
                <option value="Sembuh">Sembuh</option>
              <?php elseif ($karyawan['status_covid'] == 'Sembuh') : ?>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Positif">Positif</option>
                <option value="Negatif">Negatif</option>
                <option selected value="Sembuh">Sembuh</option>
              <?php else : ?>
                <option disabled value="-" selected>Pilih</option>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
                <option value="Positif">Positif</option>
                <option value="Negatif">Negatif</option>
                <option value="Sembuh">Sembuh</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_tes_covid" class="col-sm-3 col-form-label">Tanggal Tes Covid</label>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_tes_covid_hari" name="tanggal_tes_covid_hari">
              <?php if ($tanggal_tes_covid_hari != 0) : ?>
                <?php angkaWithSelected(1, 31, $tanggal_tes_covid_hari); ?>
              <?php else : ?>
                <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_tes_covid_bulan" name="tanggal_tes_covid_bulan">
              <?php if ($tanggal_tes_covid_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_tes_covid_bulan); ?>
              <?php else : ?>
                <option selected value="0">Bulan</option>
                <option value='1'>Januari</option>
                <option value='2'>Februari</option>
                <option value='3'>Maret</option>
                <option value='4'>April</option>
                <option value='5'>Mei</option>
                <option value='6'>Juni</option>
                <option value='7'>Juli</option>
                <option value='8'>Agustus</option>
                <option value='9'>September</option>
                <option value='10'>Oktober</option>
                <option value='11'>November</option>
                <option value='12'>Desember</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select" id="tanggal_tes_covid_tahun" name="tanggal_tes_covid_tahun">
              <?php if ($tanggal_tes_covid_tahun != 0) : ?>
                <?php angkaWithSelected(2050, 1950, $tanggal_tes_covid_tahun); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
                <?php angka(2050, 1950); ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="gaji" class="col-sm-3 col-form-label">Gaji</label>
          <div class="col-sm-5">
            <input type="text" class="form-control <?= ($validation->hasError('gaji')) ? 'is-invalid' : ''; ?>" id="gaji" name="gaji" placeholder="Masukkan nominal" value="<?= $karyawan['gaji'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('gaji') ?>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
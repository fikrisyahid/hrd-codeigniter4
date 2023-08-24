<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>

<?php
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

$tanggal_mulai_hari = (int)substr($jabatan['tanggal_mulai'], 8, 2);
$tanggal_mulai_bulan = (int)substr($jabatan['tanggal_mulai'], 5, 2);
$tanggal_mulai_tahun = (int)substr($jabatan['tanggal_mulai'], 0, 4);

$tanggal_selesai_hari = (int)substr($jabatan['tanggal_selesai'], 8, 2);
$tanggal_selesai_bulan = (int)substr($jabatan['tanggal_selesai'], 5, 2);
$tanggal_selesai_tahun = (int)substr($jabatan['tanggal_selesai'], 0, 4);

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Edit Data Riwayat Jabatan</h1>
    <form action="/jabatan/update/<?= $jabatan['id_jabatan'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" id="nama" name="nama" value="<?= $jabatan['nama_karyawan'] ?>" readonly>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama_jabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama_jabatan')) ? 'is-invalid' : ''; ?>" id="nama_jabatan" name="nama_jabatan" placeholder="Masukkan nama jabatan" value="<?= $jabatan['nama_jabatan'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nama_jabatan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama_instansi')) ? 'is-invalid' : ''; ?>" id="nama_instansi" name="nama_instansi" placeholder="Masukkan nama instansi" value="<?= $jabatan['nama_instansi'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nama_instansi') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_hari') ? 'is-invalid' : '' ?>" id="tanggal_mulai_hari" name="tanggal_mulai_hari">
              <<?php if ($tanggal_mulai_hari != 0) : ?> <?php angkaWithSelected(1, 31, $tanggal_mulai_hari); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_mulai_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_bulan') ? 'is-invalid' : '' ?>" id="tanggal_mulai_bulan" name="tanggal_mulai_bulan">
              <?php if ($tanggal_mulai_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_mulai_bulan); ?>
              <?php else : ?>
                <option disabled selected value="0">Bulan</option>
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
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_mulai_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_tahun') ? 'is-invalid' : '' ?>" id="tanggal_mulai_tahun" name="tanggal_mulai_tahun">
              <?php if ($tanggal_mulai_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tanggal_mulai_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_mulai_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
          <div class="col-sm-3 mt-3">
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_hari') ? 'is-invalid' : '' ?>" id="tanggal_selesai_hari" name="tanggal_selesai_hari">
              <<?php if ($tanggal_selesai_hari != 0) : ?> <?php angkaWithSelected(1, 31, $tanggal_selesai_hari); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_selesai_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_bulan') ? 'is-invalid' : '' ?>" id="tanggal_selesai_bulan" name="tanggal_selesai_bulan">
              <?php if ($tanggal_selesai_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_selesai_bulan); ?>
              <?php else : ?>
                <option disabled selected value="0">Bulan</option>
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
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_selesai_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-3">
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_tahun') ? 'is-invalid' : '' ?>" id="tanggal_selesai_tahun" name="tanggal_selesai_tahun">
              <?php if ($tanggal_selesai_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tanggal_selesai_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_selesai_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <button type="submit" class="btn btn-success" class="d-inline">Edit Data</button>
            <a href="/jabatan/delete/<?= $jabatan['id_jabatan'] ?>" class="btn btn-danger ml-2">Hapus</a>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/jabatan">Kembali ke daftar jabatan</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
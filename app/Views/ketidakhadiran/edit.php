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

$tanggal_hari = (int)substr($ketidakhadiran['tanggal'], 8, 2);
$tanggal_bulan = (int)substr($ketidakhadiran['tanggal'], 5, 2);
$tanggal_tahun = (int)substr($ketidakhadiran['tanggal'], 0, 4);

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Edit Data Ketidakhadiran</h1>
    <form action="/ketidakhadiran/update/<?= $ketidakhadiran['id_ketidakhadiran'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" id="nama" name="nama" value="<?= $ketidakhadiran['nama'] ?>" readonly>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Ketidakhadiran</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_hari') ? 'is-invalid' : '' ?>" id="tanggal_hari" name="tanggal_hari">
              <<?php if ($tanggal_hari != 0) : ?> <?php angkaWithSelected(1, 31, $tanggal_hari); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_bulan') ? 'is-invalid' : '' ?>" id="tanggal_bulan" name="tanggal_bulan">
              <?php if ($tanggal_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_bulan); ?>
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
              <?= $validation->getError('tanggal_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_tahun') ? 'is-invalid' : '' ?>" id="tanggal_tahun" name="tanggal_tahun">
              <?php if ($tanggal_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tanggal_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="jenis" class="col-sm-3 col-form-label">Jenis Ketidakhadiran</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('jenis') ? 'is-invalid' : '' ?>" id="jenis" name="jenis">
              <?php if ($ketidakhadiran['jenis'] == 'Sakit') : ?>
                <option selected value='Sakit'>Sakit</option>
                <option value='Izin'>Izin</option>
                <option value='Alfa'>Alfa</option>
                <option value='Lainnya'>Lainnya</option>
              <?php elseif ($ketidakhadiran['jenis'] == 'Izin') : ?>
                <option value='Sakit'>Sakit</option>
                <option selected value='Izin'>Izin</option>
                <option value='Alfa'>Alfa</option>
                <option value='Lainnya'>Lainnya</option>
              <?php elseif ($ketidakhadiran['jenis'] == 'Alfa') : ?>
                <option value='Sakit'>Sakit</option>
                <option value='Izin'>Izin</option>
                <option selected value='Alfa'>Alfa</option>
                <option value='Lainnya'>Lainnya</option>
              <?php elseif ($ketidakhadiran['jenis'] == 'Lainnya') : ?>
                <option value='Sakit'>Sakit</option>
                <option value='Izin'>Izin</option>
                <option value='Alfa'>Alfa</option>
                <option selected value='Lainnya'>Lainnya</option>
              <?php else : ?>
                <option disabled selected>Pilih</option>
                <option value='Sakit'>Sakit</option>
                <option value='Izin'>Izin</option>
                <option value='Alfa'>Alfa</option>
                <option value='Lainnya'>Lainnya</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('jenis') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control" aria-label="With textarea" id="keterangan" name="keterangan" placeholder="Masukkan keterangan ketidakhadiran"><?= $ketidakhadiran['keterangan'] ?></textarea>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <button type="submit" class="btn btn-success" class="d-inline">Edit Data</button>
            <a href="/ketidakhadiran/delete/<?= $ketidakhadiran['id_ketidakhadiran'] ?>" class="btn btn-danger ml-2">Hapus</a>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/ketidakhadiran">Kembali ke daftar ketidakhadiran</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
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

$tanggal_kasbon_hari = (int)substr($kasbon['tanggal_kasbon'], 8, 2);
$tanggal_kasbon_bulan = (int)substr($kasbon['tanggal_kasbon'], 5, 2);
$tanggal_kasbon_tahun = (int)substr($kasbon['tanggal_kasbon'], 0, 4);

$tanggal_lunas_hari = (int)substr($kasbon['tanggal_lunas'], 8, 2);
$tanggal_lunas_bulan = (int)substr($kasbon['tanggal_lunas'], 5, 2);
$tanggal_lunas_tahun = (int)substr($kasbon['tanggal_lunas'], 0, 4);

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-4">Edit Data Kasbon</h1>
    <form action="/kasbon/update/<?= $kasbon['id_kasbon'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" id="nama" name="nama" value="<?= $kasbon['nama'] ?>" readonly>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_kasbon" class="col-sm-3 col-form-label">Tanggal Kasbon</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_kasbon_hari') ? 'is-invalid' : '' ?>" id="tanggal_kasbon_hari" name="tanggal_kasbon_hari">
              <<?php if ($tanggal_kasbon_hari != 0) : ?> <?php angkaWithSelected(1, 31, $tanggal_kasbon_hari); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_kasbon_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_kasbon_bulan') ? 'is-invalid' : '' ?>" id="tanggal_kasbon_bulan" name="tanggal_kasbon_bulan">
              <?php if ($tanggal_kasbon_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_kasbon_bulan); ?>
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
              <?= $validation->getError('tanggal_kasbon_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_kasbon_tahun') ? 'is-invalid' : '' ?>" id="tanggal_kasbon_tahun" name="tanggal_kasbon_tahun">
              <?php if ($tanggal_kasbon_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tanggal_kasbon_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_kasbon_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_lunas" class="col-sm-3 col-form-label">Tanggal Lunas</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_lunas_hari') ? 'is-invalid' : '' ?>" id="tanggal_lunas_hari" name="tanggal_lunas_hari">
              <<?php if ($tanggal_lunas_hari != 0) : ?> <?php angkaWithSelected(1, 31, $tanggal_lunas_hari); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_lunas_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_lunas_bulan') ? 'is-invalid' : '' ?>" id="tanggal_lunas_bulan" name="tanggal_lunas_bulan">
              <?php if ($tanggal_lunas_bulan != 0) : ?>
                <?php bulanWithSelected($tanggal_lunas_bulan); ?>
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
              <?= $validation->getError('tanggal_lunas_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_lunas_tahun') ? 'is-invalid' : '' ?>" id="tanggal_lunas_tahun" name="tanggal_lunas_tahun">
              <?php if ($tanggal_lunas_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tanggal_lunas_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0000">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_lunas_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="jenis_cicilan" class="col-sm-3 col-form-label">Jenis Cicilan</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('jenis_cicilan') ? 'is-invalid' : '' ?>" id="jenis_cicilan" name="jenis_cicilan">
              <?php if ($kasbon['jenis_cicilan'] == 'Bulanan') : ?>
                <option selected value='Bulanan'>Bulanan</option>
                <option value='Pekanan'>Pekanan</option>
              <?php elseif ($kasbon['jenis_cicilan'] == 'Pekanan') : ?>
                <option value='Bulanan'>Bulanan</option>
                <option selected value='Pekanan'>Pekanan</option>
              <?php else : ?>
                <option disabled selected>Pilih</option>
                <option value='Bulanan'>Bulanan</option>
                <option value='Pekanan'>Pekanan</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('jenis_cicilan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="bayar_total" class="col-sm-3 col-form-label">Jumlah Kasbon</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('bayar_total')) ? 'is-invalid' : ''; ?>" id="bayar_total" name="bayar_total" placeholder="Contoh : 1000000" value="<?= $kasbon['bayar_total'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('bayar_total') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="bayar_cicilan" class="col-sm-3 col-form-label">Cicilan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('bayar_cicilan')) ? 'is-invalid' : ''; ?>" id="bayar_cicilan" name="bayar_cicilan" placeholder="Contoh : 1000000" value="<?= $kasbon['bayar_cicilan'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('bayar_cicilan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="sudah_bayar" class="col-sm-3 col-form-label">Jumlah yang sudah dibayar</label>
          <div class="col-sm-9 mt-2">
            <input type="text" class="form-control" id="sudah_bayar" name="sudah_bayar" placeholder="Contoh : 1000000" value="<?= $kasbon['sudah_bayar'] ?>">
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control" aria-label="With textarea" id="keterangan" name="keterangan" placeholder="Masukkan keterangan kasbon"><?= $kasbon['keterangan'] ?></textarea>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="status" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('status') ? 'is-invalid' : '' ?>" id="status" name="status">
              <?php if ($kasbon['status'] == 'Belum Lunas') : ?>
                <option selected value='Belum Lunas'>Belum Lunas</option>
                <option value='Lunas'>Lunas</option>
              <?php elseif ($kasbon['status'] == 'Lunas') : ?>
                <option value='Belum Lunas'>Belum Lunas</option>
                <option selected value='Lunas'>Lunas</option>
              <?php else : ?>
                <option disabled selected>Pilih</option>
                <option value='Belum Lunas'>Belum Lunas</option>
                <option value='Lunas'>Lunas</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('status') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <button type="submit" class="btn btn-success" class="d-inline">Edit Data</button>
            <a href="/kasbon/delete/<?= $kasbon['id_kasbon'] ?>" class="btn btn-danger ml-2">Hapus</a>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/kasbon">Kembali ke daftar kasbon</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
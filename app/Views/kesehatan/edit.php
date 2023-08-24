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

$tahun_sakit = (int)substr($kesehatan['tahun_sakit'], 0, 4);
$tahun_sembuh = (int)substr($kesehatan['tahun_sembuh'], 0, 4);

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Edit Data Riwayat Kesehatan</h1>
    <form action="/kesehatan/update/<?= $kesehatan['id_kesehatan'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" id="nama" name="nama" value="<?= $kesehatan['nama_karyawan'] ?>" readonly>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama_penyakit" class="col-sm-3 col-form-label">Nama Penyakit</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama_penyakit')) ? 'is-invalid' : ''; ?>" id="nama_penyakit" name="nama_penyakit" placeholder="Masukkan nama penyakit" value="<?= $kesehatan['nama_penyakit'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nama_penyakit') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tahun_sakit" class="col-sm-3 col-form-label">Tahun Sakit</label>
          <div class="col-sm-4 mt-2">
            <select class="custom-select <?= $validation->hasError('tahun_sakit') ? 'is-invalid' : '' ?>" id="tahun_sakit" name="tahun_sakit">
              <?php if ($tahun_sakit != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tahun_sakit); ?>
              <?php else : ?>
                <option disabled selected value="0">Pilih</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tahun_sakit') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tahun_sembuh" class="col-sm-3 col-form-label">Tahun sembuh</label>
          <div class="col-sm-4 mt-2">
            <select class="custom-select <?= $validation->hasError('tahun_sembuh') ? 'is-invalid' : '' ?>" id="tahun_sembuh" name="tahun_sembuh">
              <?php if ($tahun_sembuh != 0) : ?>
                <option value="0000">Belum Sembuh</option>
                <?php angkaWithSelected(2021, 1950, $tahun_sembuh); ?>
              <?php else : ?>
                <option selected value="0000">Belum Sembuh</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tahun_sembuh') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="status" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-4 mt-2">
            <select class="custom-select <?= $validation->hasError('status') ? 'is-invalid' : '' ?>" id="status" name="status">
              <?php if ($kesehatan['status'] == 'Sembuh') : ?>
                <option selected value='Sembuh'>Sembuh</option>
                <option value='Sakit'>Sakit</option>
              <?php elseif ($kesehatan['status'] == 'Sakit') : ?>
                <option value='Sembuh'>Sembuh</option>
                <option selected value='Sakit'>Sakit</option>
              <?php else : ?>
                <option disabled selected>Pilih</option>
                <option value='Sembuh'>Sembuh</option>
                <option value='Sakit'>Sakit</option>
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
            <a href="/kesehatan/delete/<?= $kesehatan['id_kesehatan'] ?>" class="btn btn-danger ml-2">Hapus</a>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/kesehatan">Kembali ke daftar kesehatan</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
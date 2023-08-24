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

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Tambah Data Riwayat Pendidikan</h1>
    <form action="/pendidikan/save" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">
        <div class="form-group row my-3">
          <label for="nama_karyawan" class="col-sm-3 col-form-label">Nama Karyawan</label>
          <div class="col-sm-9">
            <select class="custom-select <?= $validation->hasError('nama_karyawan') ? 'is-invalid' : '' ?>" id="nama_karyawan" name="nama_karyawan">
              <option selected disabled>Pilih Karyawan</option>
              <?php
              for ($x = 0; $x < count($karyawan); $x++) {
                $nama = $karyawan[$x]['nama'];
                $id_karyawan = $karyawan[$x]['id_karyawan'];
                echo ("<option value='$id_karyawan'>$nama - $id_karyawan</option>");
              }
              ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_karyawan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tingkat_pendidikan" class="col-sm-3 col-form-label">Tingkat pendidikan</label>
          <div class="col-sm-9">
            <select class="custom-select <?= $validation->hasError('tingkat_pendidikan') ? 'is-invalid' : '' ?>" id="tingkat_pendidikan" name="tingkat_pendidikan">
              <?php if (old('tingkat_pendidikan') == 'Non-Formal') : ?>
                <option selected value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'SD/Mi') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option selected value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'SMP/MTs') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option selected value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'SLTA Sederajat') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option selected value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'S1') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option selected value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'S2') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option selected value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php elseif (old('tingkat_pendidikan') == 'S3') : ?>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option selected value='S3'>S3</option>
              <?php else : ?>
                <option selected value=''>Pilih</option>
                <option value='Non-Formal'>Non-Formal</option>
                <option value='SD/Mi'>SD/Mi</option>
                <option value='SMP/MTs'>SMP/MTs</option>
                <option value='SLTA Sederajat'>SLTA Sederajat</option>
                <option value='S1'>S1</option>
                <option value='S2'>S2</option>
                <option value='S3'>S3</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tingkat_pendidikan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama_instansi')) ? 'is-invalid' : ''; ?>" id="nama_instansi" name="nama_instansi" placeholder="Masukkan nama instansi" value="<?= old('nama_instansi') ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nama_instansi') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tahun_masuk') ? 'is-invalid' : '' ?>" id="tahun_masuk" name="tahun_masuk">
              <?php if (old('tahun_masuk') != 0) : ?>
                <?php angkaWithSelected(2021, 1950, old('tahun_masuk')); ?>
              <?php else : ?>
                <option disabled selected value="0000">Pilih</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tahun_masuk') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tahun_lulus') ? 'is-invalid' : '' ?>" id="tahun_lulus" name="tahun_lulus">
              <?php if (old('tahun_lulus') != 0) : ?>
                <?php angkaWithSelected(2021, 1950, old('tahun_lulus')); ?>
              <?php else : ?>
                <option disabled selected value="0000">Pilih</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tahun_lulus') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nilai_akhir" class="col-sm-3 col-form-label">Nilai Akhir</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nilai_akhir')) ? 'is-invalid' : ''; ?>" id="nilai_akhir" name="nilai_akhir" placeholder="Contoh : UN 40 atau IPK 3.61" value="<?= old('nilai_akhir') ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nilai_akhir') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <button type="submit" class="btn btn-success" class="d-inline">Tambah Data</button>
          </div>
        </div>

        <div class="form-group row my-3">
          <div class="col">
            <a href="/pendidikan">Kembali ke daftar pendidikan</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>
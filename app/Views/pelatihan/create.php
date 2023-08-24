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
    <h1 class="row mt-5">Tambah Data Pelatihan</h1>
    <form action="/pelatihan/save" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">
        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <select class="custom-select <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama">
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
              <?= $validation->getError('nama') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="penyelenggara" class="col-sm-3 col-form-label">Penyelenggara</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('penyelenggara')) ? 'is-invalid' : ''; ?>" id="penyelenggara" name="penyelenggara" placeholder="Masukkan penyelenggara" value="<?= old('penyelenggara') ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('penyelenggara') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="lokasi">Lokasi</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control <?= ($validation->hasError('penyelenggara')) ? 'is-invalid' : ''; ?>" aria-label="With textarea" id="lokasi" name="lokasi" placeholder="Masukkan lokasi"><?= old('lokasi') ?></textarea>
            <div class="invalid-feedback">
              <?= $validation->getError('lokasi') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="jenis_pelatihan" class="col-sm-3 col-form-label">Jenis Pelatihan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('jenis_pelatihan')) ? 'is-invalid' : ''; ?>" id="jenis_pelatihan" name="jenis_pelatihan" placeholder="Masukkan jenis pelatihan" value="<?= old('jenis_pelatihan') ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('jenis_pelatihan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_hari') ? 'is-invalid' : '' ?>" id="tanggal_mulai_hari" name="tanggal_mulai_hari">
              <<?php if (old('tanggal_mulai_hari') != 0) : ?> <?php angkaWithSelected(1, 31, old('tanggal_mulai_hari')); ?> <?php else : ?> <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_mulai_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_bulan') ? 'is-invalid' : '' ?>" id="tanggal_mulai_bulan" name="tanggal_mulai_bulan">
              <?php if (old('tanggal_mulai_bulan') != 0) : ?>
                <?php bulanWithSelected(old('tanggal_mulai_bulan')); ?>
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
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_mulai_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_mulai_tahun') ? 'is-invalid' : '' ?>" id="tanggal_mulai_tahun" name="tanggal_mulai_tahun">
              <?php if (old('tanggal_mulai_tahun') != 0) : ?>
                <?php angkaWithSelected(2021, 1950, old('tanggal_mulai_tahun')); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
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
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_hari') ? 'is-invalid' : '' ?>" id="tanggal_selesai_hari" name="tanggal_selesai_hari">
              <<?php if (old('tanggal_selesai_hari') != 0) : ?> <?php angkaWithSelected(1, 31, old('tanggal_selesai_hari')); ?> <?php else : ?> <option selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_bulan') ? 'is-invalid' : '' ?>" id="tanggal_selesai_bulan" name="tanggal_selesai_bulan">
              <?php if (old('tanggal_selesai_bulan') != 0) : ?>
                <?php bulanWithSelected(old('tanggal_selesai_bulan')); ?>
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
            <select class="custom-select <?= $validation->hasError('tanggal_selesai_tahun') ? 'is-invalid' : '' ?>" id="tanggal_selesai_tahun" name="tanggal_selesai_tahun">
              <?php if (old('tanggal_selesai_tahun') != 0) : ?>
                <?php angkaWithSelected(2021, 1950, old('tanggal_selesai_tahun')); ?>
              <?php else : ?>
                <option selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tingkat_pelatihan" class="col-sm-3 col-form-label">Tingkat Pelatihan</label>
          <div class="col-sm-4 mt-2">
            <select class="custom-select" id="tingkat_pelatihan" name="tingkat_pelatihan">
              <?php if (old('tingkat_pelatihan') == 'Tingkat 1') : ?>
                <option value='-'>-</option>
                <option selected value='Tingkat 1'>Tingkat 1</option>
                <option value='Tingkat 2'>Tingkat 2</option>
                <option value='Tingkat 3'>Tingkat 3</option>
                <option value='Tingkat 4'>Tingkat 4</option>
              <?php elseif (old('tingkat_pelatihan') == 'Tingkat 2') : ?>
                <option value='-'>-</option>
                <option value='Tingkat 1'>Tingkat 1</option>
                <option selected value='Tingkat 2'>Tingkat 2</option>
                <option value='Tingkat 3'>Tingkat 3</option>
                <option value='Tingkat 4'>Tingkat 4</option>
              <?php elseif (old('tingkat_pelatihan') == 'Tingkat 3') : ?>
                <option value='-'>-</option>
                <option value='Tingkat 1'>Tingkat 1</option>
                <option value='Tingkat 2'>Tingkat 2</option>
                <option selected value='Tingkat 3'>Tingkat 3</option>
                <option value='Tingkat 4'>Tingkat 4</option>
              <?php elseif (old('tingkat_pelatihan') == 'Tingkat 4') : ?>
                <option value='-'>-</option>
                <option value='Tingkat 1'>Tingkat 1</option>
                <option value='Tingkat 2'>Tingkat 2</option>
                <option value='Tingkat 3'>Tingkat 3</option>
                <option selected value='Tingkat 4'>Tingkat 4</option>
              <?php else : ?>
                <option selected value='-'>-</option>
                <option value='Tingkat 1'>Tingkat 1</option>
                <option value='Tingkat 2'>Tingkat 2</option>
                <option value='Tingkat 3'>Tingkat 3</option>
                <option value='Tingkat 4'>Tingkat 4</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="sertifikat" class="col-sm-3 col-form-label">Sertifikat</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('sertifikat') ? 'is-invalid' : '' ?>" id="sertifikat" name="sertifikat">
              <?php if (old('sertifikat') == 'Ya') : ?>
                <option value='-'>-</option>
                <option selected value='Ya'>Ya</option>
                <option value='Tidak'>Tidak</option>
              <?php elseif (old('sertifikat') == 'Tidak') : ?>
                <option value='-'>-</option>
                <option selected value='Ya'>Ya</option>
                <option value='Tidak'>Tidak</option>
              <?php else : ?>
                <option selected value='-'>-</option>
                <option value='Ya'>Ya</option>
                <option value='Tidak'>Tidak</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('sertifikat') ?>
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
            <a href="/pelatihan">Kembali ke daftar pelatihan</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>
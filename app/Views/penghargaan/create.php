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
    <h1 class="row mt-5">Tambah Data Penghargaan</h1>
    <form action="/penghargaan/save" method="post" enctype="multipart/form-data" class="row">

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
          <label for="tanggal" class="col-sm-3 col-form-label">Tanggal diberikan</label>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_hari') ? 'is-invalid' : '' ?>" id="tanggal_hari" name="tanggal_hari">
              <<?php if (old('tanggal_hari') != 0) : ?> <?php angkaWithSelected(1, 31, old('tanggal_hari')); ?> <?php else : ?> <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_hari') ?>
            </div>
          </div>
          <div class="col-sm-3 mt-2">
            <select class="custom-select <?= $validation->hasError('tanggal_bulan') ? 'is-invalid' : '' ?>" id="tanggal_bulan" name="tanggal_bulan">
              <?php if (old('tanggal_bulan') != 0) : ?>
                <?php bulanWithSelected(old('tanggal_bulan')); ?>
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
              <?php if (old('tanggal_tahun') != 0) : ?>
                <?php angkaWithSelected(2021, 1950, old('tanggal_tahun')); ?>
              <?php else : ?>
                <option disabled selected value="0000">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="jenis_penghargaan" class="col-sm-3 col-form-label">Jenis Penghargaan</label>
          <div class="col-sm-5 mt-2">
            <select class="custom-select <?= $validation->hasError('jenis_penghargaan') ? 'is-invalid' : '' ?>" id="jenis_penghargaan" name="jenis_penghargaan">
              <?php if (old('jenis_penghargaan') == 'Kenaikan Gaji') : ?>
                <option value='Lainnya'>Lainnya</option>
                <option selected value='Kenaikan Gaji'>Kenaikan Gaji</option>
                <option value='Kenaikan Jabatan'>Kenaikan Jabatan</option>
                <option value='Gratifikasi'>Gratifikasi</option>
                <option value='Insentif'>Insentif</option>
              <?php elseif (old('jenis_penghargaan') == 'Kenaikan Jabatan') : ?>
                <option value='Lainnya'>Lainnya</option>
                <option value='Kenaikan Gaji'>Kenaikan Gaji</option>
                <option selected value='Kenaikan Jabatan'>Kenaikan Jabatan</option>
                <option value='Gratifikasi'>Gratifikasi</option>
                <option value='Insentif'>Insentif</option>
              <?php elseif (old('jenis_penghargaan') == 'Gratifikasi') : ?>
                <option value='Lainnya'>Lainnya</option>
                <option value='Kenaikan Gaji'>Kenaikan Gaji</option>
                <option value='Kenaikan Jabatan'>Kenaikan Jabatan</option>
                <option selected value='Gratifikasi'>Gratifikasi</option>
                <option value='Insentif'>Insentif</option>
              <?php elseif (old('jenis_penghargaan') == 'Insentif') : ?>
                <option value='Lainnya'>Lainnya</option>
                <option value='Kenaikan Gaji'>Kenaikan Gaji</option>
                <option value='Kenaikan Jabatan'>Kenaikan Jabatan</option>
                <option value='Gratifikasi'>Gratifikasi</option>
                <option selected value='Insentif'>Insentif</option>
              <?php else : ?>
                <option selected value='Lainnya'>Lainnya</option>
                <option value='Kenaikan Gaji'>Kenaikan Gaji</option>
                <option value='Kenaikan Jabatan'>Kenaikan Jabatan</option>
                <option value='Gratifikasi'>Gratifikasi</option>
                <option value='Insentif'>Insentif</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('jenis_penghargaan') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
          <div class="col-sm-9 mt-2">
            <textarea class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : '' ?>" aria-label="With textarea" id="keterangan" name="keterangan" placeholder="Masukkan alasan penghargaan"><?= old('keterangan') ?></textarea>
            <div class="invalid-feedback">
              <?= $validation->getError('keterangan') ?>
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
            <a href="/penghargaan">Kembali ke daftar penghargaan</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>
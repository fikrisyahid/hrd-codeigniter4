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

$tgl_apply_hari = (int)substr($rekrutmen['tgl_apply'], 8, 2);
$tgl_apply_bulan = (int)substr($rekrutmen['tgl_apply'], 5, 2);
$tgl_apply_tahun = (int)substr($rekrutmen['tgl_apply'], 0, 4);

?>

<div class="container-fluid">
  <div class="row-fluid ml-4">
    <h1 class="row mt-5">Edit Data Rekrutmen</h1>
    <form action="/rekrutmen/update/<?= $rekrutmen['id'] ?>" method="post" enctype="multipart/form-data" class="row">

      <?= csrf_field(); ?>

      <div class="col-sm-5">

        <div class="form-group row my-3">
          <label for="nik" class="col-sm-3 col-form-label">NIK</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" placeholder="Masukkan 16 digit angka" value="<?= $rekrutmen['nik'] ?>">
            <div class="invalid-feedback">
              <?= $validation->getError('nik') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= $rekrutmen['nama'] ?>" placeholder="Masukkan nama">
            <div class="invalid-feedback">
              <?= $validation->getError('nama') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
          <div class="col-sm-9">
            <select class="custom-select <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
              <?php if ($rekrutmen['jenis_kelamin'] == 'Laki-laki') : ?>
                <option value="Laki-laki" selected>Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              <?php elseif ($rekrutmen['jenis_kelamin'] == 'Perempuan') : ?>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan" selected>Perempuan</option>
              <?php else : ?>
                <option disabled selected>Pilih </option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('jenis_kelamin') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="tgl_apply" class="col-sm-3 col-form-label">Tanggal Apply</label>
          <div class="col-sm-3">
            <select class="custom-select <?= ($validation->hasError('tgl_apply_hari')) ? 'is-invalid' : ''; ?>" id="tgl_apply_hari" name="tgl_apply_hari">
              <?php if ($tgl_apply_hari != 0) : ?>
                <?php angkaWithSelected(1, 31, $tgl_apply_hari); ?>
              <?php else : ?>
                <option disabled selected value="0">Hari</option>
                <?php angka(1, 31); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tgl_apply_hari') ?>
            </div>
          </div>
          <div class="col-sm-3">
            <select class="custom-select <?= ($validation->hasError('tgl_apply_bulan')) ? 'is-invalid' : ''; ?>" id="tgl_apply_bulan" name="tgl_apply_bulan">
              <?php if ($tgl_apply_bulan != 0) : ?>
                <?php bulanWithSelected($tgl_apply_bulan); ?>
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
              <?= $validation->getError('tgl_apply_bulan') ?>
            </div>
          </div>
          <div class="col-sm-3">
            <select class="custom-select <?= ($validation->hasError('tgl_apply_tahun')) ? 'is-invalid' : ''; ?>" id="tgl_apply_tahun" name="tgl_apply_tahun">
              <?php if ($tgl_apply_tahun != 0) : ?>
                <?php angkaWithSelected(2021, 1950, $tgl_apply_tahun); ?>
              <?php else : ?>
                <option disabled selected value="0">Tahun</option>
                <?php angka(2021, 1950); ?>
              <?php endif; ?>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('tgl_apply_tahun') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
          <div class="col-sm-9 mt-2">
            <input type="text" class="form-control <?= ($validation->hasError('pendidikan_terakhir')) ? 'is-invalid' : ''; ?>" id="pendidikan_terakhir" name="pendidikan_terakhir" value="<?= $rekrutmen['pendidikan_terakhir'] ?>" placeholder="Contoh : SMAN 4 Tangsel">
            <div class="invalid-feedback">
              <?= $validation->getError('pendidikan_terakhir') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="nilai_akhir" class="col-sm-3 col-form-label">Nilai Akhir</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('nilai_akhir')) ? 'is-invalid' : ''; ?>" id="nilai_akhir" name="nilai_akhir" value="<?= $rekrutmen['nilai_akhir'] ?>" placeholder="Contoh : UN 40 atau IPK 3.8">
            <div class="invalid-feedback">
              <?= $validation->getError('nilai_akhir') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="email" name="email" value="<?= $rekrutmen['email'] ?>" placeholder="Masukkan email">
          </div>
        </div>

        <div class="form-group row my-3">
          <label for="no_tlfn" class="col-sm-3 col-form-label">No. Telepon</label>
          <div class="col-sm-9">
            <input type="text" class="form-control <?= ($validation->hasError('no_tlfn')) ? 'is-invalid' : ''; ?>" id="no_tlfn" name="no_tlfn" value="<?= $rekrutmen['no_tlfn'] ?>" placeholder="Masukkan nomor yang dapat dihubungi">
            <div class="invalid-feedback">
              <?= $validation->getError('no_tlfn') ?>
            </div>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="status">Status</label>
          <div class="col-sm-5">
            <select class="custom-select" id="status" name="status">
              <?php if ($rekrutmen['status'] == 'Direkomendasikan') : ?>
                <option value="Antri">Antri</option>
                <option selected value="Direkomendasikan">Direkomendasikan</option>
                <option value="Ditolak">Ditolak</option>
              <?php elseif ($rekrutmen['status'] == 'Ditolak') : ?>
                <option value="Antri">Antri</option>
                <option value="Direkomendasikan">Direkomendasikan</option>
                <option selected value="Ditolak">Ditolak</option>
              <?php else : ?>
                <option selected value="Antri">Antri</option>
                <option value="Direkomendasikan">Direkomendasikan</option>
                <option value="Ditolak">Ditolak</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group row my-3">
          <label class="col-sm-3 col-form-label" for="foto_profil">Foto Profil</label>
          <div class="col-sm-2">
            <img src="/img/foto_profil_rekrutmen/<?= $rekrutmen['foto_profil'] ?>" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-7 mt-1">
            <div class="custom-file">
              <input class="custom-file-input <?= ($validation->hasError('foto_profil')) ? 'is-invalid' : ''; ?>" type="file" id="foto_profil" name="foto_profil" onchange="ubahpp()">
              <input type="hidden" class="spy" value="<?= $rekrutmen['foto_profil'] ?>" name="pp">
              <label class="custom-file-label" for="foto_profil"><?= $rekrutmen['foto_profil'] ?></label>
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
            <a href="/rekrutmen">Kembali ke daftar rekrutmen</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
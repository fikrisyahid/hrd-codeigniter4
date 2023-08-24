<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>

<?php

function getBulan($a)
{
  $bulan = array('0', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  return $bulan[$a];
}

$tanggal_apply_hari = (int)substr($rekrutmen['tgl_apply'], 8, 2);
$tanggal_apply_bulan = (int)substr($rekrutmen['tgl_apply'], 5, 2);
$tanggal_apply_tahun = (int)substr($rekrutmen['tgl_apply'], 0, 4);
$bulan_apply = getBulan($tanggal_apply_bulan);
if ($bulan_apply == '0') {
  $tanggal_apply = 'Tidak diketahui';
} else {
  $tanggal_apply = (string)$tanggal_apply_hari . " " . $bulan_apply . " " . (string)$tanggal_apply_tahun;
}

?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-4">Detail Rekrutmen</h1>

      <div class="card-fluid">
        <div class="row">
          <div class="col-md-3 mt-3">
            <img src="/img/foto_profil_rekrutmen/<?= ($rekrutmen['foto_profil'] == '') ? 'default.jpg' : $rekrutmen['foto_profil'] ?>" alt="Foto Profil <?= $rekrutmen['nama'] ?>" class="card-img">
          </div>
          <div class="col">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title mb-4">NIK : <?= $rekrutmen['nik'] ?></h5>
                  <h5 class="card-title mb-4">Nama : <?= $rekrutmen['nama'] ?></h5>
                  <h5 class="card-title mb-4">Jenis Kelamin : <?= $rekrutmen['jenis_kelamin'] ?> </h5>
                  <h5 class="card-title mb-4">Tanggal Apply : <?= $tanggal_apply ?> </h5>
                  <h5 class="card-title mb-4">Pendidikan Terakhir : <?= $rekrutmen['pendidikan_terakhir'] ?> </h5>
                  <h5 class="card-title mb-4">Nilai Akhir : <?= $rekrutmen['nilai_akhir'] ?> </h5>
                  <h5 class="card-title mb-4">E-mail : <?= $rekrutmen['email'] ?> </h5>
                  <h5 class="card-title mb-4">No. Telepon : <?= $rekrutmen['no_tlfn'] ?> </h5>
                  <h5 class="card-title mb-4">Status : <?= $rekrutmen['status'] ?> </h5>
                </div>
              </div>

              <div class="row mb-3">
                <a href="/rekrutmen/edit/<?= $rekrutmen['id'] ?>" class="btn btn-success mr-2">Edit</a>
                <form action="/rekrutmen/delete/<?= $rekrutmen['id'] ?>" method="post" class="d-inline">
                  <input type="hidden" name="_method" value="delete">
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus">
                    Hapus
                  </button>
                  <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus data rekrutmen <?= $rekrutmen['nama'] ?> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                          <button class="btn btn-danger" type="submit">Hapus</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="row">
                <a href="/rekrutmen" class="card-link">Kembali ke daftar rekrutmen</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
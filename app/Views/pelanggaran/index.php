<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<?php

function getBulan($a)
{
  $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  return $bulan[$a - 1];
}

?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-3 ml-3 row">Daftar Pelanggaran</h1>
      <a href="/pelanggaran/create" class="btn btn-primary row my-3 ml-3">Tambah Data Pelanggaran</a>

      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      <?php endif; ?>

      <table class="table" data-sortable="true" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
        <thead>
          <tr>
            <th data-switchable="false" data-sortable="true" data-halign="left" data-align="center">No</th>
            <th data-sortable="true" data-halign="left" data-align="center">ID Karyawan</th>
            <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jenis</th>
            <th data-sortable="true" data-halign="left" data-align="center">Keterangan</th>
            <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($pelanggaran as $p) : ?>
            <tr class="tabelTengah">
              <th scope="row"><?= ++$i ?></th>
              <td><?= $p['id_karyawan'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['tanggal'] ?></td>
              <td><?= $p['jenis_pelanggaran'] ?></td>
              <td><?= $p['keterangan'] ?></td>
              <td>
                <a href="/pelanggaran/edit/<?= $p['id_pelanggaran'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
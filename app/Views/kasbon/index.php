<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-3 ml-3 row">Daftar Kasbon</h1>
      <a href="/kasbon/create" class="btn btn-primary row my-3 ml-3">Tambah Data Kasbon</a>

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
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal Kasbon</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal Lunas</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jumlah Total</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jumlah Cicilan</th>
            <th data-sortable="true" data-halign="left" data-align="center">Sudah Bayar</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jangka Waktu</th>
            <th data-sortable="true" data-halign="left" data-align="center">Keterangan</th>
            <th data-sortable="true" data-halign="left" data-align="center">Status</th>
            <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($kasbon as $p) : ?>
            <?php
            if ($p['jenis_cicilan'] == 'Bulanan') {
              $jenis = 'Bulan';
            } else {
              $jenis = 'Pekan';
            }
            ?>
            <tr class="tabelTengah">
              <th scope="row"><?= ++$i ?></th>
              <td><?= $p['id_karyawan'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['tanggal_kasbon'] ?></td>
              <td><?= substr($p['tanggal_lunas'], 0, 4) == '0000' ? 'Belum Lunas' : $p['tanggal_lunas'] ?></td>
              <td><?= $p['bayar_total'] ?></td>
              <td><?= $p['bayar_cicilan'] ?></td>
              <td><?= $p['sudah_bayar'] ?></td>
              <td><?= $p['jangka_waktu'] ?> <?= $jenis ?></td>
              <td><?= $p['keterangan'] ?></td>
              <td><?= $p['status'] ?></td>
              <td>
                <a href="/kasbon/edit/<?= $p['id_kasbon'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
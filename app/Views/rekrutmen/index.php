<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-3 ml-3 row">Daftar Rekrutmen</h1>
      <a href="/rekrutmen/create" class="btn btn-primary row my-3 ml-3">Tambah Data Rekrutmen</a>

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
            <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">NIK</th>
            <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jenis Kelamin</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal Apply</th>
            <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Pendidikan Terakhir</th>
            <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Nilai Akhir</th>
            <th data-sortable="true" data-halign="left" data-align="center">E-mail</th>
            <th data-sortable="true" data-halign="left" data-align="center">No.Telp</th>
            <th data-sortable="true" data-halign="left" data-align="center">Status</th>
            <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($rekrutmen as $p) : ?>
            <tr class="tabelTengah">
              <th scope="row"><?= ++$i ?></th>
              <td><?= $p['nik'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['jenis_kelamin'] ?></td>
              <td><?= $p['tgl_apply'] ?></td>
              <td><?= $p['pendidikan_terakhir'] ?></td>
              <td><?= $p['nilai_akhir'] ?></td>
              <td><?= $p['email'] ?></td>
              <td><?= $p['no_tlfn'] ?></td>
              <td><?= $p['status'] ?></td>
              <td><a href="/rekrutmen/<?= $p['id'] ?>" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
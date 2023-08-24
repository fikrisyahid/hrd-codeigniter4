<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-3 ml-3 row">Daftar Riwayat Jabatan</h1>
      <a href="/jabatan/create" class="btn btn-primary row my-3 ml-3">Tambah Data Riwayat Jabatan</a>

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
            <th data-sortable="true" data-halign="left" data-align="center">Jabatan</th>
            <th data-sortable="true" data-halign="left" data-align="center">Instansi</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal Mulai</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tanggal Selesai</th>
            <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($jabatan as $p) : ?>
            <tr class="tabelTengah">
              <th scope="row"><?= ++$i ?></th>
              <td><?= $p['id_karyawan'] ?></td>
              <td><?= $p['nama_karyawan'] ?></td>
              <td><?= $p['nama_jabatan'] ?></td>
              <td><?= $p['nama_instansi'] ?></td>
              <td><?= $p['tanggal_mulai'] ?></td>
              <td><?= $p['tanggal_selesai'] ?></td>
              <td>
                <a href="/jabatan/edit/<?= $p['id_jabatan'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
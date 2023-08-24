<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <h1 class="mt-3 ml-3 row">Daftar Pelatihan</h1>
      <a href="/pelatihan/create" class="btn btn-primary row my-3 ml-3">Tambah Data Pelatihan</a>

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
            <th data-sortable="true" data-halign="left" data-align="center">ID</th>
            <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
            <th data-sortable="true" data-halign="left" data-align="center">Penyelenggara</th>
            <th data-sortable="true" data-halign="left" data-align="center">Lokasi</th>
            <th data-sortable="true" data-halign="left" data-align="center">Jenis</th>
            <th data-sortable="true" data-halign="left" data-align="center">Mulai</th>
            <th data-sortable="true" data-halign="left" data-align="center">Selesai</th>
            <th data-sortable="true" data-halign="left" data-align="center">Tingkat</th>
            <th data-sortable="true" data-halign="left" data-align="center">Sertifikat</th>
            <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($pelatihan as $p) : ?>
            <tr class="tabelTengah">
              <th scope="row"><?= ++$i ?></th>
              <td><?= $p['id_karyawan'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['penyelenggara'] ?></td>
              <td><?= $p['lokasi'] == '' ? 'Tidak diketahui' : $p['lokasi'] ?></td>
              <td><?= $p['jenis_pelatihan'] == '' ? 'Tidak diketahui' : $p['jenis_pelatihan'] ?></td>
              <td><?= substr($p['tanggal_mulai'], 0, 4) == '0000' ? 'Tidak diketahui' : $p['tanggal_mulai'] ?></td>
              <td><?= substr($p['tanggal_selesai'], 0, 4) == '0000' ? 'Tidak diketahui' : $p['tanggal_selesai'] ?></td>
              <td><?= $p['tingkat_pelatihan'] ?></td>
              <td><?= $p['sertifikat'] ?></td>
              <td>
                <a href="/pelatihan/edit/<?= $p['id_pelatihan'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
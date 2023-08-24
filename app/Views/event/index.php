<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="mt-3 ml-3 row">Daftar Event</h1>
            <a href="/event/create" class="btn btn-primary row my-3 ml-3">Tambah Data Event</a>

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
                        <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Tanggal Mulai</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Tanggal Selesai</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Lokasi</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Pemasukan</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Pengeluaran</th>
                        <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($event as $p) : ?>
                        <tr class="tabelTengah">
                            <th scope="row"><?= ++$i ?></th>
                            <td><?= $p['nama'] ?></td>
                            <td><?= substr($p['tgl_mulai'], 0, 4) == '0000' ? 'Tidak diketahui' : $p['tgl_mulai'] ?></td>
                            <td><?= substr($p['tgl_selesai'], 0, 4) == '0000' ? 'Tidak diketahui' : $p['tgl_selesai']  ?></td>
                            <td><?= $p['lokasi'] ?></td>
                            <td><?= $p['pemasukan'] ?></td>
                            <td><?= $p['pengeluaran'] ?></td>
                            <td>
                                <a href="/event/edit/<?= $p['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
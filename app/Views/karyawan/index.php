<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="mt-3 ml-3 row">Daftar Karyawan</h1>
            <a href="/karyawan/create" class="btn btn-primary row my-3 ml-3">Tambah Data Karyawan</a>

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
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">NIK</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Nama</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Jenis Kelamin</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Tanggal Lahir</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Agama</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Golongan Darah</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Alamat</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Status Perkawinan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Jumlah Anak</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Tanggal Gabung</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Anak Perusahaan</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Jenis Karyawan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Jabatan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Divisi</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Bagian</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">SK</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Tanggal Penentuan karyawan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Keterampilan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Status Tempat Tinggal</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">BPJS Kesehatan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">BPJS Ketenagakerjaan</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Status Covid</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Tanggal Tes Covid</th>
                        <th data-visible="false" data-sortable="true" data-halign="left" data-align="center">Gaji</th>
                        <th data-sortable="true" data-halign="left" data-align="center">Status</th>
                        <th data-searchable="false" data-switchable="false" data-halign="left" data-align="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($karyawan as $p) : ?>
                        <tr class="tabelTengah">
                            <th scope="row"><?= ++$i ?></th>
                            <td><?= $p['id_karyawan'] ?></td>
                            <td><?= $p['nik'] ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['jenis_kelamin'] ?></td>
                            <td><?= $p['tanggal_lahir'] ?></td>
                            <td><?= $p['agama'] ?></td>
                            <td><?= $p['gol_darah'] ?></td>
                            <td><?= $p['alamat'] ?></td>
                            <td><?= $p['status_perkawinan'] ?></td>
                            <td><?= $p['jumlah_anak'] ?></td>
                            <td><?= $p['tanggal_gabung'] ?></td>
                            <td><?= $p['anak_perusahaan'] ?></td>
                            <td><?= $p['jenis_karyawan'] ?></td>
                            <td><?= $p['jabatan'] ?></td>
                            <td><?= $p['divisi'] ?></td>
                            <td><?= $p['bagian'] ?></td>
                            <td><?= $p['sk'] ?></td>
                            <td><?= $p['tanggal_pk'] ?></td>
                            <td><?= $p['keterampilan'] ?></td>
                            <td><?= $p['tempat_tinggal'] ?></td>
                            <td><?= $p['bpjs_kesehatan'] ?></td>
                            <td><?= $p['bpjs_ketenagakerjaan'] ?></td>
                            <td><?= $p['status_covid'] ?></td>
                            <td><?= $p['tanggal_tes_covid'] ?></td>
                            <td><?= $p['gaji'] ?></td>
                            <td><?= $p['status_karyawan'] ?></td>
                            <td><a href="/karyawan/<?= $p['id'] ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
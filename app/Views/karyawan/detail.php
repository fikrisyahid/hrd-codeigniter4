<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>

<?php

function getBulan($a)
{
    $bulan = array('0', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    return $bulan[$a];
}

$tanggal_lahir_hari = (int)substr($karyawan['tanggal_lahir'], 8, 2);
$tanggal_lahir_bulan = (int)substr($karyawan['tanggal_lahir'], 5, 2);
$tanggal_lahir_tahun = (int)substr($karyawan['tanggal_lahir'], 0, 4);
$bulan_lahir = getBulan($tanggal_lahir_bulan);
if ($bulan_lahir == '0') {
    $tanggal_lahir = 'Tidak diketahui';
} else {
    $tanggal_lahir = (string)$tanggal_lahir_hari . " " . $bulan_lahir . " " . (string)$tanggal_lahir_tahun;
}


$tanggal_gabung_hari = (int)substr($karyawan['tanggal_gabung'], 8, 2);
$tanggal_gabung_bulan = (int)substr($karyawan['tanggal_gabung'], 5, 2);
$tanggal_gabung_tahun = (int)substr($karyawan['tanggal_gabung'], 0, 4);
$bulan_gabung = getBulan($tanggal_gabung_bulan);
if ($bulan_gabung == '0') {
    $tanggal_gabung = 'Tidak diketahui';
} else {
    $tanggal_gabung = (string)$tanggal_gabung_hari . " " . $bulan_gabung . " " . (string)$tanggal_gabung_tahun;
}

$tanggal_pk_hari = (int)substr($karyawan['tanggal_pk'], 8, 2);
$tanggal_pk_bulan = (int)substr($karyawan['tanggal_pk'], 5, 2);
$tanggal_pk_tahun = (int)substr($karyawan['tanggal_pk'], 0, 4);
$bulan_pk = getBulan($tanggal_pk_bulan);
if ($bulan_pk == '0') {
    $tanggal_pk = 'Tidak diketahui';
} else {
    $tanggal_pk = (string)$tanggal_pk_hari . " " . $bulan_pk . " " . (string)$tanggal_pk_tahun;
}

$tanggal_tes_covid_hari = (int)substr($karyawan['tanggal_tes_covid'], 8, 2);
$tanggal_tes_covid_bulan = (int)substr($karyawan['tanggal_tes_covid'], 5, 2);
$tanggal_tes_covid_tahun = (int)substr($karyawan['tanggal_tes_covid'], 0, 4);
$bulan_tes_covid = getBulan($tanggal_tes_covid_bulan);
if ($bulan_tes_covid == '0') {
    $tanggal_tes_covid = 'Tidak diketahui';
} else {
    $tanggal_tes_covid = (string)$tanggal_tes_covid_hari . " " . $bulan_tes_covid . " " . (string)$tanggal_tes_covid_tahun;
}

if ($karyawan['alamat'] == null) {
    $alamat = 'Tidak diketahui';
} else {
    $alamat = $karyawan['alamat'];
}

if ($karyawan['keterampilan'] == null) {
    $keterampilan = 'Tidak diketahui';
} else {
    $keterampilan = $karyawan['keterampilan'];
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="mt-4">Detail Karyawan</h1>

            <div class="card-fluid">
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <img src="/img/foto_profil/<?= ($karyawan['foto_profil'] == '') ? 'default.jpg' : $karyawan['foto_profil'] ?>" alt="Foto Profil <?= $karyawan['nama'] ?>" class="card-img">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title mb-4">ID Karyawan : <?= $karyawan['id_karyawan'] ?></h5>
                                    <h5 class="card-title mb-4">NIK : <?= $karyawan['nik'] ?></h5>
                                    <h5 class="card-title mb-4">Nama : <?= $karyawan['nama'] ?></h5>
                                    <h5 class="card-title mb-4">Jenis Kelamin : <?= $karyawan['jenis_kelamin'] ?> </h5>
                                    <h5 class="card-title mb-4">Tanggal Lahir : <?= $tanggal_lahir ?> </h5>
                                    <h5 class="card-title mb-4">Agama : <?= $karyawan['agama'] ?> </h5>
                                    <h5 class="card-title mb-4">Alamat : <?= $alamat ?> </h5>
                                    <h5 class="card-title mb-4">Golongan Darah : <?= $karyawan['gol_darah'] ?> </h5>
                                    <h5 class="card-title mb-4">Status Perkawinan : <?= $karyawan['status_perkawinan'] ?> </h5>
                                    <h5 class="card-title mb-4">Jumlah Anak : <?= $karyawan['jumlah_anak'] ?> </h5>
                                    <h5 class="card-title mb-4">Status Tempat Tinggal : <?= $karyawan['tempat_tinggal'] ?> </h5>
                                    <h5 class="card-title mb-4">Tanggal Gabung : <?= $tanggal_gabung ?> </h5>
                                    <h5 class="card-title mb-4">Anak Perusahaan : <?= $karyawan['anak_perusahaan'] ?> </h5>
                                </div>
                                <div class="col">
                                    <h5 class="card-title mb-4">Status Karyawan : <?= $karyawan['status_karyawan'] ?> </h5>
                                    <h5 class="card-title mb-4">Jenis Karyawan : <?= $karyawan['jenis_karyawan'] ?> </h5>
                                    <h5 class="card-title mb-4">Tanggal Penentuan Karyawan : <?= $tanggal_pk ?> </h5>
                                    <h5 class="card-title mb-4">SK : <?= $karyawan['sk'] ?> </h5>
                                    <h5 class="card-title mb-4">Keterampilan : <?= $keterampilan ?> </h5>
                                    <h5 class="card-title mb-4">Jabatan : <?= $karyawan['jabatan'] ?> </h5>
                                    <h5 class="card-title mb-4">Divisi : <?= $karyawan['divisi'] ?> </h5>
                                    <h5 class="card-title mb-4">Bagian : <?= $karyawan['bagian'] ?> </h5>
                                    <h5 class="card-title mb-4">BPJS Kesehatan : <?= $karyawan['bpjs_kesehatan'] ?> </h5>
                                    <h5 class="card-title mb-4">BPJS Ketenagakerjaan : <?= $karyawan['bpjs_ketenagakerjaan'] ?> </h5>
                                    <h5 class="card-title mb-4">Status Covid : <?= $karyawan['status_covid'] ?> </h5>
                                    <h5 class="card-title mb-4">Tanggal Tes Covid : <?= $tanggal_tes_covid ?> </h5>
                                    <h5 class="card-title mb-4">Gaji : <?= $karyawan['gaji'] ?> </h5>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <a href="/karyawan/edit/<?= $karyawan['id'] ?>" class="btn btn-success mr-2">Edit</a>

                                <form action="/karyawan/delete/<?= $karyawan['id'] ?>" method="post" class="d-inline">
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
                                                    Apakah anda yakin ingin menghapus data karyawan <?= $karyawan['nama'] ?> ?
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
                                <a href="/karyawan" class="card-link">Kembali ke daftar karyawan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
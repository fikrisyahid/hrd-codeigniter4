<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $allowedFields = ['id', 'id_karyawan', 'nama_karyawan', 'tingkat_pendidikan', 'nama_instansi', 'tahun_masuk', 'tahun_lulus', 'nilai_akhir'];

    public function getPendidikan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_pendidikan' => $id])->first();
    }
}

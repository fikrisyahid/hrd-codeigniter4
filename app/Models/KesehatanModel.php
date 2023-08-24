<?php

namespace App\Models;

use CodeIgniter\Model;

class KesehatanModel extends Model
{
    protected $table = 'riwayat_kesehatan';
    protected $primaryKey = 'id_kesehatan';
    protected $allowedFields = ['id', 'id_karyawan', 'nama_karyawan', 'nama_penyakit', 'tahun_sakit', 'tahun_sembuh', 'status'];

    public function getKesehatan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_kesehatan' => $id])->first();
    }
}

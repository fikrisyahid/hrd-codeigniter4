<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $allowedFields = ['id', 'id_karyawan', 'nama', 'tanggal', 'jenis_pelanggaran', 'keterangan'];

    public function getPelanggaran($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_pelanggaran' => $id])->first();
    }
}

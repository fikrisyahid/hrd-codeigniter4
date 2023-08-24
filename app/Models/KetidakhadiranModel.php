<?php

namespace App\Models;

use CodeIgniter\Model;

class KetidakhadiranModel extends Model
{
    protected $table = 'ketidakhadiran';
    protected $primaryKey = 'id_ketidakhadiran';
    protected $allowedFields = ['id', 'id_karyawan', 'nama', 'tanggal', 'jenis', 'keterangan'];

    public function getKetidakhadiran($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_ketidakhadiran' => $id])->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghargaanModel extends Model
{
    protected $table = 'penghargaan';
    protected $primaryKey = 'id_penghargaan';
    protected $allowedFields = ['id', 'id_karyawan', 'nama', 'tanggal', 'jenis_penghargaan', 'keterangan'];

    public function getPenghargaan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_penghargaan' => $id])->first();
    }
}

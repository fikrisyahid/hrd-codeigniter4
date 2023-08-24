<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'riwayat_jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = ['id', 'id_karyawan', 'nama_karyawan', 'nama_instansi', 'nama_jabatan', 'tanggal_mulai', 'tanggal_selesai'];

    public function getJabatan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_jabatan' => $id])->first();
    }
}

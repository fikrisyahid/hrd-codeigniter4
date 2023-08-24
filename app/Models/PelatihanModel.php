<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanModel extends Model
{
    protected $table = 'pelatihan';
    protected $primaryKey = 'id_pelatihan';
    protected $allowedFields = ['id', 'id_karyawan', 'nama', 'penyelenggara', 'lokasi', 'jenis_pelatihan', 'tanggal_mulai', 'tanggal_selesai', 'tingkat_pelatihan', 'sertifikat'];

    public function getPelatihan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_pelatihan' => $id])->first();
    }
}

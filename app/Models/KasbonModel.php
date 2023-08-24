<?php

namespace App\Models;

use CodeIgniter\Model;

class KasbonModel extends Model
{
    protected $table = 'kasbon';
    protected $primaryKey = 'id_kasbon';
    protected $allowedFields = ['id', 'id_karyawan', 'nama', 'tanggal_kasbon', 'tanggal_lunas', 'bayar_total', 'bayar_cicilan', 'sudah_bayar', 'jenis_cicilan', 'jangka_waktu', 'keterangan'];

    public function getKasbon($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_kasbon' => $id])->first();
    }
}

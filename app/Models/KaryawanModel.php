<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{

    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_karyawan', 'nik', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'gol_darah', 'alamat', 'agama', 'status_perkawinan', 'jumlah_anak', 'tanggal_gabung', 'anak_perusahaan', 'jenis_karyawan', 'tanggal_pk', 'sk', 'jabatan', 'divisi', 'bagian', 'keterampilan', 'tempat_tinggal', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan', 'status_covid', 'tanggal_tes_covid', 'status_karyawan', 'foto_profil', 'gaji'];

    public function getKaryawan($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getKaryawanid($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id_karyawan' => $id])->first();
    }

    public function getKaryawanWhere($status = '0')
    {
        return count($this->where('status_karyawan', $status)->findAll());
    }

    public function getKaryawanLast()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->orderBy('id', 'DESC');
        $query   = $builder->get()->getResultArray();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function getKaryawanGabungLast()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->orderBy('tanggal_gabung', 'DESC');
        $query   = $builder->get()->getResultArray();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function getKaryawanGabungFirst()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $builder->orderBy('tanggal_gabung', 'ASC');
        $query   = $builder->get()->getResultArray();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function delete_data($id)
    {
        $db = \Config\Database::connect();
        $db->disableForeignKeyChecks();
        $this->delete($id);
        $db->enableForeignKeyChecks();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class RekrutmenModel extends Model
{
    protected $table = 'rekrutmen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik', 'nama', 'tgl_apply', 'pendidikan_terakhir', 'nilai_akhir', 'email', 'jenis_kelamin', 'no_tlfn', 'status', 'foto_profil'];

    public function getRekrutmen($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getRekrutmenWhere($status = '0')
    {
        return count($this->where('status', $status)->findAll());
    }
}

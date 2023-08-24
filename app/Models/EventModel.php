<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'tgl_mulai', 'tgl_selesai', 'lokasi', 'pemasukan', 'pengeluaran'];

    public function getEvent($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}

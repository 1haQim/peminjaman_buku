<?php

namespace App\Models;

class Pengguna extends BaseModel
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama', 'jenis_pengguna', 'alamat','no_telepon'];

    public function getDescription()
    {
        return "Pengguna: $this->nama ($this->jenis_pengguna)";
    }
}

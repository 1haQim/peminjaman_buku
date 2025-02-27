<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $fillable = ['id_pengembalian','id_peminjaman', 'tanggal_pengembalian', 'denda'];

    public function getDescription()
    {
        return "pengembalian: $this->tanggal_pengembalian";
    }
}

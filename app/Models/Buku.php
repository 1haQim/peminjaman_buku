<?php

namespace App\Models;

class Buku extends BaseModel
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok'];

    public function getDescription()
    {
        return "Buku: $this->judul oleh $this->penulis";
    }
}

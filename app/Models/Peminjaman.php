<?php

namespace App\Models;

class Peminjaman extends BaseModel
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = ['id_peminjaman','id_buku', 'id_pengguna', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

   
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function getDescription()
    {
        return "Peminjaman buku {$this->buku->judul} oleh {$this->pengguna->nama}";
    }
}

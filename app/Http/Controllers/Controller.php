<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $jenis_pengguna = [
        '' => 'Pilih Pengguna',
        'siswa' => 'Siswa',
        'dosen' => 'Dosen'
    ];

    // Method protected agar hanya bisa digunakan oleh class turunan
    protected function hitungDenda($tanggal_kembali, $tanggal_dikembalikan)
    {
        $tanggal_kembali = Carbon::parse($tanggal_kembali);
        $tanggal_dikembalikan = Carbon::parse($tanggal_dikembalikan);

        $hari_terlambat = $tanggal_dikembalikan->diffInDays($tanggal_kembali, false);

        if ($hari_terlambat <= 0) {
            return 0;
        }

        $denda_per_hari = 1000;
        return $hari_terlambat * $denda_per_hari;
    }
}

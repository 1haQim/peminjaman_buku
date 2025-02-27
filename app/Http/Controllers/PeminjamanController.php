<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Pengguna;
use App\Models\Pengembalian;

class PeminjamanController extends Controller
{

    public function index()
    {
        $peminjaman = Peminjaman::with('buku','pengguna','pengembalian')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $jenis_pengguna = $this->jenis_pengguna;
        $pengguna = Pengguna::select('id_pengguna', 'nama', 'jenis_pengguna')->get();
        $buku = Buku::select('id_buku', 'judul', 'stok')->get();
        return view('peminjaman.create', compact('jenis_pengguna','buku','pengguna'));
    }

    //peminjaman
    public function store(Request $request)
    {
        $dPlus = strtotime('+5 days', time()); 
        $retur_date = date('Y-m-d', $dPlus) ;

        DB::beginTransaction();
        try {
            $request->validate([
                'id_buku' => 'required|exists:buku,id_buku',
                'id_pengguna' => 'required|exists:pengguna,id_pengguna',
            ]);

            $buku = Buku::findOrFail($request->id_buku);

            if ($buku->stok <= 0) {
                throw new Exception('Stok buku habis!');
            }

            // Kurangi stok buku
            $buku->decrement('stok');

            Peminjaman::create([
                'id_buku' => $request->id_buku,
                'id_pengguna' => $request->id_pengguna,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_kembali' => date('Y-m-d', $dPlus),
                'status' => 'dipinjam'
            ]);

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    //pengembalian
    public function pengembalian($id_peminjaman)
    {
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);

            if ($peminjaman->status == 'dikembalikan') {
                throw new Exception('Buku ini sudah dikembalikan.');
            }

            // Tambahkan kembali stok buku
            Buku::where('id_buku', $peminjaman->id_buku)->increment('stok');

            // Update status peminjaman
            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            $peminjaman->tanggal_dikembalikan = date('Y-m-d');
            $denda_keterlambaran = $this->hitungDenda($peminjaman->tanggal_kembali, $peminjaman->tanggal_dikembalikan);

            Pengembalian::create([
                'id_peminjaman' => $id_peminjaman,
                'tanggal_pengembalian' => date('Y-m-d'),
                'denda' => $denda_keterlambaran
            ]);

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

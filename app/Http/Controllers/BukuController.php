<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|integer',
                'stok' => 'required|integer',
            ]);
    
            Buku::create($request->all());
            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->route('buku.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $buku = Buku::where('id_buku', $id)->firstOrFail();;
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|integer',
                'stok' => 'required|integer',
            ]);

            $buku = Buku::where('id_buku', $id)->firstOrFail();;
            $buku->update($request->all());

            return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $buku = Buku::where('id_buku', $id)->firstOrFail();;
            $buku->delete();

            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

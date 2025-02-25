<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        $jenis_pengguna = $this->jenis_pengguna;
        return view('pengguna.create', compact('jenis_pengguna'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'jenis_pengguna' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required',
            ]);
            Pengguna::create($request->all());
            return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $jenis_pengguna = $this->jenis_pengguna;
        return view('pengguna.edit', compact('pengguna','jenis_pengguna'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'jenis_pengguna' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required',
            ]);

            $pengguna = Pengguna::findOrFail($id);
            $pengguna->update($request->all());

            return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

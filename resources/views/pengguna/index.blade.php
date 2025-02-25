@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengguna</h1>
     <!-- Alert Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('pengguna.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengguna as $b)
            <tr>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->jenis_pengguna }}</td>
                <td>{{ $b->no_telepon }}</td>
                <td>{{ $b->alamat }}</td>
                <td>
                    <a href="{{ route('pengguna.edit', $b->id_pengguna) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pengguna.destroy', $b->id_pengguna) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

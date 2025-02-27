@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pinjaman Buku</h1>
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
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Pinjam Buku</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>status</th>
                <th>tanggal pinjam</th>
                <th>tanggal pengembalian</th>
                <th>tanggal aktual <br> pengembalian</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $b)
            <tr>
                <td>{{ $b->buku->judul }}</td>
                <td>{{ $b->buku->penulis }}</td>
                <td>{{ $b->buku->tahun_terbit }}</td>
                <td>{{ $b->status }}</td>
                <td>{{ date('d M Y', strtotime($b->tanggal_pinjam)) }}</td>
                <td>{{ date('d M Y', strtotime($b->tanggal_kembali)) }}</td>
                <td>{{ !empty($b->pengembalian->tanggal_pengembalian) ? date('d M Y', strtotime($b->pengembalian->tanggal_pengembalian)) :''  }}</td>
                <td>Rp.{{ $b->pengembalian->denda ?? 0 }},-</td>
                <td>
                    <form action="{{ route('peminjaman.pengembalian', $b->id_peminjaman) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin mengembalikan buku ini?')">Kembalikan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

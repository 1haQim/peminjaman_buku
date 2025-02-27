@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Peminjaman Buku</h1>
    <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pilih Peminjam</label>
            <select name="id_pengguna" class="form-control" required>
                <option value="">Pilih Peminjam</option>
                @foreach($pengguna as $user)
                    <option value="{{ $user->id_pengguna }}">{{ $user->jenis_pengguna }} - {{ $user->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <select name="id_buku" class="form-control" required>
                <option value="">Pilih Buku</option>
                @foreach($buku as $item)
                    <option value="{{ $item->id_buku }}">{{ $item->judul }} (Stok: {{ $item->stok }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="text" name="tanggal_pinjam" class="form-control" value="{{ date('d F Y') }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal pengembalian</label>
            <?php 
                $dPlus = strtotime('+5 days', time()); 
            ?>
            <input type="text" name="tanggal_kembali" class="form-control" value="{{ date('d F Y', $dPlus) }}"readonly>
            <p style="color: red">*Jika tanggal pengembalian telat dari yang ditentukan maka akan di kenanakan denda Rp.1000 /hari</p>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection

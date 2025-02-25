@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengguna</h1>
    <form method="POST" action="{{ route('pengguna.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Penulis</label>
            <select name="jenis_pengguna" class="form-control" required>
                @foreach($jenis_pengguna as $key => $jenis)
                    <option value="{{ $key }}">{{ $jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">No Telp</label>
            <input type="number" name="no_telepon" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection

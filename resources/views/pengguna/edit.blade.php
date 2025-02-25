@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pengguna</h2>

        <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $pengguna->nama }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Penulis</label>
                <select name="jenis_pengguna" class="form-control" required>
                    @foreach($jenis_pengguna as $key => $jenis)
                        <option value="{{ $key }}" {{ (old('jenis_pengguna', $pengguna->jenis_pengguna) == $key) ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">No Telp</label>
                <input type="number" name="no_telepon" class="form-control" value="{{ $pengguna->no_telepon }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $pengguna->nama }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
@endsection

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-geo-alt-fill"></i> Tambah Wilayah</h4>

    <form action="{{ route('areas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_wilayah" class="form-label">Nama Wilayah</label>
            <input type="text" name="nama_wilayah" id="nama_wilayah" class="form-control" placeholder="Contoh: Tamalanrea" required>
        </div>
        <button class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
        <a href="{{ route('areas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

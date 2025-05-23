@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-recycle"></i> Tambah Jenis Sampah</h4>

    <form action="{{ route('trash-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Sampah</label>
            <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Contoh: Organik, Sampah Kering" required>
        </div>
        <button class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
        <a href="{{ route('trash-types.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
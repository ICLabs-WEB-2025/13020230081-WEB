@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil-square"></i> Ubah Status Laporan</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('reports.update', $report->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="status" class="form-label">Status Laporan</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $report->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <button class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

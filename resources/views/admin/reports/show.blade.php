@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-eye-fill"></i> Detail Laporan</h4>

    <div class="card shadow-sm">
        <div class="row g-0">
            {{-- FOTO --}}
            <div class="col-md-5">
                @if($report->foto)
                    <img src="{{ asset('storage/' . $report->foto) }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="Foto Laporan">
                    
                @else
                    <div class="d-flex justify-content-center align-items-center h-100 bg-light text-muted">
                        <p class="p-4">Tidak ada foto dilampirkan</p>
                    </div>
                @endif
            </div>

            {{-- DATA --}}
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title text-success">Laporan dari: <strong>{{ $report->nama_pengirim ?? 'Anonim' }}</strong></h5>
                    
                    <div class="mb-3">
                        <label class="fw-bold">Lokasi:</label>
                        <div class="border p-2 rounded bg-light">{{ $report->lokasi }}</div>
                    </div>

                    <td>{{ $report->trashType->jenis ?? '-' }}</td>

                    <div class="mb-3">
                        <label class="fw-bold">Deskripsi:</label>
                        <div class="border p-2 rounded bg-light">{{ $report->deskripsi }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Status:</label>
                        <span class="badge bg-{{ 
                            $report->status == 'selesai' ? 'success' : 
                            ($report->status == 'diproses' ? 'primary' : 'warning') }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Tanggal Laporan:</label>
                        <p class="mb-0">{{ $report->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <a href="{{ route('reports.index') }}" class="btn btn-secondary mt-3">
                        <i class="bi bi-arrow-left"></i> Kembali ke daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

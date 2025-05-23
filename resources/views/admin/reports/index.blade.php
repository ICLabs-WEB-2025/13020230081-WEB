@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-envelope-paper"></i> Daftar Laporan Sampah</h4>

    {{-- TABEL --}}
    <div class="table-responsive card shadow-sm border-0 p-4 rounded-4 bg-white">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col"><i class="bi bi-person-fill me-1"></i> Nama</th>
                    <th scope="col"><i class="bi bi-geo-alt-fill me-1"></i> Lokasi</th>
                    <th scope="col"><i class="bi bi-geo-alt-fill me-1"></i> Jenis sampah</th>
                    <th scope="col"><i class="bi bi-info-circle-fill me-1"></i> Status</th>
                    <th scope="col"><i class="bi bi-calendar-date me-1"></i> Tanggal</th>
                    <th scope="col"><i class="bi bi-tools me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                    <td>{{ $report->nama_pengirim ?? '-' }}</td>
                    <td>{{ $report->lokasi }}</td>
                    <td>
                        @php
                        $jenisSampah = $report->trashType->jenis ?? ''; 
                        $badgeClassJenis = '';
                        $iconClassJenis = '';

                        switch ($jenisSampah) {
                        case 'Organik':
                        $badgeClassJenis = 'success';
                        break;
                        case 'Anorganik':
                        $badgeClassJenis = 'warning'; 
                        break;
                        case 'B3':
                        $badgeClassJenis = 'danger';
                        break;
                        case 'sampah kering':
                        $badgeClassJenis = 'primary';
                        break;
                        case 'sampah basah':
                        $badgeClassJenis = 'secondary';
                        break;
                        case 'sampah campuran':
                        $badgeClassJenis = 'info';
                        break;
                        case 'residu':
                        $badgeClassJenis = 'dark';
                        break;
                        default:
                        $badgeClassJenis = 'secondary';
                        break;
                        }
                        @endphp
                        <span class="badge bg-{{ $badgeClassJenis }} px-3 py-2">
                            @if($iconClassJenis)
                            <i class="{{ $iconClassJenis }} me-1"></i>
                            @endif
                            {{ $jenisSampah != '' ? $jenisSampah : '-' }}
                        </span>
                    </td>
                    <td>
                        @php
                        $status = $report->status;
                        $badgeClassStatus = match($status) {
                        'dikirim' => 'warning',
                        'diproses' => 'primary',
                        'selesai' => 'success',
                        default => 'secondary'
                        };
                        @endphp
                        <span class="badge bg-{{ $badgeClassStatus }} px-3 py-2 text-capitalize">
                            {{ $status }}
                        </span>
                    </td>
                    <td>{{ $report->created_at->format('d M Y') }}</td>
                    <td class="d-flex flex-wrap gap-1">
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                            onsubmit="return confirm('Hapus laporan ini?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-4 mb-2 d-block"></i>
                        Belum ada laporan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
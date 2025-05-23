@extends('layouts.dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-clipboard-data"></i> Daftar Jadwal Pengangkutan</h4>
        <a href="{{ route('schedules.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle-fill"></i> Tambah Jadwal
        </a>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="table-responsive card shadow-sm border-0 p-4 rounded-4 bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success">
                <tr class="align-middle">
                    <th><i class="bi bi-geo-alt-fill"></i> Wilayah</th>
                    <th><i class="bi bi-calendar2-event"></i> Tanggal</th>
                    <th><i class="bi bi-clock"></i> Waktu</th>
                    <th><i class="bi bi-recycle"></i> Jenis Sampah</th>
                    <th><i class="bi bi-tools"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td class="text-capitalize">{{ $schedule->area->nama_wilayah }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->tanggal)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->waktu)->format('H:i') }}</td>
                        <td>
                            @php
                                $jenis = strtolower($schedule->trashType->jenis);
                                $badgeClass = match($jenis) {
                                    'organik' => 'success',
                                    'anorganik' => 'warning',
                                    'b3' => 'danger',
                                    'sampah kering' => 'primary',
                                    'sampah basah' => 'secondary',
                                    'sampah campuran' => 'info',
                                    'residu' => 'dark',
                                    default => 'secondary'
                                };
                            @endphp 
                            <span class="badge bg-{{ $badgeClass }}">
                                {{ $schedule->trashType->jenis }}
                            </span>
                        </td>
                        <td class="d-flex flex-wrap gap-2">
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" 
                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-4 d-block mb-2"></i>
                            Belum ada jadwal pengangkutan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
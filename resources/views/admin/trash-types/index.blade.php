@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4 class="fw-bold"><i class="bi bi-recycle"></i> Daftar Jenis Sampah</h4>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="table-responsive card shadow-sm border-0 p-4 rounded-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success text-dark">
                <tr class="align-middle">
                    <th scope="col"><i class="bi bi-recycle"></i> Jenis Sampah</th>
                    <th scope="col" class="text-center"><i class="bi bi-gear-fill"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trashTypes as $type)
                <tr>
                    <td class="fw-medium text-capitalize">
                        <i class="bi bi-dot text-success"></i> {{ $type->jenis }}
                    </td>
                    <td class="text-center">
                        <form action="{{ route('trash-types.destroy', $type->id) }}" method="POST"
                              onsubmit="return confirm('Hapus jenis sampah ini?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center text-muted py-4">
                        <i class="bi bi-exclamation-circle-fill text-warning fs-4 d-block mb-2"></i>
                        Belum ada jenis sampah ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('trash-types.create') }}" class="btn btn-success btn-lg shadow-sm">
            Tambah Jenis Sampah
        </a>
    </div>
</div>
@endsection

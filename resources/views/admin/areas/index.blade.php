@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-geo-alt"></i> Daftar Wilayah</h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive card shadow-sm border-0 p-4 rounded-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success text-dark">
                <tr class="align-middle">
                    <th scope="col"><i class="bi bi-geo-alt-fill me-1"></i> Nama Wilayah</th>
                    <th scope="col" class="text-center"><i class="bi bi-tools"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                    <tr>
                        <td class="fw-medium text-capitalize">
                            <i class="bi bi-dot text-success"></i> {{ $area->nama_wilayah }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus wilayah ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
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
                            Belum ada wilayah ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('areas.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Wilayah
        </a>
    </div>
</div>

{{-- MODAL ERROR --}}
@if (session('area_delete_error'))
<div class="modal fade" id="deleteAreaErrorModal" tabindex="-1" aria-labelledby="deleteAreaErrorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteAreaErrorModalLabel">
          <i class="bi bi-x-circle-fill me-2"></i> Gagal Menghapus Wilayah
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        {{ session('area_delete_error') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif
@endsection

@push('scripts')
@if (session('area_delete_error'))
<script>
    const areaErrorModal = new bootstrap.Modal(document.getElementById('deleteAreaErrorModal'));
    areaErrorModal.show();
</script>
@endif
@endpush

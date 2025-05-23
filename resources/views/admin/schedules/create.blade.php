@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-calendar-plus"></i> Tambah Jadwal Pengangkutan</h4>

    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="area_id" class="form-label">Wilayah</label>
                <select name="area_id" id="area_id" class="form-select" required>
                    <option disabled selected>Pilih Wilayah</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nama_wilayah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="trash_type_id" class="form-label">Jenis Sampah</label>
                <select name="trash_type_id" id="trash_type_id" class="form-select" required>
                    <option disabled selected>Pilih Jenis Sampah</option>
                    @foreach($trashTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->jenis }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="time" name="waktu" id="waktu" class="form-control" required>
            </div>
        </div>

        <button class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan Jadwal</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

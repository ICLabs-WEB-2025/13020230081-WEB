@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil-square"></i> Edit Jadwal Pengangkutan</h4>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="area_id" class="form-label">Wilayah</label>
                <select name="area_id" id="area_id" class="form-select" required>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ $schedule->area_id == $area->id ? 'selected' : '' }}>
                            {{ $area->nama_wilayah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="trash_type_id" class="form-label">Jenis Sampah</label>
                <select name="trash_type_id" id="trash_type_id" class="form-select" required>
                    @foreach($trashTypes as $type)
                        <option value="{{ $type->id }}" {{ $schedule->trash_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $schedule->tanggal }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="time" name="waktu" id="waktu" value="{{ $schedule->waktu }}" class="form-control" required>
            </div>
        </div>

        <button class="btn btn-primary"><i class="bi bi-save"></i> Update Jadwal</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

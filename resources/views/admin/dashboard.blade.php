@extends('layouts.dashboard')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f1f5f9;
    }
    .card-metric {
        border: 1px solid #e5e7eb;
        background-color: #ffffff;
        border-radius: 0.75rem;
        padding: 1.2rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.04);
    }
</style>
@endpush

<div class="container-fluid">
    <h4 class="fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h4>

    {{-- Info Cards --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="bi bi-calendar2-week text-success fs-1"></i>
                    <div>
                        <h6 class="text-muted">Total Jadwal</h6>
                        <h3>{{ $totalSchedules }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-start border-warning border-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="bi bi-chat-dots text-warning fs-1"></i>
                    <div>
                        <h6 class="text-muted">Total Laporan</h6>
                        <h3>{{ $totalReports }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-start border-info border-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="bi bi-geo-alt text-info fs-1"></i>
                    <div>
                        <h6 class="text-muted">Total Wilayah</h6>
                        <h3>{{ $totalAreas }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <strong><i class="bi bi-bar-chart-line"></i> Statistik Laporan Sampah</strong>
            <a href="{{ route('reports.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-right"></i> Lihat Laporan</a>
        </div>
        <div class="card-body">
            <canvas id="reportChart" height="100"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    const ctx = document.getElementById('reportChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['pending', 'Diproses', 'Selesai'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [
                    Number("{{ $statusCounts['pending'] ?? 0 }}"),
                    Number("{{ $statusCounts['diproses'] ?? 0 }}"),
                    Number("{{ $statusCounts['selesai'] ?? 0 }}")
                ],
                backgroundColor: ['#facc15', '#3b82f6', '#22c55e'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>
@endpush

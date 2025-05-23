<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Waste Collection Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: linear-gradient(to right, #16a34a, #22c55e);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
        }
        .card-shadow {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        #map {
            height: 300px;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <!-- Login Admin Button (Top Right) -->
    <nav class="navbar bg-light shadow-sm py-2 px-4 justify-content-end">
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-box-arrow-in-right"></i> Login Admin
        </button>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1 class="display-5 fw-bold">Sistem Informasi Pengangkutan Sampah</h1>
        <p class="lead">Pantau jadwal dan kirim laporan tumpukan sampah dengan mudah.</p>
    </div>

    <div class="container py-5">
        <!-- Jadwal Pengangkutan -->
        <div class="mb-5">
            <h3 class="mb-3 text-success"><i class="bi bi-calendar-week"></i> Jadwal Pengangkutan</h3>
            <div class="table-responsive card-shadow rounded">
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('welcome') }}" class="mb-4 d-flex justify-content-end">
                    <input type="text" name="search" class="form-control w-auto me-2" placeholder="Cari wilayah..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </form>

                <table class="table table-hover table-bordered align-middle bg-white">
                    <thead class="table-success">
                        <tr>
                            <th>Wilayah</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jenis Sampah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $s)
                            <tr>
                                <td>{{ $s->area->nama_wilayah }}</td>
                                <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($s->waktu)->format('H:i') }}</td>
                                <td>
                                    @php
                                        $jenis = strtolower($s->trashType->jenis);
                                        $badgeClass = match($jenis) {
                                            'organik' => 'succes',
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
                                        {{ $s->trashType->jenis }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada jadwal tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Laporan -->
        <div class="mb-5">
            <h3 class="mb-3 text-success"><i class="bi bi-chat-left-dots"></i> Kirim Laporan Sampah</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data" class="card card-body border-0 card-shadow">
                @csrf
                <div class="mb-3">
                    <label>Nama (opsional)</label>
                    <input type="text" name="nama_pengirim" class="form-control" placeholder="Nama Anda (boleh dikosongkan)">
                </div>

                <div class="mb-3">
                    <label>Lokasi *</label>
                    <div id="map"></div>
                    {{-- Alamat hasil reverse geocoding --}}
                    <input type="text" name="lokasi" id="alamatInput" class="form-control mt-2" readonly required placeholder="Klik peta untuk isi otomatis">
                    {{-- Koordinat disimpan di hidden field --}}
                    <input type="hidden" name="koordinat" id="koordinatInput">
                </div>
                
                <div class="mb-3">
                    <label>Jenis Sampah</label>
                    <select name="trash_type_id" class="form-select" required>
                        <option value="">Jenis sampah</option>
                        @foreach($trashTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Deskripsi *</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Deskripsikan kondisi tumpukan sampah..."></textarea>
                </div>

                <div class="mb-3">
                    <label>Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button class="btn btn-success"><i class="bi bi-send"></i> Kirim Laporan</button>
            </form>
        </div>
    </div>

    <!-- Modal Login Admin -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('login') }}" class="modal-content">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="loginModalLabel"><i class="bi bi-person-lock"></i> Login Admin</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    {{-- Tampilkan pesan error jika login gagal --}}
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i> Email atau password salah.
                        </div>
                    @endif

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required
                               placeholder="admin@email.com" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    const map = L.map('map').setView([-5.1357, 119.4238], 13); // Makassar
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        const koordinat = lat + ',' + lng;

        // Tampilkan marker
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }

        // Simpan koordinat ke input tersembunyi
        document.getElementById('koordinatInput').value = koordinat;

        // Reverse geocoding ke alamat (Nominatim API)
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(res => res.json())
            .then(data => {
                const alamat = data.display_name || koordinat;
                document.getElementById('alamatInput').value = alamat;
            })
            .catch(err => {
                console.error('Gagal reverse geocoding:', err);
                document.getElementById('alamatInput').value = koordinat;
            });
    });
</script>


    <!-- Script untuk membuka modal otomatis jika login error -->
    @if ($errors->has('email'))
    <script>
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    </script>
    @endif
</body>
</html>

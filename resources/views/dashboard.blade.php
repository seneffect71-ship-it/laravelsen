<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      body { background: #f6f8fb; color: #172033; }
      .navbar { border-bottom: 1px solid #e7ecf3; }
      .brand-mark {
        align-items: center;
        display: inline-flex;
        font-weight: 700;
        height: 48px;
        justify-content: center;
        width: 48px;
      }
      .brand-mark img {
        height: 100%;
        width: 100%;
        object-fit: contain;
      }
      .hero {
        background: #ffffff;
        border: 1px solid #e7ecf3;
        border-radius: 8px;
        padding: 28px;
      }
      .module-card {
        background: #ffffff;
        border: 1px solid #e7ecf3;
        border-radius: 8px;
        height: 100%;
        padding: 20px;
        transition: border-color .15s ease, transform .15s ease;
      }
      .module-card:hover { border-color: #9ec5fe; transform: translateY(-2px); }
      .stat-number { font-size: 2rem; font-weight: 700; line-height: 1; }
      .quick-action { min-width: 104px; }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
          <div class="brand-mark">
            <img src="{{ asset('images/logo-itbss.png') }}" alt="ITBSS Logo" />
          </div>
          <span>ITBSS Akademik</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ action([App\Http\Controllers\KelasController::class, 'index']) }}">Kelas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ action([App\Http\Controllers\KrsController::class, 'index']) }}">KRS</a></li>
          </ul>
          <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">{{ session('user.name') }}</span>
            <a class="btn btn-outline-danger btn-sm" href="/logout">Logout</a>
          </div>
        </div>
      </div>
    </nav>

    <main class="container py-4">
      <section class="hero mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
          <div>
            <p class="text-primary fw-semibold mb-1">Dashboard</p>
            <h1 class="h3 mb-2">Sistem Informasi Akademik</h1>
            <p class="text-muted mb-0">Pantau data utama dan masuk ke modul yang ingin dikelola.</p>
          </div>
          <div class="d-flex flex-wrap gap-2 align-items-start">
            <a href="{{ route('kelas.create') }}" class="btn btn-primary quick-action">Tambah Kelas</a>
            <a href="{{ route('krs.create') }}" class="btn btn-outline-primary quick-action">Buat KRS</a>
          </div>
        </div>
      </section>

      @php
        $modules = [
          ['title' => 'Dosen', 'count' => $stats['dosen'] ?? 0, 'text' => 'Kelola data pengajar.', 'url' => action([App\Http\Controllers\DosenController::class, 'index'])],
          ['title' => 'Mahasiswa', 'count' => $stats['mahasiswa'] ?? 0, 'text' => 'Kelola identitas mahasiswa.', 'url' => action([App\Http\Controllers\MahasiswaController::class, 'index'])],
          ['title' => 'Mata Kuliah', 'count' => $stats['matakuliah'] ?? 0, 'text' => 'Kelola kurikulum dan SKS.', 'url' => action([App\Http\Controllers\MataKuliahController::class, 'index'])],
          ['title' => 'Jurusan', 'count' => $stats['jurusan'] ?? 0, 'text' => 'Kelola program studi.', 'url' => action([App\Http\Controllers\JurusanController::class, 'index'])],
          ['title' => 'KRS', 'count' => $stats['krs'] ?? 0, 'text' => 'Kelola rencana studi.', 'url' => action([App\Http\Controllers\KrsController::class, 'index'])],
          ['title' => 'Kelas', 'count' => $stats['kelas'] ?? 0, 'text' => 'Kelola jadwal kelas.', 'url' => action([App\Http\Controllers\KelasController::class, 'index'])],
        ];
      @endphp

      <section class="row g-3">
        @foreach($modules as $module)
          <div class="col-12 col-md-6 col-xl-4">
            <div class="module-card">
              <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                  <h2 class="h5 mb-1">{{ $module['title'] }}</h2>
                  <p class="text-muted mb-3">{{ $module['text'] }}</p>
                </div>
                <div class="stat-number">{{ $module['count'] }}</div>
              </div>
              <a href="{{ $module['url'] }}" class="btn btn-sm btn-outline-primary">Buka Modul</a>
            </div>
          </div>
        @endforeach
      </section>

      <section class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <p class="text-primary fw-semibold mb-1">KRS Terbaru</p>
            <h2 class="h5 mb-0">Ringkasan KRS terbaru</h2>
          </div>
          <a href="{{ action([App\Http\Controllers\KrsController::class, 'index']) }}" class="btn btn-sm btn-outline-primary">Lihat Semua KRS</a>
        </div>

        @if($recentKrs->isEmpty())
          <div class="alert alert-info mb-0">Belum ada KRS terbaru. Buat KRS baru untuk mahasiswa Anda.</div>
        @else
          <div class="table-responsive bg-white rounded-3 shadow-sm p-3">
            <table class="table table-borderless mb-0">
              <thead>
                <tr>
                  <th class="text-muted small">Mahasiswa</th>
                  <th class="text-muted small">Tahun</th>
                  <th class="text-muted small">Semester</th>
                  <th class="text-muted small">Status</th>
                  <th class="text-muted small">SKS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($recentKrs as $item)
                  <tr>
                    <td class="fw-semibold">{{ $item->mahasiswa?->nama ?? 'Tidak diketahui' }}</td>
                    <td>{{ $item->tahun_ajaran }}</td>
                    <td>{{ ucfirst($item->semester) }}</td>
                    <td>
                      @php
                        $badge = [
                          'approved' => 'bg-success',
                          'pending' => 'bg-warning text-dark',
                          'partial' => 'bg-info text-dark',
                          'declined' => 'bg-danger'
                        ][$item->status] ?? 'bg-secondary';
                      @endphp
                      <span class="badge {{ $badge }} rounded-pill">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td>{{ $item->total_sks }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

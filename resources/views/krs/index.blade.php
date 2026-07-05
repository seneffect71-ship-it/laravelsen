<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body { background: #f6f8fb; }
        .page-shell { background: #fff; border: 1px solid #e7ecf3; border-radius: 8px; padding: 24px; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="page-shell">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
            <div>
                <p class="text-primary fw-semibold mb-1">KRS</p>
                <h1 class="h3 mb-1">Daftar KRS</h1>
                <p class="text-muted mb-0">Kelola rencana studi mahasiswa, semester, status, dan total SKS.</p>
            </div>
            <div class="d-flex flex-wrap gap-2 align-items-start">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                <a href="{{ route('krs.create') }}" class="btn btn-primary">Buat KRS</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th>Total SKS</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($krs as $item)
                    @php
                        $statusClass = [
                            'approved' => 'text-bg-success',
                            'pending' => 'text-bg-warning',
                            'partial' => 'text-bg-info',
                            'declined' => 'text-bg-danger',
                        ][$item->status] ?? 'text-bg-secondary';
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->mahasiswa?->nama ?? 'Mahasiswa tidak ditemukan' }}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td>{{ ucfirst($item->semester) }}</td>
                        <td><span class="badge {{ $statusClass }}">{{ ucfirst($item->status) }}</span></td>
                        <td>{{ $item->total_sks }}</td>
                        <td class="text-end">
                            <form action="{{ route('krs.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus KRS ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="fw-semibold">Belum ada data KRS.</div>
                            <div class="text-muted mb-3">Buat KRS pertama setelah data mahasiswa tersedia.</div>
                            <a href="{{ route('krs.create') }}" class="btn btn-primary btn-sm">Buat KRS</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

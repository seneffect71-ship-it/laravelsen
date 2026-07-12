<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f6f8fb; }
        .page-shell { background: #fff; border: 1px solid #e7ecf3; border-radius: 8px; padding: 24px; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="page-shell">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <p class="text-primary fw-semibold mb-1">KRS</p>
                <h2 class="h5 mb-0">Detail KRS Mahasiswa</h2>
                <div class="text-muted">Mahasiswa: <strong>{{ $krs->mahasiswa?->nama ?? 'Tidak diketahui' }}</strong></div>
            </div>
            <div class="d-flex gap-2">
                @if(session('user.role') === 'dosen')
                    <form action="{{ route('krs.status', $krs->id) }}" method="POST" class="d-inline-flex gap-2">
                        @csrf
                        <select name="status" class="form-select form-select-sm">
                            <option value="approved">Approve</option>
                            <option value="declined">Reject</option>
                            <option value="pending">Pending</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Simpan Status KRS</button>
                    </form>
                @endif
                <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <table class="table">
                <tr><th>Tahun Ajaran</th><td>{{ $krs->tahun_ajaran }}</td></tr>
                <tr><th>Semester</th><td>{{ ucfirst($krs->semester) }}</td></tr>
                <tr><th>Status</th><td>{{ ucfirst($krs->status) }}</td></tr>
                <tr><th>Total SKS</th><td>{{ $krs->total_sks }}</td></tr>
            </table>
        </div>

        <h5>Rincian KRS</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode Kelas</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($details as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->kelas?->kode_kelas ?? $d->kode_kelas }}</td>
                        <td>{{ $d->kelas?->mataKuliah?->Nama_Mata_Kuliah ?? '-' }}</td>
                        <td>{{ $d->kelas?->dosen?->Fullname ?? '-' }}</td>
                        <td>{{ ucfirst($d->status) }}</td>
                        <td class="text-end">
                            @if(session('user.role') === 'dosen')
                                <form action="{{ route('krs_detail.status', $d->id) }}" method="POST" class="d-inline-flex gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="approved">Approve</option>
                                        <option value="declined">Reject</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Belum ada rincian KRS.</td>
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kelas</title>
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
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
            <div>
                <p class="text-primary fw-semibold mb-1">Kelas</p>
                <h1 class="h3 mb-1">Data Kelas</h1>
                <p class="text-muted mb-0">Kelola jadwal, dosen, mata kuliah, dan kapasitas kelas.</p>
            </div>
                        <div class="d-flex flex-wrap gap-2 align-items-start">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                                @if(session('user.role') === 'admin')
                                    <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
                                @endif
                        </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Ruang</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($kelas as $kls)
                    <tr>
                        <td class="fw-semibold">{{ $kls->kode_kelas }}</td>
                        <td>{{ $kls->dosen?->Fullname ?? 'Dosen tidak ditemukan' }}</td>
                        <td>{{ $kls->mataKuliah?->Nama_Mata_Kuliah ?? 'Mata kuliah tidak ditemukan' }}</td>
                        <td>{{ $kls->ruang_kelas }}</td>
                        <td>{{ ucfirst($kls->hari) }}</td>
                        <td>{{ $kls->jam }}</td>
                        <td>{{ ucfirst($kls->semester) }}</td>
                        <td>{{ $kls->tahun_ajaran }}</td>
                        <td class="text-end">
                            @if(session('user.role') === 'admin')
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('kelas.edit', $kls->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('kelas.delete', $kls->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('kelas.edit', $kls->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('kelas.delete', $kls->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="fw-semibold">Belum ada data kelas.</div>
                            <div class="text-muted mb-3">Tambahkan kelas pertama untuk mulai menyusun jadwal.</div>
                            <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">Tambah Kelas</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">@if(isset($kelas) && method_exists($kelas, 'links')) {{ $kelas->links() }} @endif</div>
</main>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body { background: #f6f8fb; }
        .page-shell { background: #fff; border: 1px solid #e7ecf3; border-radius: 8px; padding: 24px; }
        .table td, .table th { vertical-align: middle; }
        .table thead th { white-space: nowrap; }
        .action-cell { min-width: 132px; }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="page-shell">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
            <div>
                <p class="text-primary fw-semibold mb-1">Dosen</p>
                <h1 class="h3 mb-1">Data Dosen</h1>
                <p class="text-muted mb-0">Kelola identitas dosen, pendidikan terakhir, dan jurusan utama.</p>
            </div>
                        <div class="d-flex flex-wrap gap-2 align-items-start">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                                @if(session('user.role') === 'admin')
                                    <a href="{{ route('dosen.add') }}" class="btn btn-primary">Tambah Dosen</a>
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
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIP</th>
                    <th>NIDN</th>
                    <th>Pendidikan</th>
                    <th>Jurusan</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th class="text-end action-cell">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($dosen as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $d->Fullname }}</td>
                        <td>{{ $d->NIP }}</td>
                        <td>{{ $d->NIDN }}</td>
                        <td>{{ $d->Pendidikan_Terakhir }}</td>
                        <td>{{ $d->Jurusan_id }}</td>
                        <td>{{ $d->Tempat_Lahir }}</td>
                        <td>{{ $d->Tanggal_Lahir }}</td>
                        <td class="text-end">
                            @if(session('user.role') === 'admin')
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('dosen.edit', $d->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('dosen.delete', $d->id) }}" method="post" onsubmit="return confirm('Hapus data dosen ini?')">
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
                            <div class="fw-semibold">Belum ada data dosen.</div>
                            <div class="text-muted mb-3">Tambahkan dosen pertama agar bisa dipilih di kelas dan mata kuliah.</div>
                            <a href="{{ route('dosen.add') }}" class="btn btn-primary btn-sm">Tambah Dosen</a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">@if(isset($dosen) && method_exists($dosen, 'links')) {{ $dosen->links() }} @endif</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

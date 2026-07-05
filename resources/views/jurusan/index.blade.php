<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Jurusan</title>
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
                <p class="text-primary fw-semibold mb-1">Jurusan</p>
                <h1 class="h3 mb-1">Data Jurusan</h1>
                <p class="text-muted mb-0">Kelola kode dan nama jurusan yang dipakai di data akademik.</p>
            </div>
            <div class="d-flex flex-wrap gap-2 align-items-start">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                <a href="{{ route('jurusan.add') }}" class="btn btn-primary">Tambah Jurusan</a>
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
                    <th>Kode Jurusan</th>
                    <th>Nama Jurusan</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($jurusan as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $j->Kode_Jurusan }}</td>
                        <td>{{ $j->Nama_Jurusan }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('jurusan.edit', $j->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('jurusan.delete', $j->id) }}" method="post" onsubmit="return confirm('Hapus jurusan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="fw-semibold">Belum ada data jurusan.</div>
                            <div class="text-muted mb-3">Tambahkan jurusan untuk mengelompokkan mata kuliah dan dosen.</div>
                            <a href="{{ route('jurusan.add') }}" class="btn btn-primary btn-sm">Tambah Jurusan</a>
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

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body { background: #f6f8fb; }
        .page-shell { background: #fff; border: 1px solid #e7ecf3; border-radius: 8px; padding: 24px; }
        .table td, .table th { vertical-align: middle; }
        .table thead th { white-space: nowrap; }
        .address-cell { max-width: 260px; }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="page-shell">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
            <div>
                <p class="text-primary fw-semibold mb-1">Mahasiswa</p>
                <h1 class="h3 mb-1">Data Mahasiswa</h1>
                <p class="text-muted mb-0">Kelola biodata mahasiswa untuk login demo dan kebutuhan KRS.</p>
            </div>
            <div class="d-flex flex-wrap gap-2 align-items-start">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                <a href="{{ route('mahasiswa.add') }}" class="btn btn-primary">Tambah Mahasiswa</a>
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
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $mhs->nim }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nisn }}</td>
                        <td>{{ $mhs->tempat_lahir }}</td>
                        <td>{{ $mhs->tanggal_lahir }}</td>
                        <td class="address-cell">{{ $mhs->alamat }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('mahasiswa.delete', $mhs->id) }}" method="post" onsubmit="return confirm('Hapus data mahasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="fw-semibold">Belum ada data mahasiswa.</div>
                            <div class="text-muted mb-3">Tambahkan mahasiswa pertama agar bisa dibuatkan KRS.</div>
                            <a href="{{ route('mahasiswa.add') }}" class="btn btn-primary btn-sm">Tambah Mahasiswa</a>
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

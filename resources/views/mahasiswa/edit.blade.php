<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mahasiswa - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body { background: #f6f8fb; }
        .page-shell { background: #fff; border: 1px solid #e7ecf3; border-radius: 8px; padding: 24px; }
    </style>
  </head>
  <body>
    <main class="container py-4">
    <div class="page-shell">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
        <div>
            <p class="text-primary fw-semibold mb-1">Mahasiswa</p>
            <h2 class="h3 mb-1">Edit Mahasiswa</h2>
            <p class="text-muted mb-0">Perbarui biodata mahasiswa.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/mahasiswa') }}" class="btn btn-outline-primary">Data Mahasiswa</a>
        </div>
    </div>
    <form action="{{route('mahasiswa.update', $mahasiswa->id)}}" method="post" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-12 col-md-6">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">NISN</label>
            <input type="text" name="nisn" value="{{ $mahasiswa->nisn }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $mahasiswa->alamat }}</textarea>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('/mahasiswa') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

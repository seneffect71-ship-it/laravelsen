<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mata Kuliah - ITBSS</title>
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
            <p class="text-primary fw-semibold mb-1">Mata Kuliah</p>
            <h2 class="h3 mb-1">Edit Mata Kuliah</h2>
            <p class="text-muted mb-0">Perbarui data mata kuliah.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/matakuliah') }}" class="btn btn-outline-primary">Data Mata Kuliah</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('matakuliah.update', $matakuliah->id)}}" method="post" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-12 col-md-6">
            <label class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="Kode_Mata_Kuliah" value="{{ old('Kode_Mata_Kuliah', $matakuliah->Kode_Mata_Kuliah) }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="Nama_Mata_Kuliah" value="{{ old('Nama_Mata_Kuliah', $matakuliah->Nama_Mata_Kuliah) }}" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">SKS</label>
            <input type="number" name="SKS" value="{{ old('SKS', $matakuliah->SKS) }}" min="1" class="form-control" required>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Dosen Pengampu</label>
            <select name="Dosen_Id" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id }}" @selected(old('Dosen_Id', $matakuliah->Dosen_Id) == $dosen->id)>{{ $dosen->Fullname }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Jurusan</label>
            <select name="Jurusan_Id" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" @selected(old('Jurusan_Id', $matakuliah->Jurusan_Id) == $jurusan->id)>{{ $jurusan->Nama_Jurusan }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('/matakuliah') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

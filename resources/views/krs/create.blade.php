<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h2>Buat KRS</h2>
          <p class="text-muted mb-0">Isi data KRS mahasiswa</p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
          <a href="{{ route('krs.index') }}" class="btn btn-secondary">Data KRS</a>
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

      @if ($mahasiswa->isEmpty())
        <div class="alert alert-warning">
          Belum ada data mahasiswa. Silakan buat data mahasiswa terlebih dahulu sebelum membuat KRS.
          <a href="{{ route('mahasiswa.add') }}" class="btn btn-sm btn-primary ms-2">Tambah Mahasiswa</a>
        </div>
      @endif

      <form action="{{ route('krs.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-12">
          <label class="form-label">Mahasiswa</label>
          <select name="mahasiswa_id" class="form-select" {{ $mahasiswa->isEmpty() ? 'disabled' : '' }} required>
            <option value="">Pilih Mahasiswa</option>
            @foreach($mahasiswa as $mhs)
              <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Tahun Ajaran</label>
          <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" class="form-control" required {{ $mahasiswa->isEmpty() ? 'disabled' : '' }}>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Semester</label>
          <select name="semester" class="form-select" required>
            <option value="">Pilih Semester</option>
            <option value="ganjil" {{ old('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
            <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
          </select>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="partial" {{ old('status') == 'partial' ? 'selected' : '' }}>Partial</option>
            <option value="declined" {{ old('status') == 'declined' ? 'selected' : '' }}>Declined</option>
          </select>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Total SKS</label>
          <input type="number" name="total_sks" value="{{ old('total_sks') }}" class="form-control" min="0" required>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" {{ $mahasiswa->isEmpty() ? 'disabled' : '' }}>Simpan</button>
          <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">Kembali ke Dashboard</a>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

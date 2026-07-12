<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kelas - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <p class="text-primary fw-semibold mb-1">Kelas</p>
            <h1 class="h3 mb-1">Edit Kelas</h1>
            <p class="text-muted mb-0">Perbarui jadwal kelas.</p>
        </div>
        <div class="d-flex flex-wrap gap-2 align-items-start">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ route('kelas.index') }}" class="btn btn-outline-primary">Data Kelas</a>
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

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-12 col-md-4">
            <label class="form-label">Kode Kelas</label>
            <input type="text" name="kode_kelas" value="{{ old('kode_kelas', $kelas->kode_kelas) }}" class="form-control" required>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Mata Kuliah</label>
            <select name="kode_mata_kuliah" class="form-select" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($matkuls as $mk)
                    <option value="{{ $mk->id }}" @selected(old('kode_mata_kuliah', $kelas->kode_mata_kuliah) == $mk->id)>
                        {{ $mk->Nama_Mata_Kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Dosen</label>
            <select name="kode_dosen" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dsn)
                    <option value="{{ $dsn->id }}" @selected(old('kode_dosen', $kelas->kode_dosen) == $dsn->id)>
                        {{ $dsn->Fullname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Hari</label>
            <select name="hari" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                <option value="senin" @selected(old('hari', $kelas->hari) == 'senin')>Senin</option>
                <option value="selasa" @selected(old('hari', $kelas->hari) == 'selasa')>Selasa</option>
                <option value="rabu" @selected(old('hari', $kelas->hari) == 'rabu')>Rabu</option>
                <option value="kamis" @selected(old('hari', $kelas->hari) == 'kamis')>Kamis</option>
                <option value="jumat" @selected(old('hari', $kelas->hari) == 'jumat')>Jumat</option>
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Jam</label>
            <select name="jam" class="form-select" required>
                <option value="">-- Pilih Jam --</option>
                <option value="08:00 - 09:40" @selected(old('jam', $kelas->jam) == '08:00 - 09:40')>08:00 - 09:40</option>
                <option value="09:50 - 11:30" @selected(old('jam', $kelas->jam) == '09:50 - 11:30')>09:50 - 11:30</option>
                <option value="12:30 - 14:10" @selected(old('jam', $kelas->jam) == '12:30 - 14:10')>12:30 - 14:10</option>
                <option value="17:00 - 18:40" @selected(old('jam', $kelas->jam) == '17:00 - 18:40')>17:00 - 18:40</option>
                <option value="19:00 - 20:40" @selected(old('jam', $kelas->jam) == '19:00 - 20:40')>19:00 - 20:40</option>
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $kelas->tahun_ajaran) }}" class="form-control" placeholder="2026/2027" required>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Ruang Kelas</label>
            <input type="text" name="ruang_kelas" value="{{ old('ruang_kelas', $kelas->ruang_kelas) }}" class="form-control" required>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label">Jumlah Max</label>
            <input type="number" name="jumlah_max" value="{{ old('jumlah_max', $kelas->jumlah_max) }}" class="form-control" min="1" required>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label d-block">Semester</label>
            <div class="form-check form-check-inline">
                <input type="radio" name="semester" value="ganjil" class="form-check-input" id="semesterGanjil" @checked(old('semester', $kelas->semester) == 'ganjil') required>
                <label class="form-check-label" for="semesterGanjil">Ganjil</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="semester" value="genap" class="form-check-input" id="semesterGenap" @checked(old('semester', $kelas->semester) == 'genap')>
                <label class="form-check-label" for="semesterGenap">Genap</label>
            </div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
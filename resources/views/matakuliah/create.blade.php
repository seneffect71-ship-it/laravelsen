<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-3 d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Tambah Mata Kuliah</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/matakuliah') }}" class="btn btn-outline-primary">Data Mata Kuliah</a>
        </div>
    </div>
    <form action="{{route('matakuliah.save')}}"  method="post" class="container mt-3">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table table-dark table-striped-columns">
            <tr>
                <td>Kode Mata Kuliah</td>
                <td>:</td>
                <td><input type="text" name="Kode_Mata_Kuliah" value="{{ old('Kode_Mata_Kuliah') }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Nama Mata Kuliah</td>
                <td>:</td>
                <td><input type="text" name="Nama_Mata_Kuliah" value="{{ old('Nama_Mata_Kuliah') }}" class="form-control"></td>
            </tr>
            <tr>
                <td>SKS</td>
                <td>:</td>
                <td><input type="number" name="SKS" value="{{ old('SKS') }}" min="1" class="form-control"></td>
            </tr>
            <tr>
                <td>Dosen Pengampu</td>
                <td>:</td>
                <td>
                    <select name="Dosen_Id" class="form-select" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}" @selected(old('Dosen_Id') == $dosen->id)>{{ $dosen->Fullname }}</option>
                        @endforeach
                    </select>
                    @if($dosens->isEmpty())
                        <div class="form-text text-danger">Belum ada data dosen. Tambahkan dosen dulu.</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>
                    <select name="Jurusan_Id" class="form-select" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" @selected(old('Jurusan_Id') == $jurusan->id)>{{ $jurusan->Nama_Jurusan }}</option>
                        @endforeach
                    </select>
                    @if($jurusans->isEmpty())
                        <div class="form-text text-danger">Belum ada data jurusan. Tambahkan jurusan dulu.</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Add" class="btn btn-primary" @disabled($dosens->isEmpty() || $jurusans->isEmpty())>
                    <input type="reset" value="Clear" class="btn btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

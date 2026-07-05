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
        <h2 class="h4 mb-0">Edit Mahasiswa</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/mahasiswa') }}" class="btn btn-outline-primary">Data Mahasiswa</a>
        </div>
    </div>
    <form action="{{route('mahasiswa.update', $mahasiswa->id)}}"  method="post" class="container mt-3">
        @csrf
        <input type="hidden" name="id" value="{{$mahasiswa->id}}">
        @method('PUT')
        <table class="table table-success table-striped-columns">
            <tr>
                <td>Nama lengkap</td>
                <td>:</td>
                <td><input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="form-control"></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control"></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><input type="text" name="nisn" value="{{ $mahasiswa->nisn }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" value="{{ $mahasiswa->alamat }}" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Update">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

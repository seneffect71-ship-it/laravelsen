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
        <h2 class="h4 mb-0">Edit Dosen</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/dosen') }}" class="btn btn-outline-primary">Data Dosen</a>
        </div>
    </div>
    <form action="{{route('dosen.update', $dosen->id)}}"  method="post" class="container mt-3">
        @csrf
        <input type="hidden" name="id" value="{{$dosen->id}}">
        @method('PUT')
        <table class="table table-success table-striped-columns">
            <tr>
                <td>Nama lengkap</td>
                <td>:</td>
                <td><input type="text" name="Fullname" value="{{ $dosen->Fullname }}" class="form-control"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><input type="text" name="NIP" value="{{ $dosen->NIP }}" class="form-control"></td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>:</td>
                <td><input type="text" name="NIDN" value="{{ $dosen->NIDN }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td><input type="text" name="Pendidikan_Terakhir" value="{{ $dosen->Pendidikan_Terakhir }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Jurusan Utama</td>
                <td>:</td>
                <td><input type="text" name="Jurusan_id" value="{{ $dosen->Jurusan_id }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="Tempat_Lahir" value="{{ $dosen->Tempat_Lahir }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="Tanggal_Lahir" value="{{ $dosen->Tanggal_Lahir }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="Alamat" value="{{ $dosen->Alamat }}" class="form-control"></td>
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

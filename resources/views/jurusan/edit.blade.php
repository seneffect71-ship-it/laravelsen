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
        <h2 class="h4 mb-0">Edit Jurusan</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
            <a href="{{ url('/jurusan') }}" class="btn btn-outline-primary">Data Jurusan</a>
        </div>
    </div>
    <form action="{{route('jurusan.update', $jurusan->id)}}"  method="post" class="container mt-3">
        @csrf
        <input type="hidden" name="id" value="{{$jurusan->id}}">
        @method('PUT')
        <table class="table table-success table-striped-columns">
            <tr>
                <td>Nama Jurusan</td>
                <td>:</td>
                <td><input type="text" name="Nama_Jurusan" value="{{ old('Nama_Jurusan', $jurusan->Nama_Jurusan) }}" class="form-control"></td>
            </tr>
            <tr>
                <td>Kode Jurusan</td>
                <td>:</td>
                <td><input type="text" name="Kode_Jurusan" value="{{ old('Kode_Jurusan', $jurusan->Kode_Jurusan) }}" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Update" class="btn btn-primary">
                    <input type="reset" value="Clear" class="btn btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

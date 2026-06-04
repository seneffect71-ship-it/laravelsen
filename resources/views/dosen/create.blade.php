<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <form action="{{route('dosen.save')}}"  method="post">
        @csrf
        <table class="table table-dark table-striped-columns">
            <tr>
                <td>Nama lengkap</td>
                <td>:</td>
                <td><input type="text" name="Fullname" class="form-control"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><input type="text" name="NIP" class="form-control"></td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>:</td>
                <td><input type="text" name="NIDN" class="form-control"></td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td><input type="text" name="Pendidikan_Terakhir" class="form-control"></td>
            </tr>
            <tr>
                <td>Jurusan Utama</td>
                <td>:</td>
                <td><input type="text" name="Jurusan_id" class="form-control"></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="Tempat_Lahir" class="form-control"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="Tanggal_Lahir" class="form-control"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="Alamat" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Add" class="btn btn-primary">
                    <input type="reset" value="Clear" class="btn btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
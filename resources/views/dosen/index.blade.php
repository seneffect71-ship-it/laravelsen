<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Dosen</h2>
            <a href="{{ route('dosen.add') }}" class="btn btn-primary">Create</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIP</th>
                    <th>NIDN</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Pendidikan Terakhir</th>
                    <th>Jurusan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dosen as $d)
            <tr>
                <td>{{$d->id}}</td>
                <td>{{$d->Fullname}}</td>
                <td>{{$d->NIP}}</td>
                <td>{{$d->NIDN}}</td>
                <td>{{$d->Tempat_Lahir}}</td>
                <td>{{$d->Tanggal_Lahir}}</td>
                <td>{{$d->Pendidikan_Terakhir}}</td>
                <td>{{$d->Jurusan_id}}</td>
                <td>{{$d->created_at}}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('dosen.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dosen.delete', $d->id) }}" method="post" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
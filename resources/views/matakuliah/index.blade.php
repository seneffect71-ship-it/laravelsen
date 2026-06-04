<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Mata Kuliah</h2>
            <a href="{{ route('matakuliah.add') }}" class="btn btn-primary">Create</a>
        </div>

        <table class="table table-striped">
            <thead>
            <th>No</th>
            <th>Jurusan</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>SKS</th>
            <th>Dosen Pengampu</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        @foreach ($matakuliah ?? [] as $m)
        <tr>
            <td>{{$m->id}}</td>
            <td>{{$m->Jurusan_Id}}</td>
            <td>{{$m->Kode_Mata_Kuliah}}</td>
            <td>{{$m->Nama_Mata_Kuliah}}</td>
            <td>{{$m->SKS}}</td>
            <td>{{$m->Dosen_Id}}</td>
            <td>{{$m->created_at}}</td>
            <td>
               <td class="d-flex gap-2">
                    <a href="{{ route('matakuliah.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('matakuliah.delete', $m->id) }}" method="post" onsubmit="return confirm('Hapus data ini?')">
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Kelas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <a href="{{ route('kelas.create') }}"
       class="btn btn-primary mb-3">

        Tambah Kelas

    </a>

    <table class="table table-bordered">

        <thead>

        <tr>
            <th>Kode Kelas</th>
            <th>Nama Dosen</th>
            <th>Nama Mata Kuliah</th>
            <th>Ruang Kelas</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Tahun Ajaran</th>
            <th>Aksi</th>
        </tr>

        </thead>

        <tbody>

        @foreach($kelas as $kls)

            <tr>

                <td>{{ $kls->kode_kelas }}</td>

                <td>{{ $kls->kode_dosen }}</td>

                <td>{{ $kls->kode_mata_kuliah }}</td>

                <td>{{ $kls->ruang_kelas }}</td>

                <td>{{ $kls->hari }}</td>

                <td>{{ $kls->jam }}</td>

                <td>{{ $kls->tahun_ajaran }}</td>

                <td>

                    <form action="{{ route('kelas.delete', $kls->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger">

                            Hapus Kelas

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

</body>
</html>
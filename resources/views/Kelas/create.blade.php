<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Kelas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2>Tambah Kelas</h2>

    <form action="{{ route('kelas.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">
            <label>Kode Kelas</label>

            <input type="text"
                   name="kode_kelas"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>

            <select name="kode_mata_kuliah"
                    class="form-control">

                @foreach($matkuls as $mk)

                    <option value="{{ $mk->id }}">
                        {{ $mk->Nama_Mata_Kuliah }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Dosen</label>

            <select name="kode_dosen"
                    class="form-control">

                @foreach($dosens as $dsn)

                    <option value="{{ $dsn->id }}">
                        {{ $dsn->nama }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Hari</label>

            <select name="hari"
                    class="form-control">

                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Jam</label>

            <select name="jam"
                    class="form-control">

                <option value="08:00 - 09:40">08:00 - 09:40</option>
                <option value="09:50 - 11:30">09:50 - 11:30</option>
                <option value="12:30 - 14:10">12:30 - 14:10</option>
                <option value="17:00 - 18:40">17:00 - 18:40</option>
                <option value="19:00 - 20:40">19:00 - 20:40</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Tahun Ajaran</label>

            <input type="text"
                   name="tahun_ajaran"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Ruang Kelas</label>

            <input type="text"
                   name="ruang_kelas"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Max</label>

            <input type="number"
                   name="jumlah_max"
                   class="form-control">
        </div>

        <div class="mb-3">

            <label>Semester</label>

            <br>

            <input type="radio"
                   name="semester"
                   value="ganjil">
            Ganjil

            <input type="radio"
                   name="semester"
                   value="genap">
            Genap

        </div>

        <button type="submit"
                class="btn btn-primary">
            Simpan
        </button>

    </form>

</div>

</body>
</html>
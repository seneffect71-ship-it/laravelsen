<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <img src="https://112005.sgp1.vultrobjects.com/sikad/gambar/Logo.gA1qr7iMLX.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=YGIP9T9E1N7J9K1U7NIC%2F20260514%2Fsgp1%2Fs3%2Faws4_request&X-Amz-Date=20260514T203745Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&x-id=GetObject&X-Amz-Signature=97c43795bdcaa209764f375d74ba8e93da28661f2c79cdeba4bb0f4b9ea321f6" style="width:40px; height:40px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\DosenController::class, 'index']) }}">Dosen</a></li>
                <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index']) }}">Mahasiswa</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\JurusanController::class, 'index']) }}">Jurusan</a></li>
                <li><a class="dropdown-item" href="{{ action([App\Http\Controllers\MataKuliahController::class, 'index']) }}">Mata Kuliah</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <h1>Dashboard ITBSS</h1>
          <p class="text-muted">Selamat datang di Sistem Informasi Akademik</p>
          
          <div class="row mt-4">
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Dosen</h5>
                  <p class="card-text text-muted">Kelola data dosen</p>
                  <a href="{{ action([App\Http\Controllers\DosenController::class, 'index']) }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mahasiswa</h5>
                  <p class="card-text text-muted">Kelola data mahasiswa</p>
                  <a href="{{ action([App\Http\Controllers\MahasiswaController::class, 'index']) }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mata Kuliah</h5>
                  <p class="card-text text-muted">Kelola mata kuliah</p>
                  <a href="{{ action([App\Http\Controllers\MataKuliahController::class, 'index']) }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Jurusan</h5>
                  <p class="card-text text-muted">Kelola jurusan</p>
                  <a href="{{ action([App\Http\Controllers\JurusanController::class, 'index']) }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

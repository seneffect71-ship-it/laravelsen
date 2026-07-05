<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .register-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        padding: 40px;
        max-width: 500px;
        width: 100%;
      }
      .register-container h3 {
        color: #333;
        margin-bottom: 10px;
        font-weight: 600;
      }
      .register-container p {
        color: #666;
        margin-bottom: 30px;
        font-size: 14px;
      }
      .form-label {
        color: #333;
        font-weight: 500;
        margin-bottom: 8px;
      }
      .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px 15px;
        font-size: 14px;
      }
      .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      }
      .btn-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 5px;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
        transition: transform 0.2s;
      }
      .btn-register:hover {
        transform: translateY(-2px);
        color: white;
      }
      .login-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
        font-size: 14px;
      }
      .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
      }
      .alert {
        border-radius: 5px;
        margin-bottom: 20px;
      }
      .hidden-form {
        display: none;
      }
      .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
      }
      .logo-container img {
        height: 60px;
        width: 60px;
        object-fit: contain;
      }
    </style>
  </head>
  <body>
    <div class="register-container">
      <div class="logo-container">
        <img src="{{ asset('images/logo-itbss.png') }}" alt="ITBSS Logo" />
      </div>
      <h3>ITBSS — Daftar</h3>
      <p>Buat akun baru sebagai Mahasiswa atau Dosen</p>

      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="/register">
        @csrf
        
        <!-- Role Selection -->
        <div class="mb-3">
          <label for="roleSelect" class="form-label">Daftar Sebagai</label>
          <select class="form-select" id="roleSelect" name="role" required onchange="updateForm()">
            <option value="">-- Pilih --</option>
            <option value="mahasiswa" @selected(old('role') == 'mahasiswa')>Mahasiswa</option>
            <option value="dosen" @selected(old('role') == 'dosen')>Dosen</option>
          </select>
        </div>

        <!-- Mahasiswa Form -->
        <div id="mahasiswaForm" class="hidden-form">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="nim" class="form-label">NIM (Nomor Induk Mahasiswa)</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Cth: 123456">
            @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Cth: 0012345678">
            @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Cth: Jakarta">
            @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <!-- Dosen Form -->
        <div id="dosenForm" class="hidden-form">
          <div class="mb-3">
            <label for="fullname" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{ old('fullname') }}" placeholder="Masukkan nama lengkap">
            @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="nip" class="form-label">NIP (Nomor Induk Pegawai)</label>
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Cth: 987654">
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="nidn" class="form-label">NIDN (Nomor Induk Dosen Nasional)</label>
            <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn') }}" placeholder="Cth: 0987654321">
            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
              <option value="">-- Pilih --</option>
              <option value="SMA" @selected(old('pendidikan_terakhir') == 'SMA')>SMA</option>
              <option value="SMK" @selected(old('pendidikan_terakhir') == 'SMK')>SMK</option>
              <option value="D3" @selected(old('pendidikan_terakhir') == 'D3')>D3</option>
              <option value="S1" @selected(old('pendidikan_terakhir') == 'S1')>S1</option>
              <option value="S2" @selected(old('pendidikan_terakhir') == 'S2')>S2</option>
              <option value="S3" @selected(old('pendidikan_terakhir') == 'S3')>S3</option>
            </select>
            @error('pendidikan_terakhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan Utama</label>
            <input type="text" class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" value="{{ old('jurusan_id') }}" placeholder="Cth: Informatika">
            @error('jurusan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="tempat_lahir_dosen" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempat_lahir_dosen') is-invalid @enderror" id="tempat_lahir_dosen" name="tempat_lahir_dosen" value="{{ old('tempat_lahir_dosen') }}" placeholder="Cth: Surabaya">
            @error('tempat_lahir_dosen') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal_lahir_dosen" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir_dosen') is-invalid @enderror" id="tanggal_lahir_dosen" name="tanggal_lahir_dosen" value="{{ old('tanggal_lahir_dosen') }}">
            @error('tanggal_lahir_dosen') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="alamat_dosen" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat_dosen') is-invalid @enderror" id="alamat_dosen" name="alamat_dosen" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat_dosen') }}</textarea>
            @error('alamat_dosen') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <button type="submit" class="btn btn-register">Daftar</button>
      </form>

      <div class="login-link">
        Sudah punya akun? <a href="/login">Login di sini</a>
      </div>
    </div>

    <script>
      function updateForm() {
        const role = document.getElementById('roleSelect').value;
        const mahasiswaForm = document.getElementById('mahasiswaForm');
        const dosenForm = document.getElementById('dosenForm');
        const mahasiswaFields = mahasiswaForm.querySelectorAll('input, select, textarea');
        const dosenFields = dosenForm.querySelectorAll('input, select, textarea');

        mahasiswaFields.forEach((field) => field.disabled = role !== 'mahasiswa');
        dosenFields.forEach((field) => field.disabled = role !== 'dosen');

        if (role === 'mahasiswa') {
          mahasiswaForm.classList.remove('hidden-form');
          dosenForm.classList.add('hidden-form');
        } else if (role === 'dosen') {
          dosenForm.classList.remove('hidden-form');
          mahasiswaForm.classList.add('hidden-form');
        } else {
          mahasiswaForm.classList.add('hidden-form');
          dosenForm.classList.add('hidden-form');
        }
      }

      // Show form on page load if role was selected
      window.addEventListener('DOMContentLoaded', function() {
        updateForm();
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

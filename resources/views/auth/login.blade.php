<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ITBSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body { background: linear-gradient(135deg,#f5f7fa,#c3cfe2); }
      .card-auth { max-width:720px; margin:48px auto; box-shadow:0 6px 18px rgba(0,0,0,0.08); }
      .brand { font-weight:700; letter-spacing:1px; }
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
    <div class="card card-auth">
      <div class="row g-0">
        <div class="col-md-6 p-4">
          <div class="p-3">
            <div class="logo-container">
              <img src="{{ asset('images/logo-itbss.png') }}" alt="ITBSS Logo" />
            </div>
            <h3 class="brand">ITBSS — Login</h3>
            <p class="text-muted">Masuk sebagai Mahasiswa atau Dosen untuk mengakses dashboard.</p>

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" id="roleSelect" class="form-select" required>
                  <option value="mahasiswa" {{ old('role')=='mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                  <option value="dosen" {{ old('role')=='dosen' ? 'selected' : '' }}>Dosen</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Pilih User</label>
                <select name="user_id" id="userSelect" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  @foreach($mahasiswa as $m)
                    <option data-role="mahasiswa" value="{{ $m->id }}">[M] {{ $m->nama }} ({{ $m->nim }})</option>
                  @endforeach
                  @foreach($dosen as $d)
                    <option data-role="dosen" value="{{ $d->id }}">[D] {{ $d->Fullname }} ({{ $d->NIP ?? '' }})</option>
                  @endforeach
                </select>
                <div class="form-text">Tidak perlu password untuk demo; pilih user lalu tekan Login.</div>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary">Login</button>
              </div>

              <div class="text-center mt-3">
                <p class="text-muted">Belum punya akun? <a href="/register" class="text-primary fw-bold">Daftar di sini</a></p>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 d-none d-md-flex align-items-center" style="background:#fff;">
          <div class="p-4">
            <h4>Selamat datang</h4>
            <p class="text-muted">Akses cepat untuk mengelola data dosen, mahasiswa, mata kuliah, dan jurusan.</p>
            <ul>
              <li>Design konsisten dengan Bootstrap</li>
              <li>Mudah digunakan untuk demo dan testing</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script>
      // auto-filter options by selected role
      const roleSelect = document.getElementById('roleSelect');
      const userSelect = document.getElementById('userSelect');
      function filterByRole(){
        const role = roleSelect.value;
        for(const opt of userSelect.options){
          if(!opt.value) continue;
          const r = opt.dataset.role;
          opt.style.display = (r===role) ? '' : 'none';
        }
      }
      roleSelect.addEventListener('change', filterByRole);
      filterByRole();
    </script>
  </body>
</html>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container py-4">
  <h2>Tambah Admin</h2>

  @if($errors->any())
    <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" class="form-control" type="email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" class="form-control" type="password" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input name="password_confirmation" class="form-control" type="password" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
  </form>
</main>
</body>
</html>
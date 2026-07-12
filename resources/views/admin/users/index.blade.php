<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Admin - Users</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah Admin</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <tr><th>#</th><th>Name</th><th>Email</th><th class="text-end">Aksi</th></tr>
    </thead>
    <tbody>
      @foreach($users as $u)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td class="text-end">
            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div>@if(isset($users) && method_exists($users, 'links')) {{ $users->links() }} @endif</div>
</main>
</body>
</html>
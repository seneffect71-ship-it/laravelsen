<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function requireAdmin()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect('/dashboard')->with('message', 'Akses tidak diizinkan.');
        }
        return null;
    }

    public function index()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('admin.users.index', [
            'users' => User::latest()->paginate(12)
        ]);
    }

    public function create()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user created.');
    }

    public function destroy($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $user = User::find($id);
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}

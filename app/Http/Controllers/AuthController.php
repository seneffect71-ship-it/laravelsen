<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', [
            'mahasiswa' => Mahasiswa::all(),
            'dosen' => Dosen::all(),
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|in:mahasiswa,dosen',
            'user_id' => 'required|integer'
        ]);

        if ($data['role'] === 'mahasiswa') {
            $user = Mahasiswa::find($data['user_id']);
        } else {
            $user = Dosen::find($data['user_id']);
        }

        if (! $user) {
            return redirect()->back()->withErrors(['user_id' => 'User tidak ditemukan'])->withInput();
        }

        session(['user' => [
            'id' => $user->id,
            'role' => $data['role'],
            'name' => $user->nama ?? ($user->Fullname ?? 'User')
        ]]);

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $role = $request->input('role');

        if ($role === 'mahasiswa') {
            $data = $request->validate([
                'role' => 'required|in:mahasiswa,dosen',
                'nama' => 'required|string|max:255',
                'nim' => 'required|string|max:255',
                'nisn' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
            ]);

            Mahasiswa::create([
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'nisn' => $data['nisn'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat' => $data['alamat'],
            ]);

        } else if ($role === 'dosen') {
            $data = $request->validate([
                'role' => 'required|in:mahasiswa,dosen',
                'fullname' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'nidn' => 'required|string|max:255',
                'pendidikan_terakhir' => 'required|string|max:255',
                'jurusan_id' => 'required|string|max:255',
                'tempat_lahir_dosen' => 'required|string|max:255',
                'tanggal_lahir_dosen' => 'required|date',
                'alamat_dosen' => 'required|string',
            ]);

            Dosen::create([
                'Fullname' => $data['fullname'],
                'NIP' => $data['nip'],
                'NIDN' => $data['nidn'],
                'Pendidikan_Terakhir' => $data['pendidikan_terakhir'],
                'Jurusan_id' => $data['jurusan_id'],
                'Tempat_Lahir' => $data['tempat_lahir_dosen'],
                'Tanggal_Lahir' => $data['tanggal_lahir_dosen'],
                'Alamat' => $data['alamat_dosen'],
            ]);

        } else {
            return redirect()->back()->withErrors(['role' => 'Role tidak valid'])->withInput();
        }

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}

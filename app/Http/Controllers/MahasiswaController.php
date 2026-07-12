<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Check if user has admin role, redirect if not.
     */
    private function requireAdmin()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect('/dashboard')->with('message', 'Akses tidak diizinkan.');
        }
        return null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index', [
            'mahasiswa' => Mahasiswa::latest()->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('mahasiswa.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->except('_token');

        Mahasiswa::create($data);

        return redirect()->action([MahasiswaController::class, 'index'])->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.index')->with('message', 'Mahasiswa tidak ditemukan.');
        }
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('mahasiswa.edit', [
            'mahasiswa' => Mahasiswa::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->except('_token', 'id', '_method');

        Mahasiswa::find($id)->update($data);

        return redirect()->action([MahasiswaController::class, 'index'])->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        Mahasiswa::find($id)->delete();

        return redirect()->action([MahasiswaController::class, 'index'])->with('success', 'Data mahasiswa berhasil dihapus.');
    }    
}

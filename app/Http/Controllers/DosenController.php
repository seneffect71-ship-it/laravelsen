<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
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
        return view('dosen.index', [
            'dosen' => Dosen::latest()->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('dosen.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->except('_token');

        Dosen::create($data);

        return redirect()->action([DosenController::class, 'index'])->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return redirect()->route('dosen.index')->with('message', 'Dosen tidak ditemukan.');
        }
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('dosen.edit', [
            'dosen' => Dosen::find($id)
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

        Dosen::find($id)->update($data);

        return redirect()->action([DosenController::class, 'index'])->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        Dosen::find($id)->delete();

        return redirect()->action([DosenController::class, 'index'])->with('success', 'Data dosen berhasil dihapus.');
    }    
}

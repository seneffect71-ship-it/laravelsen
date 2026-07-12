<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
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
        return view('jurusan.index', [
            'jurusan' => Jurusan::latest()->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('jurusan.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->validate([
            'Kode_Jurusan' => 'required|unique:table_jurusan,Kode_Jurusan',
            'Nama_Jurusan' => 'required',
        ]);

        Jurusan::create($data);

        return redirect()->action([JurusanController::class, 'index'])->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jurusan = Jurusan::find($id);
        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('message', 'Jurusan tidak ditemukan.');
        }
        return view('jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('jurusan.edit', [
            'jurusan' => Jurusan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->validate([
            'Kode_Jurusan' => 'required|unique:table_jurusan,Kode_Jurusan,'.$id,
            'Nama_Jurusan' => 'required',
        ]);

        Jurusan::find($id)->update($data);

        return redirect()->action([JurusanController::class, 'index'])->with('success', 'Data jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        Jurusan::find($id)->delete();

        return redirect()->action([JurusanController::class, 'index'])->with('success', 'Data jurusan berhasil dihapus.');
    }    
}

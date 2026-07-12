<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
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
        return view('matakuliah.index', [
            'matakuliah' => MataKuliah::with(['dosen', 'jurusan'])->latest()->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('matakuliah.create', [
            'dosens' => Dosen::orderBy('Fullname')->get(),
            'jurusans' => Jurusan::orderBy('Nama_Jurusan')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        $data = $request->validate([
            'Kode_Mata_Kuliah' => 'required|unique:table_mata_kuliah,Kode_Mata_Kuliah',
            'Nama_Mata_Kuliah' => 'required',
            'SKS' => 'required|integer',
            'Dosen_Id' => 'required|exists:table_dosen,id',
            'Jurusan_Id' => 'required|exists:table_jurusan,id',
        ]);

        MataKuliah::create($data);

        return redirect()->action([MataKuliahController::class, 'index'])->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matakuliah = MataKuliah::with(['dosen', 'jurusan'])->find($id);
        if (!$matakuliah) {
            return redirect()->route('matakuliah.index')->with('message', 'Mata kuliah tidak ditemukan.');
        }
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        return view('matakuliah.edit', [
            'matakuliah' => MataKuliah::findOrFail($id),
            'dosens' => Dosen::orderBy('Fullname')->get(),
            'jurusans' => Jurusan::orderBy('Nama_Jurusan')->get(),
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
            'Kode_Mata_Kuliah' => 'required|unique:table_mata_kuliah,Kode_Mata_Kuliah,'.$id,
            'Nama_Mata_Kuliah' => 'required',
            'SKS' => 'required|integer',
            'Dosen_Id' => 'required|exists:table_dosen,id',
            'Jurusan_Id' => 'required|exists:table_jurusan,id',
        ]);

        MataKuliah::findOrFail($id)->update($data);

        return redirect()->action([MataKuliahController::class, 'index'])->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;

        MataKuliah::find($id)->delete();

        return redirect()->action([MataKuliahController::class, 'index'])->with('success', 'Data mata kuliah berhasil dihapus.');
    }    
}

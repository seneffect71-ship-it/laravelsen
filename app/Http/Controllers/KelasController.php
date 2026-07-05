<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('kelas.index', [
            'kelas' => Kelas::with(['dosen', 'mataKuliah'])->latest()->get()
        ]);
    }

    public function create()
    {
        return view('kelas.create', [
            'dosens' => Dosen::all(),
            'matkuls' => MataKuliah::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_kelas' => 'required|string|max:255',
            'kode_mata_kuliah' => 'required|exists:table_mata_kuliah,id',
            'kode_dosen' => 'required|exists:table_dosen,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'jam' => 'required|in:08:00 - 09:40,09:50 - 11:30,12:30 - 14:10,17:00 - 18:40,19:00 - 20:40',
            'tahun_ajaran' => 'required|string|max:255',
            'ruang_kelas' => 'required|string|max:255',
            'jumlah_max' => 'required|integer|min:1',
            'semester' => 'required|in:ganjil,genap',
        ]);

        Kelas::create($data);

        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Kelas::find($id)->delete();

        return redirect('/kelas');
    }
}

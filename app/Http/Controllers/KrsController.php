<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        return view('krs.index', [
            'krs' => Krs::with('mahasiswa')->get()
        ]);
    }

    public function create()
    {
        return view('krs.create', [
            'mahasiswa' => Mahasiswa::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_mahasiswa' => 'required|exists:mahasiswa,id',
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
            'status' => 'required|in:pending,approved,partial,declined',
            'total_sks' => 'required|integer|min:0'
        ]);

        Krs::create($data);

        return redirect('/krs');
    }

    public function destroy($id)
    {
        Krs::find($id)->delete();

        return redirect('/krs');
    }
}
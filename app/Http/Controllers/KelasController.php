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
            'kelas' => Kelas::all()
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
        $data = $request->except('_token');

        Kelas::create($data);

        return redirect('/kelas');
    }

    public function destroy($id)
    {
        Kelas::find($id)->delete();

        return redirect('/kelas');
    }
}
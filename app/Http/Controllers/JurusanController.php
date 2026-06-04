<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jurusan.index', [
            'jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Kode_Jurusan' => 'required|unique:table_jurusan,Kode_Jurusan',
            'Nama_Jurusan' => 'required',
        ]);

        Jurusan::create($data);

        return redirect()->action([JurusanController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Jurusan::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('jurusan.edit', [
            'jurusan' => Jurusan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Kode_Jurusan' => 'required|unique:table_jurusan,Kode_Jurusan,'.$id,
            'Nama_Jurusan' => 'required',
        ]);

        Jurusan::find($id)->update($data);

        return redirect()->action([JurusanController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Jurusan::find($id)->delete();

        return redirect()->action([JurusanController::class, 'index']);
    }    
}
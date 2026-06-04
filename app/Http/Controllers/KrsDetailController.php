<?php

namespace App\Http\Controllers;

use App\Models\KrsDetail;
use App\Models\Kelas;
use App\Models\Krs;
use Illuminate\Http\Request;

class KrsDetailController extends Controller
{
    public function index()
    {
        return view('krs_detail.index', [
            'detail' => KrsDetail::all()
        ]);
    }

    public function create()
    {
        return view('krs_detail.create', [
            'kelas' => Kelas::all(),
            'krs' => Krs::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        KrsDetail::create($data);

        return redirect('/krs-detail');
    }

    public function destroy($id)
    {
        KrsDetail::find($id)->delete();

        return redirect('/krs-detail');
    }
}
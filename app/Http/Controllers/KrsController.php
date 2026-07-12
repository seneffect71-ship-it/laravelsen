<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $user = session('user');

        if (! $user) {
            return redirect('/login');
        }

        // Admin and Dosen see all; Mahasiswa sees only their own KRS
        if ($user['role'] === 'mahasiswa') {
            $krs = Krs::with('mahasiswa')->where('kode_mahasiswa', $user['id'])->latest()->paginate(12);
        } else {
            $krs = Krs::with('mahasiswa')->latest()->paginate(12);
        }

        return view('krs.index', [
            'krs' => $krs
        ]);
    }

    public function create()
    {
        $user = session('user');
        // Dosen tidak boleh membuat KRS
        if ($user['role'] === 'dosen') {
            return redirect('/krs')->with('message', 'Akses tidak diizinkan.');
        }

        return view('krs.create', [
            'mahasiswa' => Mahasiswa::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = session('user');

        // Dosen tidak boleh membuat KRS
        if ($user['role'] === 'dosen') {
            return redirect('/krs')->with('message', 'Akses tidak diizinkan.');
        }

        $rules = [
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
            'status' => 'required|in:pending,approved,partial,declined',
            'total_sks' => 'required|integer|min:0'
        ];

        // Admin harus pilih mahasiswa; mahasiswa auto pakai id-nya sendiri
        if ($user['role'] === 'admin') {
            $rules['mahasiswa_id'] = 'required|exists:mahasiswa,id';
        }

        $data = $request->validate($rules);

        // Jika role mahasiswa, enforce mahasiswa_id miliknya.
        if ($user['role'] === 'mahasiswa') {
            $data['mahasiswa_id'] = $user['id'];
        }

        // Sinkronkan key input -> kolom tabel (krs.kode_mahasiswa)
        $krsData = [
            'kode_mahasiswa' => $data['mahasiswa_id'],
            'tahun_ajaran' => $data['tahun_ajaran'],
            'semester' => $data['semester'],
            'status' => $data['status'],
            'total_sks' => $data['total_sks'],
        ];

        // Guard tambahan: mencegah NOT NULL error jika session/field kosong
        if (empty($krsData['kode_mahasiswa'])) {
            return back()->withInput()->with('message', 'Mahasiswa belum dipilih.');
        }

        Krs::create($krsData);

        return redirect('/krs')->with('success', 'KRS berhasil dibuat.');
    }

    public function destroy($id)
    {
        $user = session('user');

        // Hanya admin yang boleh hapus KRS
        if ($user['role'] !== 'admin') {
            return redirect('/krs')->with('message', 'Akses tidak diizinkan.');
        }

        $krs = Krs::find($id);
        if (! $krs) {
            return redirect()->back()->with('message', 'KRS tidak ditemukan.');
        }

        $krs->delete();

        return redirect('/krs')->with('success', 'KRS berhasil dihapus.');
    }

    /**
     * Update status of KRS (used by Dosen for approval/reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $user = session('user');
        // Hanya dosen dan admin yang bisa approve/reject
        if (! in_array($user['role'], ['dosen', 'admin'])) {
            return redirect('/krs')->with('message', 'Akses tidak diizinkan.');
        }

        $data = $request->validate([
            'status' => 'required|in:pending,approved,partial,declined'
        ]);

        $krs = Krs::find($id);
        if (! $krs) {
            return redirect()->back()->with('message', 'KRS tidak ditemukan.');
        }

        $krs->status = $data['status'];
        $krs->save();

        return redirect()->back()->with('success', 'Status KRS diperbarui.');
    }

    /**
     * Display a specific KRS with its details.
     */
    public function show($id)
    {
        $user = session('user');

        $krs = Krs::with('mahasiswa')->findOrFail($id);

        // Mahasiswa may only view their own KRS
        if ($user && $user['role'] === 'mahasiswa' && $krs->kode_mahasiswa != $user['id']) {
            return redirect('/krs')->with('message', 'Akses ditolak.');
        }

        $details = [];

        return view('krs.show', [
            'krs' => $krs,
            'details' => $details
        ]);
    }

    /**
     * Show KRS list for Dosen approval.
     */
    public function indexForDosen()
    {
        $krs = Krs::with('mahasiswa')
            ->latest()
            ->paginate(12);

        return view('krs.index_dosen', [
            'krs' => $krs
        ]);
    }
}

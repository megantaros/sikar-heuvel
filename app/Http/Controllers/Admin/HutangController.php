<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hutang;
use App\Models\Karyawan;
use Carbon\Carbon;

class HutangController extends Controller
{
    public function index()
    {
        $hutangs = Hutang::with('karyawan')->get();
        return view('admin.hutang.index', compact('hutangs'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('admin.hutang.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id',
            'total_hutang' => 'required|numeric',
            'maksimal_hutang' => 'required|numeric',
        ]);

        // Hitung nilai sisa_hutang
        $sisa_hutang = $request->total_hutang - $request->hutang_terbayar;

        // Gunakan Carbon untuk mendapatkan tanggal hari ini
        $tanggal_hutang = Carbon::now();

        Hutang::create([
            'id_karyawan' => $request->id_karyawan,
            'total_hutang' => $request->total_hutang,
            'sisa_hutang' => $sisa_hutang,
            'maksimal_hutang' => $request->maksimal_hutang,
            'tanggal_hutang' => $tanggal_hutang,
        ]);

        return redirect()
            ->route('hutang.index')
            ->with('success', 'Data hutang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $hutang = Hutang::with('karyawan')->findOrFail($id);
        return view('admin.hutang.show', compact('hutang'));
    }

    public function edit($id)
    {
        $hutang = Hutang::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('admin.hutang.edit', compact('hutang', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total_hutang' => 'required|numeric|min:0',
        ]);

        // Hitung nilai sisa_hutang
        $sisa_hutang = $request->total_hutang - $request->hutang_terbayar;

        // Temukan data Hutang berdasarkan ID
        $hutang = Hutang::findOrFail($id);

        // Update data termasuk sisa_hutang yang sudah dihitung
        $hutang->update([
            'total_hutang' => $request->total_hutang,
            'hutang_terbayar' => $request->hutang_terbayar,
            'sisa_hutang' => $sisa_hutang,
            'status_hutang' => $request->status_hutang,
        ]);

        return redirect()
            ->route('hutang.index')
            ->with('success', 'Data hutang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->delete();

        return redirect()
            ->route('hutang.index')
            ->with('success', 'Data hutang berhasil dihapus.');
    }
}
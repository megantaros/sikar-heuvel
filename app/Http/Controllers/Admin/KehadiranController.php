<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Karyawan;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::with('karyawan')->get();
        $karyawan = Karyawan::all();
        return view('admin.kehadiran.index', compact('kehadiran', 'karyawan'));
    }

    public function store(Request $request)
    {
        Kehadiran::create($request->all());
        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $karyawan = Karyawan::all();

        return view('admin.kehadiran.edit', compact('kehadiran', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        Kehadiran::findOrFail($id)->update($request->all());
        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kehadiran = Kehadiran::find($id);
        if ($kehadiran) {
            $kehadiran->delete();
            return redirect()
                ->route('kehadiran.index')
                ->with('success', 'Data kehadiran berhasil dihapus.');
        } else {
            return redirect()
                ->route('kehadiran.index')
                ->with('error', 'Data kehadiran tidak ditemukan.');
        }
    }
}

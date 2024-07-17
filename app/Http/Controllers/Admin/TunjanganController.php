<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tunjangan;
use App\Models\Karyawan;
use App\Models\Gaji;

class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        $gaji = Gaji::all();
        $tunjangan = Tunjangan::with('karyawan', 'gaji')->get();
        return view('admin.tunjangan.index', compact('tunjangan', 'karyawan', 'gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        $gaji = Gaji::all();
        return view('admin.tunjangan.index', compact('karyawan', 'gaji'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'id_gaji' => 'required',
            'nama_tunjangan' => 'required',
            'nominal' => 'required|numeric',
        ]);

        Tunjangan::create($request->all());

        return redirect()->route('tunjangan.index')->with('success', 'Tunjangan created successfully.');
    }

    public function edit(Tunjangan $tunjangan)
    {
        $karyawan = Karyawan::all();
        $gaji = Gaji::all();
        return view('admin.tunjangan.edit', compact('tunjangan', 'karyawan', 'gaji'));
    }

    public function update(Request $request, Tunjangan $tunjangan)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'id_gaji' => 'required',
            'nama_tunjangan' => 'required',
            'nominal' => 'required|numeric',
        ]);

        $tunjangan->update($request->all());

        return redirect()->route('tunjangan.index')->with('success', 'Tunjangan updated successfully.');
    }

    public function destroy($id)
    {
        Tunjangan::destroy($id);

        return redirect()->route('tunjangan.index')->with('success', 'Tunjangan deleted successfully.');
    }
}
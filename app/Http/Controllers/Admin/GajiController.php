<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Tunjangan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GajiController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        $tunjangan = Tunjangan::all();
        $gaji = Gaji::with('karyawan')->get();

        $tunjanganPerKaryawan = [];
        foreach ($tunjangan as $t) {
            if (!isset($tunjanganPerKaryawan[$t->id_karyawan])) {
                $tunjanganPerKaryawan[$t->id_karyawan] = 0;
            }
            $tunjanganPerKaryawan[$t->id_karyawan] += $t->nominal;
        }

        $result = [];

        if (auth()->user()->role == 'karyawan') {
            $kar = Karyawan::where('id_user', auth()->user()->id)->first();
            $karyawan = Karyawan::all();

            $gaji = $gaji->filter(function ($g) use ($kar) {
                return $g->id_karyawan == $kar->id;
            });
        }

        function formatRupiah($angka)
        {
            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
            return $hasil_rupiah;
        }

        foreach ($gaji as $g) {
            $result[] = [
                'id' => $g->id,
                'id_karyawan' => $g->id_karyawan,
                'id_tunjangan' => $tunjanganPerKaryawan[$g->id_karyawan] ?? 0,
                'nama' => $g->karyawan->nama_karyawan,
                'jabatan' => $g->karyawan->jabatan,
                'gaji' => formatRupiah($g->gaji),
                'nama_tunjangan' => $tunjangan->where('id_karyawan', $g->id_karyawan)->pluck('nama_tunjangan')->implode(', '),
                'per_tunjangan' => $tunjangan->where('id_karyawan', $g->id_karyawan)->pluck('nominal')->implode(', '),
                'total_tunjangan' => formatRupiah($tunjangan->where('id_karyawan', $g->id_karyawan)->pluck('nominal')->sum()),
                'detail_tunjangan' => $tunjangan->where('id_karyawan', $g->id_karyawan),
            ];
        }

        return view(
            'admin.gaji.index',
            compact('result', 'karyawan', 'tunjangan')
        );
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        $tunjangan = Tunjangan::all();
        return view('admin.gaji.index', compact('karyawan', 'tunjangan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_karyawan' => 'required',
            'id_tunjangan' => 'nullable',
            'gaji' => 'required|numeric',
        ]);

        Gaji::create($validatedData);

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil disimpan.');
    }

    public function edit(Gaji $gaji)
    {
        $karyawan = Karyawan::all();
        $tunjangan = Tunjangan::all();
        return view(
            'admin.gaji.index',
            compact('gaji', 'karyawan', 'tunjangan')
        );
    }

    public function update(Request $request, Gaji $gaji)
    {
        $validatedData = $request->validate([
            'id_karyawan' => 'required',
            'id_tunjangan' => 'nullable',
            'gaji' => 'required|numeric',
        ]);

        $gaji->update($validatedData);

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Gaji $gaji)
    {
        $gaji->delete();

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }

    public function print($id)
    {
        $gaji = Gaji::with('karyawan')->findOrFail($id);
        $tunjangan = Tunjangan::where('id_karyawan', $gaji->id_karyawan)->get();

        // Buat logic untuk menyiapkan data slip gaji dalam bentuk HTML atau PDF
        $data = [
            'gaji' => $gaji,
            'tunjangan' => $tunjangan,
            'total_tunjangan' => $tunjangan->pluck('nominal')->sum(),
            'total_gaji' => $gaji->gaji + $tunjangan->pluck('nominal')->sum(),
        ];

        // Misalnya, jika menggunakan PDF (Contoh menggunakan DomPDF)
        $pdf = PDF::loadView('admin.gaji.slip', $data);

        return $pdf->download(
            'slip_gaji_' . $gaji->karyawan->nama_karyawan . '.pdf'
        );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Gaji;
use App\Models\Hutang;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Tunjangan;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalTunjangan = Tunjangan::count() ?? 0;

        if (auth()->user()->role == 'karyawan') {
            $karyawan = Karyawan::where('id_user', auth()->user()->id)->first();

            $totalKehadiran = Kehadiran::where('id_karyawan', $karyawan->id)->count() ?? 0;
            $totalHutang = Hutang::where('id_karyawan', $karyawan->id)->count() ?? 0;
            $hutang = Hutang::where('id_karyawan', $karyawan->id)->first() ?? null;

            // Pastikan hutang tidak null sebelum mengakses properti id
            $totalAngsuran = $hutang ? Angsuran::where('hutang_id', $hutang->id)->count() : 0;

            $gaji = Gaji::where('id_karyawan', $karyawan->id)->first()->gaji ?? 0;
            $tunjangan = Tunjangan::where('id_karyawan', $karyawan->id)->first()->nominal ?? 0;
            $totalGaji = $gaji + $tunjangan;


            function formatRupiah($angka)
            {
                $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
                return $hasil_rupiah;
            }

            return view('admin.dashboard', [
                'totalKehadiran' => $totalKehadiran,
                'totalHutang' => $totalHutang,
                'totalAngsuran' => $totalAngsuran,
                'totalGaji' => formatRupiah($totalGaji),
            ]);
        }

        return view('admin.dashboard', [
            'totalKaryawan' => $totalKaryawan,
            'totalAdmin' => $totalAdmin,
            'totalTunjangan' => $totalTunjangan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
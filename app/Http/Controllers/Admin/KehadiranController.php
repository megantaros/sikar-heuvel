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

        if (auth()->user()->role == 'karyawan') {
            $kar = Karyawan::where('id_user', auth()->user()->id)->first();

            $kehadiran = Kehadiran::where('id_karyawan', $kar->id)->get();
            $karyawan = Karyawan::all();

            $isPresensiMasuk = Kehadiran::where('id_karyawan', $kar->id)
                ->where('tanggal', date('Y-m-d'))
                ->whereNotNull('jam_hadir')
                ->first();

            $isPresensiPulang = Kehadiran::where('id_karyawan', $kar->id)
                ->where('tanggal', date('Y-m-d'))
                ->whereNotNull('jam_pulang')
                ->first();

            return view('admin.kehadiran.index', compact('kehadiran', 'karyawan', 'isPresensiMasuk', 'isPresensiPulang'));
        }

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

    public function presensiMasuk(Request $request)
    {
        $jamHadir = date('H:i:s');
        $tanggal = date('Y-m-d');
        $tepatWaktu = 0;
        $telat = 0;
        $bonus = 0;
        $denda = 0;
        $statusKehadiran = '';

        if ($jamHadir <= '08:00:00') {
            $tepatWaktu = 1;
            $bonus = 50000;
            $statusKehadiran = 'Tepat Waktu';
        } else {
            $telat = 1;
            $denda = 50000;
            $statusKehadiran = 'Terlambat';
        }

        $karyawan = Karyawan::where('id_user', auth()->user()->id)->first();

        Kehadiran::create([
            'id_karyawan' => $karyawan->id,
            'jam_hadir' => $jamHadir,
            'tanggal' => $tanggal,
            'tepat_waktu' => $tepatWaktu,
            'telat' => $telat,
            'bonus' => $bonus,
            'denda' => $denda,
            'status_kehadiran' => $statusKehadiran,
        ]);

        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Presensi masuk berhasil.');
    }

    public function presensiPulang(Request $request)
    {
        $jamPulang = date('H:i:s');
        $tanggal = date('Y-m-d');

        $karyawan = Karyawan::where('id_user', auth()->user()->id)->first();

        $kehadiran = Kehadiran::where('id_karyawan', $karyawan->id)
            ->where('tanggal', $tanggal)
            ->first();

        if ($kehadiran) {
            $kehadiran->update([
                'jam_pulang' => $jamPulang,
            ]);

            return redirect()
                ->route('kehadiran.index')
                ->with('success', 'Presensi keluar berhasil.');
        } else {
            return redirect()
                ->route('kehadiran.index')
                ->with('error', 'Presensi keluar gagal.');
        }
    }
}
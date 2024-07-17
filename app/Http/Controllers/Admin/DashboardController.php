<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Hutang;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $angsurans = Angsuran::with('hutang')->get();
        return view('admin.angsuran.index', compact('angsurans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hutangs = Hutang::all();
        return view('admin.angsuran.create', compact('hutangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hutang_id' => 'required|exists:hutang,id',
            'angsuran_pertama' => 'nullable|numeric',
            'angsuran_kedua' => 'nullable|numeric',
            'angsuran_ketiga' => 'nullable|numeric',
            'angsuran_keempat' => 'nullable|numeric',
            'tanggal_angsuran_pertama' => 'nullable|date',
            'tanggal_angsuran_kedua' => 'nullable|date',
            'tanggal_angsuran_ketiga' => 'nullable|date',
            'tanggal_angsuran_keempat' => 'nullable|date',
        ]);

        $totalHutang = Hutang::find($request->hutang_id)->total_hutang;
        $totalAngsuran = $request->angsuran_pertama + $request->angsuran_kedua + $request->angsuran_ketiga + $request->angsuran_keempat;
        $sisaHutang = $totalHutang - $totalAngsuran;

        if ($totalAngsuran > $totalHutang) {
            return redirect()
                ->back()
                ->with('error', 'Total angsuran melebihi total hutang.');
        } else {
            Angsuran::create($request->all());

            Hutang::find($request->hutang_id)->update([
                'sisa_hutang' => $sisaHutang,
            ]);
        }

        return redirect()
            ->route('angsuran.index')
            ->with('success', 'Angsuran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function show(Angsuran $angsuran)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Angsuran $angsuran)
    {
        $hutangs = Hutang::all();
        return view('admin.angsuran.edit', compact('angsuran', 'hutangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angsuran $angsuran)
    {
        $request->validate([
            'hutang_id' => 'required|exists:hutang,id',
            'angsuran_pertama' => 'nullable|numeric',
            'angsuran_kedua' => 'nullable|numeric',
            'angsuran_ketiga' => 'nullable|numeric',
            'angsuran_keempat' => 'nullable|numeric',
            'tanggal_angsuran_pertama' => 'nullable|date',
            'tanggal_angsuran_kedua' => 'nullable|date',
            'tanggal_angsuran_ketiga' => 'nullable|date',
            'tanggal_angsuran_keempat' => 'nullable|date',
        ]);

        $totalHutang = Hutang::find($request->hutang_id)->total_hutang;
        $totalAngsuran = $request->angsuran_pertama + $request->angsuran_kedua + $request->angsuran_ketiga + $request->angsuran_keempat;
        $sisaHutang = $totalHutang - $totalAngsuran;

        if ($totalAngsuran > $totalHutang) {
            return redirect()
                ->back()
                ->with('error', 'Total angsuran melebihi total hutang.');
        } else {
            $angsuran->update($request->all());

            Hutang::find($request->hutang_id)->update([
                'sisa_hutang' => $sisaHutang,
            ]);
        }

        return redirect()
            ->route('angsuran.index')
            ->with('success', 'Angsuran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angsuran $angsuran)
    {
        $angsuran->delete();

        return redirect()
            ->route('angsuran.index')
            ->with('success', 'Angsuran berhasil dihapus.');
    }
}
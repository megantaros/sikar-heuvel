<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    // Menampilkan semua data karyawan
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('admin.karyawan.index', compact('karyawan'));
    }

    // Menampilkan form untuk menambahkan karyawan baru
    public function create()
    {
        return view('admin.karyawan.index');
    }

    // Menyimpan karyawan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_lahir' => 'date',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'jabatan' => 'nullable',
        ]);

        Karyawan::create($request->all());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    // Menampilkan detail data karyawan berdasarkan ID
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.show', compact('karyawan'));
    }

    // Menampilkan form untuk mengedit data karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.index', compact('karyawan'));
    }

    // Mengupdate data karyawan berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'tanggal_lahir' => 'date',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'jabatan' => 'nullable',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    // Menghapus data karyawan berdasarkan ID
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }

    public function addUserEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'id_karyawan' => 'required',
            'email' => 'required',
        ]);

        $employee = Karyawan::findOrFail($validatedData['id_karyawan']);

        $user = User::create([
            'name' => $employee->nama_karyawan,
            'email' => $validatedData['email'],
            'password' => bcrypt('password'),
            'phone_number' => $employee->telepon,
            'role' => 'karyawan',
        ]);

        $employee->id_user = $user->id;
        $employee->save();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function updateUserEmployee(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $employee = Karyawan::findOrFail($id);
        $user = User::findOrFail($employee->id_user);

        $user->email = $validatedData['email'];
        if ($validatedData['password'] != '') {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Password berhasil diubah.');
    }

    public function showEmployee($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $karyawan
        ]);
    }
}
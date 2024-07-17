<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';

    protected $fillable = [
        'id_karyawan',
        'id_hutang',
        'id_kehadiran',
        'gaji',
    ];

    // Definisikan relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Definisikan relasi dengan model Tunjangan
    public function tunjangan()
    {
        return $this->belongsTo(Tunjangan::class, 'id_tunjangan');
    }

    // Definisikan relasi dengan model Kehadiran
    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class, 'id_kehadiran');
    }

    // Definisikan relasi dengan model Hutang
    public function hutang()
    {
        return $this->belongsTo(Hutang::class, 'id_hutang');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';

    protected $fillable = [
        'id_karyawan',
        'jam_hadir',
        'jam_pulang',
        'tanggal',
        'tepat_waktu',
        'telat',
        'bonus',
        'denda',
        'status_kehadiran',
    ];

    // Definisikan relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}

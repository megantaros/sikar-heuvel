<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    use HasFactory;
    protected $table = 'tunjangan';

    protected $fillable = [
        'id_karyawan',
        'id_gaji',
        'nama_tunjangan',
        'nominal',
    ];

    // Definisikan relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji');
    }
    
}

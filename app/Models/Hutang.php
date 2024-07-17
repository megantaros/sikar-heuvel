<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;
    protected $table = 'hutang';

    protected $fillable = [
        'id_karyawan',
        'total_hutang',
        'maksimal_hutang',
        'tanggal_hutang',
        'sisa_hutang',
    ];

    // Definisikan relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function angsurans()
    {
        return $this->hasMany(Angsuran::class);
    }
}

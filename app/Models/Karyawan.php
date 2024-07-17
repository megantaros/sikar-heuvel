<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';

    protected $fillable = [
        'id_user',
        'nama_karyawan',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'jabatan',
    ];

    // Relasi kehadiran (One-to-One)
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_kehadiran');
    }

    // Relasi user (One-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

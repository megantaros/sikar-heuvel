<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $fillable = [
        'hutang_id',
        'angsuran_pertama',
        'angsuran_kedua',
        'angsuran_ketiga',
        'angsuran_keempat',
        'tanggal_angsuran_pertama',
        'tanggal_angsuran_kedua',
        'tanggal_angsuran_ketiga',
        'tanggal_angsuran_keempat',
    ];

    public function hutang()
    {
        return $this->belongsTo(Hutang::class);
    }
}

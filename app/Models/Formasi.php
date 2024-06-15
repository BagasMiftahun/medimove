<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formasi extends Model
{
    use HasFactory;

    protected $table = 'formasis';

    protected $fillable = [
        'kode', 'nama',
    ];

    // Relasi dengan Perpindahan (formasi asal)
    public function perpindahanAsal()
    {
        return $this->hasMany(Perpindahan::class, 'formasi_awal');
    }

    // Relasi dengan Perpindahan (formasi tujuan)
    public function perpindahanTujuan()
    {
        return $this->hasMany(Perpindahan::class, 'formasi_tujuan');
    }

    // Relasi dengan Stok_Obat
    public function stokObat()
    {
        return $this->hasMany(StokObat::class, 'formasi_id');
    }
}

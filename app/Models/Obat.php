<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = [
        'kode', 'nama', 'harga', 'satuan',
    ];

    // Relasi dengan Stok_Obat
    public function stokObat()
    {
        return $this->hasMany(StokObat::class, 'obat_id');
    }
}

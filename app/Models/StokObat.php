<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;
    
    protected $table = 'stok_obats';

    protected $fillable = [
        'formasi_id', 'obat_id', 'stok',
    ];

    // Relasi dengan Formasi
    public function formasi()
    {
        return $this->belongsTo(Formasi::class, 'formasi_id');
    }

    // Relasi dengan Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}

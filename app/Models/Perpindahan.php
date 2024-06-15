<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpindahan extends Model
{
    use HasFactory;

    protected $table = 'perpindahans';

    protected $fillable = [
        'formasi_awal', 'formasi_tujuan', 'nomor', 'keterangan',
    ];

    // Relasi dengan Formasi (formasi asal)
    public function formasiAsal()
    {
        return $this->belongsTo(Formasi::class, 'formasi_awal');
    }

    // Relasi dengan Formasi (formasi tujuan)
    public function formasiTujuan()
    {
        return $this->belongsTo(Formasi::class, 'formasi_tujuan');
    }

    // Relasi dengan Detail_Perpindahan
    public function detailPerpindahan()
    {
        return $this->hasMany(DetailPerpindahan::class, 'perpindahan_id');
    }
}

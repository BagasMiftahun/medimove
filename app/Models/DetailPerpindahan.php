<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerpindahan extends Model
{
    use HasFactory;

    protected $table = 'detail_perpindahans';

    protected $fillable = [
        'perpindahan_id', 'obat_id', 'kuantitas',
    ];

    // Relasi dengan Perpindahan
    public function perpindahan()
    {
        return $this->belongsTo(Perpindahan::class, 'perpindahan_id');
    }
}

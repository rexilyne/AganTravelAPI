<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPesawat extends Model
{
    use HasFactory;

    protected $fillable = [
        'noPenerbangan',
        'asal',
        'tujuan',
        'waktuBerangkat',
        'waktuTiba',
        'harga'
    ];
}

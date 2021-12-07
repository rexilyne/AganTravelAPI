<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketBus extends Model
{
    use HasFactory;

    protected $fillable = [
        'noBus',
        'asal',
        'tujuan',
        'waktuBerangkat',
        'waktuTiba',
        'harga'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketKereta extends Model
{
    use HasFactory;

    protected $fillable = [
        'noKereta',
        'asal',
        'tujuan',
        'waktuBerangkat',
        'waktuTiba',
        'harga'
    ];
}

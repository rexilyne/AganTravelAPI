<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderKereta extends Model
{
    use HasFactory;

    protected $fillable = [
        'noKereta',
        'asal',
        'tujuan',
        'waktuBerangkat',
        'waktuTiba',
        'harga',
        'idUser',
        'jumlahPenumpang',
        'totalHarga'
    ];
}

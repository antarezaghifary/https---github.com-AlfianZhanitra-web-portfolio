<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatBeratModel extends Model
{
    use HasFactory;

    protected $table = 'alat_berat';
    protected $fillable = [
        'type',
        'merk',
        'status',
        'operator',
        'bbm',
        'harga',
        'gambar',
    ];
}

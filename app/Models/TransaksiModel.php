<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'id_pelanggan',
        'id_alat_berat',
        'tgl_pemakaian',
        'jam_selesai',
        'lokasi_proyek',
        'status',
        'bukti_pembayaran',
    ];
}

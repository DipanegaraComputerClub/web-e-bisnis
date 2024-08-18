<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesanan';
    public $incrementing = false;
    protected $fillable = [
        'id_produk',
        'id_user',
        'id_ongkir',
        'jumlah',
        'total',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_keranjang';
    public $incrementing = false;
    protected $fillable = [
        'id_produk',
        'id_user',
    ];
}

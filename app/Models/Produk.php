<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'foto',
        'harga',
        'keterangan',
    ];
}

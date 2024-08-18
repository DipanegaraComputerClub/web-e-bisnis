<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_konfirmasi';
    public $incrementing = false;
    protected $fillable = [
        'id_user',
        'id_pesanan',
        'bukti',
    ];
}

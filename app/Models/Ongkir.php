<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ongkir';
    public $incrementing = false;
    protected $fillable = [
        'daerah',
        'ongkos',
    ];
}

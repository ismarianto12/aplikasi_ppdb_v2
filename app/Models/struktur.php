<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class struktur extends Model
{

    public $table = 'struktur_korporasi';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;
}

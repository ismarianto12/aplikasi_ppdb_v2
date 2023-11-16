<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public $table = 'pembayaran';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;
}

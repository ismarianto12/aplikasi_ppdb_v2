<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    public $table = 'karyawan';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistik extends Model
{

    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'statistik';
    public $guarded = [];
    public static $tahun;
    use HasFactory;

}

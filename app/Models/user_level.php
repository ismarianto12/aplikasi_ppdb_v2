<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_level extends Model
{

    public $incrementing = false;
    protected $table = 'user_level';
    public $guarded = [];
    public static $tahun;
    use HasFactory;

}

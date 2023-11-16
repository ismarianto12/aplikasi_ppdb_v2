<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parameterBiayar extends Model
{
    public $table= 'biaya_ppdb';
    public $timestamps  = false;
    public $guarded = [];
    use HasFactory;
}

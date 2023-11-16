<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    public $table = 'divisi';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;
}

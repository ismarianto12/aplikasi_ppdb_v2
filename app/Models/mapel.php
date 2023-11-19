<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    public $table = 'mapel';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;

}

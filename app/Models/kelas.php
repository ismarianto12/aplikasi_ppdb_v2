<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    public $table = 'kelas';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'tahunAkademik';
    public $guarded = [];
    use HasFactory;
}

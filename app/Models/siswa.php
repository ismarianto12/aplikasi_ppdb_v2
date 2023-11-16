<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'siswa';
    public $guarded = [];
    public static $tahun;
    use HasFactory;

}

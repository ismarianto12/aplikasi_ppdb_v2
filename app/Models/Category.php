<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $primaryKey = 'id_category';
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'category';
    public $guarded = [];
    public static $tahun;
}

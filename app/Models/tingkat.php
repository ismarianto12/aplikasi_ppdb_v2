<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tingkat extends Model
{
    public $table = 'tingkat';
    public $timestamps = false;
    public $guarded = [];
    use HasFactory;
}

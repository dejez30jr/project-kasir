<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $table = "data";
    protected $fillable = ['name', 'nik', 'kelas'];
}

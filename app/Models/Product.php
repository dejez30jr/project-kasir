<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    Use HasFactory;
    protected $fillable = ['name', 'kategori', 'price', 'stock', 'image'];
}

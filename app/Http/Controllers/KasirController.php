<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return redirect()->route('post.kategori', 'Makanan');
    }
    public function kategori($nama){
        $kategoriProducts = Product::where('kategori', $nama)->get();
        return view('kasir-sistem.kasir', compact('kategoriProducts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_ps' => 'required|in:PS3,PS4,PS5',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'total_bayar' => 'required|numeric|min:10000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // tambahkan validasi gambar
        ]);
  
        if($request->hasFile('gambar')){
            $validated['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Simpan data ke database
        Rental::create($validated);

        return redirect()->route('table.data')->with('success', 'Data rental berhasil disimpan!');
    }

    public function show()
    {
        $data_rental = Rental::all();
        return view('table-data', compact('data_rental'));
    }

    public function edit($id){
        $rental = Rental::findOrFail($id);
        return view('edit', compact('rental'));
    }

    public function update(Request $request, $id){
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'total_bayar' => 'required|numeric|min:10000',
        ]);

        $rental = Rental::findOrFAil($id);
        $rental->update($validated);
        return redirect()->route('table.data')->with('success', 'Data rental berhasil diupdate!');
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect()->route('table.data')->with('success', 'Data rental berhasil dihapus!');
    }
}

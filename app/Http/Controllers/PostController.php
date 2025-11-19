<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formsec');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'=>'required|string|max:255',
            'email'=>'required|string|min:1|email:posts,email'
        ]);

        post::create($validated);
        return redirect()->route('table.sec')->with('success', 'data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data_post = post::all();
        return view('tablesec', compact('data_post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post, $id)
    {
        $data_old = post::findOrFail($id);
        return view('editsec', compact('data_old'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
          $validated = $request->validate([
            'nama'=>'required|string|max:255',
            'email'=>'required|string|min:1|unique:posts,email,' . $id,
        ]);

        $data_old = post::findOrFail($id);
        $data_old->update($validated);
        return redirect()->route('table.sec')->with('success', 'data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $apus_data = post::findOrFail($id);
        $apus_data->delete();
        return redirect()->back()->with('succes', 'data berhasil do hapus');
    }
}

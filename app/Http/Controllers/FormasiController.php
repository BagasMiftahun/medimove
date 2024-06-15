<?php

namespace App\Http\Controllers;

use App\Models\Formasi;
use Illuminate\Http\Request;

class FormasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formasis = Formasi::orderBy('created_at', 'desc')->get();
        return view('app.formasi.index', compact('formasis'));
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
        $formasi = $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        // Tambahkan validasi lainnya jika diperlukan
        ]);
        Formasi::create($formasi);
        return redirect()->back()->with('success', 'Formasi has been created successfully.');        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formasi = Formasi::findOrFail($id);
        
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        // Update data
        $formasi->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        return redirect()->back()->with('success', 'Formasi updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formasi = Formasi::findOrFail($id);
        $formasi->delete();
    
        return redirect()->back()->with('success', 'Formasi has been deleted successfully.');
    }
}

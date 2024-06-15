<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Formasi;
use App\Models\StokObat;
use Illuminate\Http\Request;

class StokObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks = StokObat::orderBy('created_at', 'desc')->get();
        return view('app.stok-obat.index', compact('stoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formasis = Formasi::all();
        $obats = Obat::all();
        return view('app.stok-obat.create', compact('formasis', 'obats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stok = $request->validate([
            'formasi_id' => 'required',
            'obat_id' => 'required',
            'stok' => 'required',
        // Tambahkan validasi lainnya jika diperlukan
        ]);
        StokObat::create($stok);
        return redirect()->route('stok-obat.index')->with('success', 'Stok Obat has been created successfully.');        
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
        $stok = StokObat::findOrFail($id);
        $formasis = Formasi::all();
        $obats = Obat::all();
        return view('app.stok-obat.edit', compact('stok','obats', 'formasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stok = StokObat::findOrFail($id);
        
        // Validasi data
        $request->validate([
            'formasi_id' => 'required',
            'obat_id' => 'required',
            'stok' => 'required',
        ]);

        // Update data
        $stok->update([
            'formasi_id' => $request->formasi_id,
            'obat_id' => $request->obat_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('stok-obat.index')->with('success', 'Stok Obat updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stok = StokObat::findOrFail($id);
        $stok->delete();
    
        return redirect()->back()->with('success', 'Stok Obat has been deleted successfully.');
    }

    public function getHarga($id)
    {
        $obat = Obat::findOrFail($id);
        
        // Mengembalikan harga unit dalam bentuk JSON
        return response()->json([
            'harga' => $obat->harga
        ]);
    }
}

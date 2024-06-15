<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::orderBy('created_at', 'desc')->get();
        return view('app.obat.index', compact('obats'));
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
        $obat = $request->validate([
            'nama' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        // Tambahkan validasi lainnya jika diperlukan
        ]);

           // Mendapatkan kode terakhir dari database
        $latestObat = Obat::orderBy('kode', 'desc')->first();

        // Membuat kode baru dengan menambahkan satu
        $kode = $latestObat ? str_pad((int)$latestObat->kode + 1, 8, '0', STR_PAD_LEFT) : '00000001';

        // Simpan data ke database
        $obat = new Obat();
        $obat->kode = $kode;
        $obat->nama = $request->nama;
        $obat->satuan = $request->satuan;
        $obat->harga = $request->harga;
        $obat->save();
        
        return redirect()->back()->with('success', 'Obat has been created successfully.');        
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
        $type = Obat::findOrFail($id);
        
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        ]);

        // Update data
        $type->update([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);

        return redirect()->back()->with('success', 'Obat updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
    
        return redirect()->back()->with('success', 'Obat has been deleted successfully.');
    }

    public function filter(Request $request)
    {
        $satuan = $request->satuan;
    
        $obats = Obat::where('satuan', $satuan)->orderBy('created_at', 'desc');
    
        return view('app.obat.index', compact('obats'));
    }
}

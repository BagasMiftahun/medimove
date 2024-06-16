<?php

namespace App\Http\Controllers;

use App\Models\Formasi;
use App\Models\StokObat;
use App\Models\Perpindahan;
use Illuminate\Http\Request;
use App\Models\DetailPerpindahan;

class PerpindahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pindahs = Perpindahan::orderBy('created_at', 'desc')->get();
        return view('app.perpindahan.index', compact('pindahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formasis = Formasi::all();
        return view('app.perpindahan.create', compact('formasis'));
    }

    public function getObatByFormasi(Request $request)
    {
        $formasi_id = $request->input('formasi_id');

        // Ambil stok obat berdasarkan formasi_id yang dipilih
        $stoks = StokObat::where('formasi_id', $formasi_id)->with('obat')->get();

        return response()->json($stoks->map(function($stok) {
            return [
                'obat_id' => $stok->obat->id,
                'obat' => [
                    'nama' => $stok->obat->nama,
                    'harga' => $stok->obat->harga,
                    'satuan' => $stok->obat->satuan
                ],
                'stok' => $stok->stok
            ];
        }));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'formasi_awal' => 'required|exists:formasis,id',
            'formasi_tujuan' => 'required|exists:formasis,id',
            'obat_id.*' => 'required|exists:obats,id',
            'kuantitas.*' => 'required|numeric|min:1',
            'keterangan' => 'required|string',
        ]);

        // Retrieve the last Perpindahan record to determine the next number
        $lastPerpindahan = Perpindahan::orderBy('nomor', 'desc')->first();
        $nextNumber = $lastPerpindahan ? intval($lastPerpindahan->nomor) + 1 : 1;
        $nomor = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        $formasiAwal = $request->input('formasi_awal');
        $formasiTujuan = $request->input('formasi_tujuan');
        $obatIds = $request->input('obat_id');
        $kuantitas = $request->input('kuantitas');
        $keterangan = $request->input('keterangan');

        // Simpan informasi perpindahan
        $perpindahan = Perpindahan::create([
            'nomor' => $nomor,
            'formasi_awal' => $formasiAwal,
            'formasi_tujuan' => $formasiTujuan,
            'keterangan' => $keterangan,
        ]);

        // Proses perpindahan obat
        foreach ($obatIds as $key => $obatId) {
            $obat = StokObat::where('formasi_id', $formasiAwal)
                            ->where('obat_id', $obatId)
                            ->first();

            if ($obat) {
                // Kurangi stok di formasi awal
                $stokAwalBaru = $obat->stok - $kuantitas[$key];
                if ($stokAwalBaru <= 0) {
                    $obat->delete(); // Hapus jika stok 0 atau kurang
                } else {
                    $obat->update(['stok' => $stokAwalBaru]);
                }

                // Tambah atau update stok di formasi tujuan
                $obatTujuan = StokObat::where('formasi_id', $formasiTujuan)
                                    ->where('obat_id', $obatId)
                                    ->first();

                if ($obatTujuan) {
                    $obatTujuan->update(['stok' => $obatTujuan->stok + $kuantitas[$key]]);
                } else {
                    StokObat::create([
                        'formasi_id' => $formasiTujuan,
                        'obat_id' => $obatId,
                        'stok' => $kuantitas[$key],
                    ]);
                }

                // Simpan detail perpindahan
                DetailPerpindahan::create([
                    'perpindahan_id' => $perpindahan->id,
                    'obat_id' => $obatId,
                    'kuantitas' => $kuantitas[$key],
                ]);
            }
        }

        return redirect()->route('perpindahan.index')->with('success', 'Perpindahan obat berhasil disimpan.');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pindahs = Perpindahan::findOrFail($id);
        return view('app.perpindahan.detail', compact('pindahs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pindah = Perpindahan::with('detailPerpindahan.obat')->findOrFail($id);
        $formasis = Formasi::all();

        return view('app.perpindahan.edit', compact('pindah', 'formasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'formasi_awal' => 'required|exists:formasis,id',
            'formasi_tujuan' => 'required|exists:formasis,id',
            'obat_id.*' => 'required|exists:obats,id',
            'kuantitas.*' => 'required|numeric|min:1',
            'keterangan' => 'required|string',
        ]);
    
        // Retrieve the Perpindahan instance
        $perpindahan = Perpindahan::findOrFail($id);
    
        // Check if there are any changes in formasi awal
        if ($perpindahan->formasi_awal != $request->input('formasi_awal')) {
            // Delete existing detail perpindahan
            DetailPerpindahan::where('perpindahan_id', $perpindahan->id)->delete();
    
            // Update perpindahan data
            $perpindahan->formasi_awal = $request->input('formasi_awal');
            $perpindahan->formasi_tujuan = $request->input('formasi_tujuan');
            $perpindahan->keterangan = $request->input('keterangan');
            $perpindahan->save();
        } else {
            // Only update keterangan if there are no changes in formasi awal
            $perpindahan->formasi_tujuan = $request->input('formasi_tujuan');
            $perpindahan->keterangan = $request->input('keterangan');
            $perpindahan->save();
        }
    
        // Process updated perpindahan obat
        $obatIds = $request->input('obat_id');
        $kuantitas = $request->input('kuantitas');
    
        foreach ($obatIds as $key => $obatId) {
            // Find existing detail perpindahan
            $existingDetail = DetailPerpindahan::where('perpindahan_id', $perpindahan->id)
                ->where('obat_id', $obatId)
                ->first();
    
            // Calculate kuantitas change
            $oldKuantitas = $existingDetail ? $existingDetail->kuantitas : 0;
            $newKuantitas = $kuantitas[$key];
    
            // Calculate difference in kuantitas
            $jumlahPengurangan = $oldKuantitas - $newKuantitas;
            $jumlahPertambahan = $newKuantitas - $oldKuantitas;
    

            if($newKuantitas > $oldKuantitas){
                // Update stok obat in formasi awal
                $stokObatAwal = StokObat::where('formasi_id', $perpindahan->formasi_awal)
                    ->where('obat_id', $obatId)
                    ->firstOrFail();
                $stokObatAwal->update(['stok' => $stokObatAwal->stok - $jumlahPertambahan]);

                // Update stok obat in formasi tujuan
                $stokObatTujuan = StokObat::where('formasi_id', $perpindahan->formasi_tujuan)
                    ->where('obat_id', $obatId)
                    ->firstOrFail();
                $stokObatTujuan->update(['stok' => $stokObatTujuan->stok + $jumlahPertambahan]);
            }elseif($newKuantitas < $oldKuantitas){
                // Update stok obat in formasi awal
                $stokObatAwal = StokObat::where('formasi_id', $perpindahan->formasi_awal)
                    ->where('obat_id', $obatId)
                    ->firstOrFail();
                $stokObatAwal->update(['stok' => $stokObatAwal->stok + $jumlahPengurangan]);

                // Update stok obat in formasi tujuan
                $stokObatTujuan = StokObat::where('formasi_id', $perpindahan->formasi_tujuan)
                    ->where('obat_id', $obatId)
                    ->firstOrFail();
                $stokObatTujuan->update(['stok' => $stokObatTujuan->stok - $jumlahPengurangan]);
            }
    
            // Update or create detail perpindahan
            if ($existingDetail) {
                $existingDetail->update(['kuantitas' => $newKuantitas]);
            } else {
                DetailPerpindahan::create([
                    'perpindahan_id' => $perpindahan->id,
                    'obat_id' => $obatId,
                    'kuantitas' => $newKuantitas,
                ]);
            }
        }
    
        return redirect()->route('perpindahan.index')->with('success', 'Perpindahan obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stok = Perpindahan::findOrFail($id);
        $stok->delete();
    
        return redirect()->back()->with('success', 'Perpindahan Obat has been deleted successfully.');
    }

    public function getObatPerpindahan(Request $request)
    {
        $formasi_awal_id = $request->input('formasi_awal_id');
        $formasi_tujuan_id = $request->input('formasi_tujuan_id');

        // Ambil obat dari perpindahan yang sesuai dengan formasi_awal_id dan formasi_tujuan_id
        $detailPerpindahan = Perpindahan::whereHas('detailPerpindahan', function ($query) use ($formasi_awal_id, $formasi_tujuan_id) {
            $query->where('formasi_awal', $formasi_awal_id)->where('formasi_tujuan', $formasi_tujuan_id);
        })->get();

        return response()->json($detailPerpindahan->map(function($detail) {
            return [
                'obat_id' => $detail->detailPerpindahan->obat_id,
                'obat' => [
                    'nama' => $detail->detailPerpindahan->obat->nama,
                    'harga' => $detail->detailPerpindahan->obat->harga,
                    'satuan' => $detail->detailPerpindahan->obat->satuan
                ],
                'kuantitas' => $detail->detailPerpindahan->kuantitas,
                'stok' => $detail->detailPerpindahan->obat->stok // Jika diperlukan, ambil stok dari relasi obat
            ];
        }));
    }

}

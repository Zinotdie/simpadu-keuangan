<?php

namespace App\Http\Controllers;

use App\Models\Keringanan;
use Illuminate\Http\Request;

class KeringananController extends Controller
{
    public function index()
    {
        $keringanan = Keringanan::with(['tahunAjaran'])->get();
        return response()->json($keringanan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_tahun' => 'required|exists:keu_tahun_ajaran,id_tahun',
            'jenis_keringanan' => 'required|string|max:50',
            'jumlah_potongan' => 'required|numeric|min:0',
            'deskripsi_keringanan' => 'nullable|string',
            'status_keringanan' => 'in:Disetujui,Ditolak,Menunggu'
        ]);

        $keringanan = Keringanan::create($request->all());
        return response()->json($keringanan, 201);
    }

    public function show($id)
    {
        $keringanan = Keringanan::with(['tahunAjaran'])->findOrFail($id);
        return response()->json($keringanan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_tahun' => 'required|exists:keu_tahun_ajaran,id_tahun',
            'jenis_keringanan' => 'required|string|max:50',
            'jumlah_potongan' => 'required|numeric|min:0',
            'deskripsi_keringanan' => 'nullable|string',
            'status_keringanan' => 'in:Disetujui,Ditolak,Menunggu'
        ]);

        $keringanan = Keringanan::findOrFail($id);
        $keringanan->update($request->all());
        return response()->json($keringanan);
    }

    public function destroy($id)
    {
        Keringanan::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function byNim($nim)
    {
        $keringanan = Keringanan::with(['tahunAjaran'])
            ->where('nim', $nim)
            ->get();
            
        return response()->json($keringanan);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status_keringanan' => 'required|in:Disetujui,Ditolak,Menunggu'
        ]);

        $keringanan = Keringanan::findOrFail($id);
        $keringanan->status_keringanan = $request->status_keringanan;
        $keringanan->save();
        
        return response()->json($keringanan);
    }
}
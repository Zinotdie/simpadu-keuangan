<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return response()->json($tahunAjaran);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'aktif' => 'boolean'
        ]);

        $tahunAjaran = TahunAjaran::create($request->all());
        return response()->json($tahunAjaran, 201);
    }

    public function show($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return response()->json($tahunAjaran);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'aktif' => 'boolean'
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update($request->all());
        return response()->json($tahunAjaran);
    }

    public function destroy($id)
    {
        TahunAjaran::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function setAktif($id)
    {
        // Set all to non-active first
        TahunAjaran::query()->update(['aktif' => false]);
        
        // Set the selected one to active
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->aktif = true;
        $tahunAjaran->save();
        
        return response()->json($tahunAjaran);
    }
}
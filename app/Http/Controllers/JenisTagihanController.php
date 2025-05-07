<?php

namespace App\Http\Controllers;

use App\Models\JenisTagihan;
use Illuminate\Http\Request;

class JenisTagihanController extends Controller
{
    public function index()
    {
        $jenisTagihan = JenisTagihan::all();
        return response()->json($jenisTagihan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_tagihan' => 'required|string|max:100',
            'deskripsi_tagihan' => 'nullable|string'
        ]);

        $jenisTagihan = JenisTagihan::create($request->all());
        return response()->json($jenisTagihan, 201);
    }

    public function show($id)
    {
        $jenisTagihan = JenisTagihan::findOrFail($id);
        return response()->json($jenisTagihan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_tagihan' => 'required|string|max:100',
            'deskripsi_tagihan' => 'nullable|string'
        ]);

        $jenisTagihan = JenisTagihan::findOrFail($id);
        $jenisTagihan->update($request->all());
        return response()->json($jenisTagihan);
    }

    public function destroy($id)
    {
        JenisTagihan::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
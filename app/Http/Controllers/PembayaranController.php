<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['tagihan'])->get();
        return response()->json($pembayaran);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_tagihan' => 'required|exists:keu_tagihan,id_tagihan',
            'nominal' => 'required|numeric|min:0',
            'tgl_bayar' => 'required|date',
            'metode_bayar' => 'required|string|max:50',
            'bukti_bayar' => 'nullable|string'
        ]);

        $pembayaran = Pembayaran::create($request->all());
        
        // Update tagihan status if fully paid
        $tagihan = Tagihan::find($request->id_tagihan);
        $totalPembayaran = Pembayaran::where('id_tagihan', $request->id_tagihan)->sum('nominal');
        
        if ($totalPembayaran >= $tagihan->nominal) {
            $tagihan->status_tagihan = 'Lunas';
            $tagihan->save();
        }
        
        return response()->json($pembayaran, 201);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['tagihan'])->findOrFail($id);
        return response()->json($pembayaran);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_tagihan' => 'required|exists:keu_tagihan,id_tagihan',
            'nominal' => 'required|numeric|min:0',
            'tgl_bayar' => 'required|date',
            'metode_bayar' => 'required|string|max:50',
            'bukti_bayar' => 'nullable|string'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());
        
        // Update tagihan status if fully paid
        $tagihan = Tagihan::find($request->id_tagihan);
        $totalPembayaran = Pembayaran::where('id_tagihan', $request->id_tagihan)->sum('nominal');
        
        if ($totalPembayaran >= $tagihan->nominal) {
            $tagihan->status_tagihan = 'Lunas';
        } else {
            $tagihan->status_tagihan = 'Belum Lunas';
        }
        $tagihan->save();
        
        return response()->json($pembayaran);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $idTagihan = $pembayaran->id_tagihan;
        $pembayaran->delete();
        
        // Update tagihan status after deletion
        $tagihan = Tagihan::find($idTagihan);
        $totalPembayaran = Pembayaran::where('id_tagihan', $idTagihan)->sum('nominal');
        
        if ($totalPembayaran >= $tagihan->nominal) {
            $tagihan->status_tagihan = 'Lunas';
        } else {
            $tagihan->status_tagihan = 'Belum Lunas';
        }
        $tagihan->save();
        
        return response()->json(null, 204);
    }

    public function byNim($nim)
    {
        $pembayaran = Pembayaran::with(['tagihan'])
            ->where('nim', $nim)
            ->get();
            
        return response()->json($pembayaran);
    }

    public function byTagihan($idTagihan)
    {
        $pembayaran = Pembayaran::with(['tagihan'])
            ->where('id_tagihan', $idTagihan)
            ->get();
            
        return response()->json($pembayaran);
    }
}
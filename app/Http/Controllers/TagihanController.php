<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     title="SIMPADU Keuangan API",
 *     version="1.0.0",
 *     description="API untuk Sistem Keuangan Kampus"
 * )
 */

/**
 * @OA\Tag(
 *     name="Tagihan",
 *     description="Operasi terkait tagihan mahasiswa"
 * )
 */
class TagihanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tagihan",
     *     tags={"Tagihan"},
     *     summary="Mendapatkan daftar semua tagihan",
     *     description="Mengembalikan daftar semua tagihan mahasiswa",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mendapatkan daftar tagihan",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tagihan")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $tagihan = Tagihan::with(['jenisTagihan', 'tahunAjaran'])->get();
        return response()->json($tagihan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_jenis' => 'required|exists:keu_jenis_tagihan,id_jenis',
            'id_tahun' => 'required|exists:keu_tahun_ajaran,id_tahun',
            'nominal' => 'required|numeric|min:0',
            'status_tagihan' => 'in:Lunas,Belum Lunas',
            'tgl_terbit' => 'required|date'
        ]);

        $tagihan = Tagihan::create($request->all());
        return response()->json($tagihan, 201);
    }

    public function show($id)
    {
        $tagihan = Tagihan::with(['jenisTagihan', 'tahunAjaran'])->findOrFail($id);
        return response()->json($tagihan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'id_jenis' => 'required|exists:keu_jenis_tagihan,id_jenis',
            'id_tahun' => 'required|exists:keu_tahun_ajaran,id_tahun',
            'nominal' => 'required|numeric|min:0',
            'status_tagihan' => 'in:Lunas,Belum Lunas',
            'tgl_terbit' => 'required|date'
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update($request->all());
        return response()->json($tagihan);
    }

    public function destroy($id)
    {
        Tagihan::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function byNim($nim)
    {
        $tagihan = Tagihan::with(['jenisTagihan', 'tahunAjaran'])
            ->where('nim', $nim)
            ->get();
            
        return response()->json($tagihan);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status_tagihan' => 'required|in:Lunas,Belum Lunas'
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->status_tagihan = $request->status_tagihan;
        $tagihan->save();
        
        return response()->json($tagihan);
    }
    
}
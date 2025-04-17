<?php

namespace App\Http\Controllers;

use App\Models\Klarifikasi;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KlarifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klarifikasi = Klarifikasi::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil  di tampilkan',
            'data' => $klarifikasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_masuk' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $klarifikasi = Klarifikasi::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $klarifikasi
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $klarifikasi = Klarifikasi::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $klarifikasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_masuk' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi  gagal',
                'error' => $validator->errors(),
            ]);
        }

        $klarifikasi = Klarifikasi::findOrFail($id);
        $klarifikasi->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di ubah',
            'data' => $klarifikasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $klarifikasi = Klarifikasi::findOrFail($id);
        $klarifikasi->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $klarifikasi
        ]);
    }
}

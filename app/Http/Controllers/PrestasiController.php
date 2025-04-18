<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestasi = Prestasi::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $prestasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'nama_prestasi' => 'required',
        'tingkat' => 'required',
        'foto_up' => 'required',
        'tahun' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $prestasi = Prestasi::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $prestasi
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $prestasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        'nama_prestasi' => 'required',
        'tingkat' => 'required',
        'foto_up' => 'required',
        'tahun' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di perbarui',
            'data' => $prestasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $prestasi
        ]);

    }
}

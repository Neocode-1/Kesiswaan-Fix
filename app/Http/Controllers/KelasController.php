<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return response()->json([
            'status' => true,
            'message' =>  'data berhasil di tampilkan',
            'data' => $kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'kebutuhan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $kelas = Kelas::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $kelas
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'kebutuhan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di perbarui',
            'data' => $kelas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json([
            'status' =>  true,
            'message' => 'data berhasil di hapus',
            'data' => $kelas
        ]);
    }
}

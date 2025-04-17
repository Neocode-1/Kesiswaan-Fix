<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angkatan = Angkatan::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $angkatan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tahun' => 'required| numeric',
        ]);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $angkatan = Angkatan::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambakan',
            'data' => $angkatan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $angkatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required| numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $angkatan = Angkatan::findOrFail($id);
        $angkatan->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $angkatan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $angkatan->delete();
        return response()->json([
            'status' =>  true,
            'message' => 'data berhasil di hapus',
            'data' =>  $angkatan
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IjazahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ijazah = Ijazah::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $ijazah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'upload_file' => 'required',
        'tahun_lulus' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $ijazah = Ijazah::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $ijazah
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ijazah = Ijazah::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $ijazah
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
        'upload_file' => 'required',
        'tahun_lulus' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $ijazah = Ijazah::findOrFail($id);
        $ijazah->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di perbarui',
            'data' => $ijazah
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ijazah = Ijazah::findOrFail($id);
        $ijazah->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $ijazah
        ]);
    }
}

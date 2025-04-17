<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $absensi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reken_bulanan' => 'required',
            'upload_file' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $absensi = Absensi::finsOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $absensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Di sini kita melakukan pengecekan validasi nya 
        $validator = Validator::make($request->all(), [
            'reken_bulanan' => 'required',
            'upload_file' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ]);
        }

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di perbarui',
            'data' => $absensi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $absensi
        ]);
    }
}

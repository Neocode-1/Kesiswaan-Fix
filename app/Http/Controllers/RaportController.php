<?php

namespace App\Http\Controllers;

use App\Models\Raport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rapot = Raport::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $rapot
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'upload_file' => 'required',
        'catatan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $rapot = Raport::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $rapot
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rapot = Raport::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $rapot
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'upload_file' => 'required',
            'catatan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors()
            ]);
        }

        $rapot = Raport::findOrFail($id);
        $rapot->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di perbarui',
            'data' => $rapot
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rapot = Raport::findOrFail($id);
        $rapot->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $rapot
        ]);
    }
}

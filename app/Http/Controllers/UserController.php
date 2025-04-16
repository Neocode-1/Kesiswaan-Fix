<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Untuk menampilkan semua data
        $user = User::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
                'data' => []
            ], 422);
        }

        // menunjukan jika data itu sukses di tambahkan
        $user = User::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Untuk menampilkan data berdasarkan id
        $user = User::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Proses untuk update data
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
                'data' => []
            ], 422);
        }

        // menunjukan jika data itu sukses di tambahkan
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $user
        ],);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Proses untuk menghapus data
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $user
        ]);
    }
}

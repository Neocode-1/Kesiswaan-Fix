<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        // return view('siswa.index', compact('siswa'));
        return response()->json([
            'status' =>  true,
            'message' => 'data berhasil di tampilkan',
            'data' => $siswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'nama' => 'required',
        'nisn' => 'required'| 'numeric',
        'ttl' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'sklh_asal' => 'required',
        'tgl_masuk' => 'required',
        'tgl_keluar' => 'required',
        'status_klrga' => 'required',
        'anak_ke' => 'required' | 'numeric',
        'alamat' => 'required',
        'telp_rumah' => 'required'|'numeric',
        'status_pip' => 'required',
        'nama_ortu' => 'required',
        'alamat_ortu' => 'required',
        'no_telp' => 'required'|'numeric',
        'pekerjaan' => 'required',
        'nama_wali' => 'required',
        'alamat_wali' => 'required',
        'pekerjaan_wali' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi gagal',
                'error' => $validator->errors(),
            ], 422);

            $siswa = Siswa::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'data berhasil di tambahkan',
                'data' => $siswa
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tampilkan',
            'data' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            ], 422);
        }

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di tambahkan',
            'data' => $siswa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil di hapus',
            'data' => $siswa
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SiswaResource::collection(
            Siswa::with('kelas')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'bb' => 'required|integer',
            'tb' => 'required|integer',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
        $siswa = Siswa::create($validated);
        return new SiswaResource($siswa->load('kelas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return new SiswaResource($siswa->load('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'bb' => 'required|integer',
            'tb' => 'required|integer',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
        $siswa->update($validated);
        return new SiswaResource($siswa->load('kelas'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

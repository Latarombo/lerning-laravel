<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KelasResource::collection(
            Kelas::with('guru')->orderBy('nama_kelas', 'asc')->paginate(2)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:15',
            'guru_id' => 'required|exists:guru,id',
        ]);
        $kelas = Kelas::create($validated);
        return new KelasResource($kelas->load('guru'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return new KelasResource($kelas->load(['guru', 'siswa']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:15',
            'guru_id' => 'required|exists:guru,id',
        ]);
        $kelas->update($validated);
        return new KelasResource($kelas->load('guru'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

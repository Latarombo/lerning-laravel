<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuruResource;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GuruResource::collection(
            Guru::with('kelas')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'mapel' => 'required|string|max:100',
        ]);
        $guru = Guru::create($validated);
        return new GuruResource($guru);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return new GuruResource($guru->load('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'mapel' => 'required|string|max:100',
        ]);
        $guru->update($validated);
        return new GuruResource($guru->load('kelas'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

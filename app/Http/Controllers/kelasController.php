<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::with('guru');
        $query->when($request->keyword, function ($q) use ($request) {
            $q->where('nama_kelas', 'like', '%' . $request->keyword . '%');
        });
        $query->orderBy(
            $request->get('sort', 'nama_kelas'),
            $request->get('direction', 'asc')
        );
        $kelass = $query->paginate(2)->withQueryString();
        $guru = Guru::all();
        return view('kelas.index', compact('kelass', 'guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('kelas.create');
    // }
    public function create()
    {
        $gurus = Guru::all();
        return view('kelas.create', compact('gurus'));
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

        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with(['guru', 'siswa'])->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();
        return view('kelas.edit', compact('kelas', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated= $request->validate([
            'nama_kelas' => 'required|string|max:15',
            'guru_id' => 'required|exists:guru,id',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::destroy($id);
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}

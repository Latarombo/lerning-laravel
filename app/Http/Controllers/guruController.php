<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Guru::with('kelas');
        $query->when($request->keyword, function ($q) use ($request) {
            $q->where('nama_guru', 'like', '%' . $request->keyword . '%')
                ->orWhere('mapel', 'like', '%' . $request->keyword . '%');
        });
        $query->when($request->kelas, function ($q) use ($request) {
            $q->where('id', $request->kelas);
        });
        $query->orderBy(
            $request->get('sort', 'nama_guru'),
            $request->get('direction', 'asc')
        );
        $gurus = $query->paginate(2)->withQueryString();
        $kelas = Kelas::all();
        return view('guru.index', compact('gurus', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'mapel' => 'required|string|max:100',
        ]);

        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'mapel' => 'required|string|max:100',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guru::destroy($id);
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}

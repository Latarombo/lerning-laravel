<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');
        $query->when($request->keyword, function ($q) use ($request) {
            $q->where('nama_siswa', 'like', '%' . $request->keyword . '%')
                ->orWhere('bb', 'like', '%' . $request->keyword . '%')
                ->orWhere('tb', 'like', '%' . $request->keyword . '%');
        });
        $query->when($request->kelas, function ($q) use ($request) {
            $q->where('kelas_id', $request->kelas);
        });
        $query->orderBy(
            $request->get('sort', 'nama_siswa'),
            $request->get('direction', 'asc')
        );
        $siswas = $query->paginate(2)->withQueryString();
        $kelas = Kelas::all();
        return view('siswa.index', compact('siswas', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('siswa.create');
    // }

    // Kode Baru dari fungsi create
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // menambahkan kelas_id
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'tb' => 'required|int|max:400',
            'bb' => 'required|int|max:300',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
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
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // menambahkan kelas_id dan menambahkan $validated
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'tb' => 'required|int|max:400',
            'bb' => 'required|int|max:300',
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        // mengubah $request->all() menjadi $validated
        $siswa = Siswa::findOrFail($id);
        $siswa->update($validated);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::destroy($id);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}

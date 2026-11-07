@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Siswa</h1>

    <p>Selamat datang di Sistem Informasi Data Siswa.</p>

    <a href="{{ route('siswa.create') }}"
        style="display:inline-block; margin-bottom:14px; padding:6px 14px; background-color:#2563eb; color:white; border-radius:4px;">Tambah
        Siswa</a>


    {{-- Searchbar dan filter --}}
    <form method="GET" action="{{ route('siswa.index') }}">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Nama">
        <select name="kelas">
            <option value="">Semua Kelas</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ request('kelas') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
        <button type="submit">Cari</button>
    </form>

    <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>TB</th>
            <th>BB</th>
            <th>Action</th>
        </tr>
        @foreach ($siswas as $s)
            <tr>
                <td>{{ $loop->iteration + ($siswas->currentPage() - 1) * $siswas->perPage() }}</td>
                <td>{{ $s->nama_siswa }}</td>
                <td>{{ $s->tb }}</td>
                <td>{{ $s->bb }}</td>
                <td>
                    <a href="{{ route('siswa.edit', $s->id) }}" style="color:blue;">Edit</a>
                    |
                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red;" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $siswas->links() }}
@endsection

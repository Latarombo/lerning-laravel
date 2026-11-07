@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Kelas</h1>

    <p>Selamat datang di Sistem Informasi Data Kelas.</p>
    <a
        href="{{ route('kelas.create') }}"style="display:inline-block; margin-bottom:14px; padding:6px 14px; background-color:#2563eb; color:white; border-radius:4px;">Tambah
        Kelas</a>

    {{-- Searchbar dan filter --}}
    <form method="GET" action="{{ route('kelas.index') }}">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Kelas">
        <button type="submit">Cari</button>
    </form>

    <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Kelas</th>
            <th>Guru</th>
            <th>Action</th>
        </tr>
        @foreach ($kelass as $s)
            <tr>
                <td>{{ $loop->iteration + ($kelass->currentPage() - 1) * $kelass->perPage() }}</td>
                <td>{{ $s->nama_kelas }}</td>
                <td>{{ $s->guru->nama_guru }}</td>
                <td>
                    <a href="{{ route('kelas.show', $s->id) }}" style="color:blue;">Detail
                        Siswa</a> |

                    <a href="{{ route('kelas.edit', $s->id) }}" style="color:blue;">Edit</a> |

                    <form action="{{ route('kelas.destroy', $s->id) }}" method="POST" style="display:inline;">
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
    {{ $kelass->links() }}
@endsection

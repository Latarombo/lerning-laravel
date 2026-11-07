@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Guru</h1>

    <p>Selamat datang di Sistem Informasi Data Kelas.</p>
    <a href="{{ route('guru.create') }}"
        style="display:inline-block; margin-bottom:14px; padding:6px 14px; background-color:#2563eb; color:white; border-radius:4px;">Tambah
        Guru</a>

    {{-- Searchbar dan filter --}}
    <form method="GET" action="{{ route('guru.index') }}">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Nama atau mapel">
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
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama guru</th>
                <th>Mata pelajaran</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>

    {{ $gurus->links() }}

    <script>
        // 1. Mengambil data
        fetch('/api/guru')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });

        // 2. Menampilkan data
        fetch('/api/guru')
            .then(res => res.json())
            .then(result => {
                let html = '';
                result.data.forEach(function(item) {
                    html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.nama_guru}</td>
                        <td>${item.mapel}</td>
                    </tr>
                    `;
                });
                document.getElementById('tbody').innerHTML = html;
            });

        // 3. Menambah data
        fetch('/api/guru', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nama_guru: 'Guru Baru',
                mapel: 'Informatika'
            })
        });

        // 4. Mengubah data
        fetch('/api/guru/1', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nama_guru: 'Guru Terupdate',
                mapel: 'Kecerdasan Buatan'
            })
        });

        // 5. Menghapus data (ID 999 aman, tidak memicu cascade delete)
        fetch('/api/guru/999', {
            method: 'DELETE'
        });
    </script>
@endsection

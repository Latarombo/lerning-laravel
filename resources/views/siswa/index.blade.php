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
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>TB</th>
                <th>BB</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>

    {{ $siswas->links() }}

    <script>
        // Mengambil data
        fetch('/api/siswa')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });

        // Menampilkan data
        fetch('/api/siswa')
            .then(res => res.json())
            .then(result => {
                let html = '';
                result.data.forEach(function(item) {
                    html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.nama_siswa}</td>
                        <td>${item.tb} cm</td>
                        <td>${item.bb} kg</td>
                        <td>${item.kelas ? item.kelas.nama_kelas : '-'}</td>
                    </tr>
                    `;
                });
                document.getElementById('tbody').innerHTML = html;
            });

        // Menambah data
        fetch('/api/siswa', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nama_siswa: 'Zidane',
                bb: 45,
                tb: 170,
                kelas_id: {{ $kelas->first()->id ?? 1 }}
            })
        });

        // Mengubah data
        fetch('/api/siswa/1', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nama_siswa: 'Rizky Zidane',
                bb: 50,
                tb: 172,
                kelas_id: {{ $kelas->first()->id ?? 1 }}
            })
        });

        // Menghapus data
        fetch('/api/siswa/1', {
            method: 'DELETE'
        });
    </script>
@endsection

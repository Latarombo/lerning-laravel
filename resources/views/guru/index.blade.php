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
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>
    {{ $gurus->links() }}

    <script>
        // Mengambil data
        fetch('/api/guru')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });

        // Menampilkan data
        function tampilkanData() {
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page') || 1;

            fetch('/api/guru?page=' + page)
                .then(res => res.json())
                .then(result => {
                    let html = '';
                    result.data.forEach(function(item) {
                        html += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.nama_guru}</td>
                            <td>${item.mapel}</td>
                            <td>
                                <a href="/guru/edit/${item.id}" style="color: blue; margin-right: 6px;">Edit</a> |
                                <button onclick="hapusData(${item.id})" style="color: red; cursor: pointer;">Hapus</button>
                            </td>
                        </tr>
                        `;
                    });
                    document.getElementById('tbody').innerHTML = html;
                });
        }

        // Menghapus data
        function hapusData(id) {
            if (!confirm('Yakin ingin menghapus data guru ini?')) {
                return;
            }

            fetch('/api/guru/' + id, {
                method: 'DELETE'
            }).then(() => {
                tampilkanData();
            });
        }

        tampilkanData();
    </script>
@endsection

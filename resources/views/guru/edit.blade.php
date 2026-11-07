@extends('layouts.app')

@section('content')
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Guru</h1>

    <form id="formEditGuru">
        <label for="nama_guru">Nama guru:</label>
        <input type="text" name="nama_guru" id="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" required><br>

        <label for="mapel">Mata pelajaran:</label>
        <input type="text" name="mapel" id="mapel" value="{{ old('mapel', $guru->mapel) }}" required><br>

        <button type="submit" style="color:blue">Update</button>
        <a href="{{ route('guru.index') }}" style="color:red">Batal</a>
    </form>

    <script>
        // Mengubah data via AJAX (PUT)
        document.getElementById('formEditGuru').addEventListener('submit', function(e) {
            e.preventDefault();

            const namaGuru = document.getElementById('nama_guru').value;
            const mapel = document.getElementById('mapel').value;

            fetch('/api/guru/{{ $guru->id }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    nama_guru: namaGuru,
                    mapel: mapel
                })
            }).then(() => {
                window.location.href = '/guru';
            });
        });
    </script>
@endsection

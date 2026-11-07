@extends('layouts.app')

@section('content')
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Create Data Guru</h1>

    <form id="formTambahGuru">
        <label for="nama_guru">Nama guru:</label>
        <input type="text" name="nama_guru" id="nama_guru" required><br>

        <label for="mapel">Mata pelajaran:</label>
        <input type="text" name="mapel" id="mapel" required><br>

        <button type="submit" style="color:blue">Submit</button>
        <a href="{{ route('guru.index') }}" style="color:red">Batal</a>
    </form>

    <script>
        // Menambah data via AJAX (POST)
        document.getElementById('formTambahGuru').addEventListener('submit', function(e) {
            e.preventDefault();

            const namaGuru = document.getElementById('nama_guru').value;
            const mapel = document.getElementById('mapel').value;

            fetch('/api/guru', {
                method: 'POST',
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

@extends('layouts.app')

@section('content')
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Create Data Siswa</h1>

    <form id="formTambahSiswa">
        <label for="nama_siswa">Nama:</label>
        <input type="text" name="nama_siswa" id="nama_siswa" required><br>

        <label for="tb">TB:</label>
        <input type="number" name="tb" id="tb" required><br>

        <label for="bb">BB:</label>
        <input type="number" name="bb" id="bb" required><br>

        {{-- Kode tambahan untuk input kelas --}}
        <label for="kelas_id">Kelas:</label>
        <select name="kelas_id" id="kelas_id" required>
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}">
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select><br>

        <button type="submit" style="color:blue">Submit</button>
        <a href="{{ route('siswa.index') }}" style="color:red">Batal</a>
    </form>

    <script>
        // Menambah data via AJAX (POST)
        document.getElementById('formTambahSiswa').addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('nama_siswa').value;
            const tb = document.getElementById('tb').value;
            const bb = document.getElementById('bb').value;
            const kelasId = document.getElementById('kelas_id').value;

            fetch('/api/siswa', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    nama_siswa: nama,
                    tb: parseInt(tb),
                    bb: parseInt(bb),
                    kelas_id: parseInt(kelasId)
                })
            }).then(() => {
                window.location.href = '/siswa';
            });
        });
    </script>
@endsection

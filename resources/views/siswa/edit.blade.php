@extends('layouts.app')

@section('content')
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Siswa</h1>

    <form id="formEditSiswa">
        <label for="nama_siswa">Nama:</label>
        <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required><br>

        <label for="tb">TB:</label>
        <input type="number" name="tb" id="tb" value="{{ old('tb', $siswa->tb) }}" required><br>

        <label for="bb">BB:</label>
        <input type="number" name="bb" id="bb" value="{{ old('bb', $siswa->bb) }}" required><br>

        {{-- Kode input tambahan untuk edit kelas --}}
        <label for="kelas_id">Kelas:</label>
        <select name="kelas_id" id="kelas_id" required>
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" @selected(old('kelas_id', $siswa->kelas_id) == $k->id)>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select><br>

        <button type="submit" style="color:blue">Update</button>
        <a href="{{ route('siswa.index') }}" style="color:red">Batal</a>
    </form>

    <script>
        // Mengubah data via AJAX (PUT)
        document.getElementById('formEditSiswa').addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('nama_siswa').value;
            const tb = document.getElementById('tb').value;
            const bb = document.getElementById('bb').value;
            const kelasId = document.getElementById('kelas_id').value;

            fetch('/api/siswa/{{ $siswa->id }}', {
                method: 'PUT',
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

@extends('layouts.app')

@section('content')
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Kelas</h1>

    <form id="formEditKelas">
        <label for="nama_kelas">Kelas:</label>
        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required><br>

        <label for="guru_id">Guru:</label>
        <select name="guru_id" id="guru_id" required>
            <option value="">Pilih Guru</option>
            @foreach ($gurus as $g)
                <option value="{{ $g->id }}" @selected(old('guru_id', $kelas->guru_id) == $g->id)>
                    {{ $g->nama_guru }} - {{ $g->mapel }}
                </option>
            @endforeach
        </select><br>

        <button type="submit" style="color:blue">Update</button>
        <a href="{{ route('kelas.index') }}" style="color:red">Batal</a>
    </form>

    <script>
        // Mengubah data via AJAX (PUT)
        document.getElementById('formEditKelas').addEventListener('submit', function(e) {
            e.preventDefault();

            const namaKelas = document.getElementById('nama_kelas').value;
            const guruId = document.getElementById('guru_id').value;

            fetch('/api/kelas/{{ $kelas->id }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    nama_kelas: namaKelas,
                    guru_id: parseInt(guruId)
                })
            }).then(() => {
                window.location.href = '/kelas';
            });
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Siswa</h1>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_siswa">Nama:</label>
        <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}"><br>

        <label for="tb">TB:</label>
        <input type="number" name="tb" value="{{ old('tb', $siswa->tb) }}"><br>

        <label for="bb">BB:</label>
        <input type="number" name="bb" value="{{ old('bb', $siswa->bb) }}"><br>

        {{-- Kode input tambahan untuk edit kelas --}}
        <label for="kelas_id">Kelas:</label>
        <select name="kelas_id" id="kelas_id">
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
@endsection

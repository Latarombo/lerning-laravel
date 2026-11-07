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
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Kelas</h1>

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_kelas">Kelas:</label>
        <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"><br>

        <label for="guru_id">Guru:</label>
        <select name="guru_id" id="guru_id">
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
@endsection

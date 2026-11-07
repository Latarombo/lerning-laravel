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
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Edit Data Guru</h1>

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_guru">Nama guru:</label>
        <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}"><br>

        <label for="mapel">Mata pelajaran:</label>
        <input type="text" name="mapel" value="{{ old('mapel', $guru->mapel) }}"><br>

        <button type="submit" style="color:blue">Update</button>
        <a href="{{ route('guru.index') }}" style="color:red">Batal</a>
    </form>
@endsection

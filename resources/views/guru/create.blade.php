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
    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Create Data Guru</h1>
    <form action="{{ route('guru.store') }}" method="POST">
        @csrf
        <label for="nama_guru">Nama guru:</label>
        <input type="text" name="nama_guru" value="{{ old('nama_guru') }}"><br>

        <label for="mapel">Mata pelajaran:</label>
        <input type="text" name="mapel" value="{{ old('mapel') }}"><br>

        <button type="submit" style="color:blue">Submit</button>
        <a href="{{ route('guru.index') }}" style="color:red">Batal</a>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <a href="{{ route('kelas.index') }}" style="color:blue">Kembali</a>

    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Detail Siswa Kelas
        {{ $kelas->nama_kelas }}</h1>

    <p>Nama Kelas: {{ $kelas->nama_kelas }}</p>
    <p>Nama Guru: {{ $kelas->guru->nama_guru }}</p>
    <p>Mata Pelajaran: {{ $kelas->guru->mapel }}</p>

    <h2 style="font-size: 21px; font-weight: 600; color: #111827; margin-bottom: 6px;">Daftar Siswa</h2>

    <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Nama Siswa</th>
            <th>TB</th>
            <th>BB</th>
        </tr>
        @foreach ($kelas->siswa as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nama_siswa }}</td>
                <td>{{ $s->tb }}</td>
                <td>{{ $s->bb }}</td>
            </tr>
        @endforeach
    </table>
@endsection

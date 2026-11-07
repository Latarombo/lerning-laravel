@extends('layouts.app')

@section('content')
    <a href="{{ route('kelas.index') }}" style="color:blue">Kembali</a>

    <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Detail Siswa Kelas
        <span id="judul_kelas">{{ $kelas->nama_kelas }}</span></h1>

    <p>Nama Kelas: <span id="nama_kelas">-</span></p>
    <p>Nama Guru: <span id="nama_guru">-</span></p>
    <p>Mata Pelajaran: <span id="mapel">-</span></p>

    <h2 style="font-size: 21px; font-weight: 600; color: #111827; margin-bottom: 6px;">Daftar Siswa</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama Siswa</th>
                <th>TB</th>
                <th>BB</th>
            </tr>
        </thead>
        <tbody id="tbody_siswa">
        </tbody>
    </table>

    <script>
        // Mengambil dan menampilkan data detail kelas beserta siswa via AJAX (GET)
        fetch('/api/kelas/{{ $kelas->id }}')
            .then(res => res.json())
            .then(result => {
                const data = result.data;
                document.getElementById('nama_kelas').textContent = data.nama_kelas;
                document.getElementById('judul_kelas').textContent = data.nama_kelas;
                document.getElementById('nama_guru').textContent = data.guru ? data.guru.nama_guru : '-';
                document.getElementById('mapel').textContent = data.guru ? data.guru.mapel : '-';

                let html = '';
                if (data.siswa && data.siswa.length > 0) {
                    data.siswa.forEach((item, index) => {
                        html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_siswa}</td>
                            <td>${item.tb} cm</td>
                            <td>${item.bb} kg</td>
                        </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4" style="text-align:center;">Belum ada siswa di kelas ini.</td></tr>';
                }
                document.getElementById('tbody_siswa').innerHTML = html;
            });
    </script>
@endsection

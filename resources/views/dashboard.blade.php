<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div>
                @if (session('success'))
                    <div style="color:green;">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 6px;">Data Siswa</h1>

                <p>Selamat datang di Sistem Informasi Data Siswa.</p>

                <a href="{{ route('siswa.create') }}"
                    style="display:inline-block; margin-bottom:14px; padding:6px 14px; background-color:#2563eb; color:white; border-radius:4px;">Tambah
                    Siswa</a>

                <table border="1">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>TB</th>
                        <th>BB</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($siswas as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>{{ $s->tb }}</td>
                            <td>{{ $s->bb }}</td>
                            <td>{{ $s->kelas?->nama_kelas}}</td>
                            <td>{{ $s->kelas?->guru?->nama_guru}}</td>
                            <td>
                                <a href="{{ route('siswa.edit', $s->id) }}" style="color:blue">Edit</a> |

                                <form action="{{ route('siswa.destroy', $s->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color:red;" onclick="return confirm('Yakin hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

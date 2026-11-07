<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function welcome()
    {
        $judul = "Welcome";
        return view('welcome', compact('judul'));
    }

    public function profile()
    {
        $judul = "Profile";
        return view('profile', compact('judul'));
    }

    public function guru()
    {
        $judul = "Guru";
        return view('guru', compact('judul'));
    }

    public function siswa()
    {
        $judul = "Siswa";
        return view('siswa', compact('judul'));
    }

    public function kelas()
    {
        $judul = "Kelas";
        return view('kelas', compact('judul'));
    }

    public function dashboard_admin()
    {
        $judul = "Dashboard";
        return view('admin.dashboard', compact('judul'));
    }
}

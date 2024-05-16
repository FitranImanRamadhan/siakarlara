<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Absensi;
use App\Models\Gaji;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahUsers = User::count(); // Menghitung jumlah user
        $jumlahPegawais = Pegawai::count(); // Menghitung jumlah pegawai
        $jumlahAbsensis = Absensi::count(); // Menghitung jumlah absensi
        $jumlahGajis = Gaji::count(); // Menghitung jumlah gaji

        return view('home', [
            'title' => 'Home',
            'jumlahUsers' => $jumlahUsers,
            'jumlahPegawais' => $jumlahPegawais,
            'jumlahAbsensis' => $jumlahAbsensis,
            'jumlahGajis' => $jumlahGajis,
        ]);
    }
}

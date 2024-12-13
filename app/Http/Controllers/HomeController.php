<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the auth middleware to all methods except the loker method
        $this->middleware('auth')->except('loker', 'kontak', 'about');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('abouts.index');
    }

    public function kontak()
    {
        return view('kontaks.index');
    }


    public function loker()
{
    $lokers = Loker::leftJoin('galeris', 'lokers.kode_loker', '=', 'galeris.kode_loker')
        ->get(['lokers.*', 'galeris.*']);
    return view('lokers.index2', compact('lokers'));
}

public function welcome()
{
    // Mengambil data promo dengan foto dari galeris
    $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
        ->where('promos.kategori', 'Dahsyat')
        ->select('promos.*', 'galeris.foto')
        ->get();

    // Mengirim data promo ke view 'welcome'
    return view('welcome', compact('promos'));
}

}

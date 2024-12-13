<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Promo;

class PromoController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Promo::class, 'promo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $promos = Promo::query();

        if (!empty($request->search)) {
            $promos->where('kode_promo', 'like', '%' . $request->search . '%');
        }

        $promos = $promos->paginate(10);

        return view('promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promos.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([]);

        try {

            $promo = new Promo();
            $promo->kode_promo = $request->kode_promo;
            $promo->nama = $request->nama;
            $promo->harga_awal = $request->harga_awal;
            $promo->harga_promo = $request->harga_promo;
            $promo->kategori = $request->kategori;
            $promo->periode = $request->periode;
            $promo->save();

            return redirect()->route('promos.index', [])->with('success', __('Promo created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('promos.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Promo $promo
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {

        return view('promos.show', compact('promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Promo $promo
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {

        return view('promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {

        $request->validate([]);

        try {
            $promo->kode_promo = $request->kode_promo;
            $promo->nama = $request->nama;
            $promo->harga_awal = $request->harga_awal;
            $promo->harga_promo = $request->harga_promo;
            $promo->kategori = $request->kategori;
            $promo->periode = $request->periode;
            $promo->save();

            return redirect()->route('promos.index', [])->with('success', __('Promo edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('promos.edit', compact('promo'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Promo $promo
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {

        try {
            $promo->delete();

            return redirect()->route('promos.index', [])->with('success', __('Promo deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('promos.index', [])->with('error', 'Cannot delete Promo: ' . $e->getMessage());
        }
    }

    public function reguler()
    {
        $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
            ->where('promos.kategori', 'Reguler')
            ->select('promos.*', 'galeris.foto')
            ->get();

        return view('promos.reguler', compact('promos'));
    }

    public function mailer()
{
    $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
        ->where('promos.kategori', 'Mailer')
        ->select('promos.*', 'galeris.foto')
        ->paginate(4); // Menampilkan 4 promo per halaman
    return view('promos.mailer', compact('promos'));
}


    public function dahsyat()
    {
        $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
            ->where('promos.kategori', 'Dahsyat')
            ->select('promos.*', 'galeris.foto')
            ->get();

        return view('promos.dahsyat', compact('promos'));
    }

    public function cap()
    {
        $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
            ->where('promos.kategori', 'CAP')
            ->select('promos.*', 'galeris.kode_loker', 'galeris.foto')
            ->get();

        return view('promos.cap', compact('promos'));
    }

    public function welcome()
    {
        $promos = Promo::leftJoin('galeris', 'promos.kategori', '=', 'galeris.kategori_promo')
        ->where('promos.kategori', 'Dahsyat')
        ->select('promos.*', 'galeris.foto')
        ->get();

    return view('welcome', compact('promos'));
    }
}

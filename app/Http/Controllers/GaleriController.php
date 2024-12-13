<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Galeri;
use App\Models\Loker;
use App\Models\Promo;

class GaleriController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Galeri::class, 'galeri');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        // Query untuk kode_loker
        $galeriPromo = Galeri::query();
        if ($searchTerm) {
            $galeriPromo->where('kategori_promo', 'like', "%{$searchTerm}%");
        }
        $galeriPromo = $galeriPromo->whereNotNull('kategori_promo')->paginate(10, ['*']);


        $galeriLoker = Galeri::query();
        if ($searchTerm) {
            $galeriLoker->where('kode_loker', 'like', "%{$searchTerm}%");
        }
        $galeriLoker = $galeriLoker->whereNotNull('kode_loker')->paginate(10, ['*']);


        return view('galeris.index', compact('galeriPromo', 'galeriLoker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = Promo::all();
        return view('galeris.create', compact('promos'));
    }

    public function createloker()
    {
        $lokers = Loker::all();
        return view('galeris.createloker', compact('lokers'));
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
        $request->validate([
            'kategori_promo' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Simpan foto ke direktori
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $lokasi_foto = 'assets/img/galeri';
            $foto->move($lokasi_foto, $nama_foto);

            // Simpan data galeri ke database
            $galeri = new Galeri();
            $galeri->kategori_promo = $request->kategori_promo;
            $galeri->foto = $lokasi_foto . '/' . $nama_foto;
            $galeri->save();

            return redirect()->route('galeris.index')->with('success', __('Galeri created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('galeris.create')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeloker(Request $request)
    {
        $request->validate([
            'kode_loker' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Simpan foto ke direktori
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $lokasi_foto = 'assets/img/galeri';
            $foto->move($lokasi_foto, $nama_foto);

            // Simpan data galeri ke database
            $galeri = new Galeri();
            $galeri->kode_loker = $request->kode_loker;
            $galeri->foto = $lokasi_foto . '/' . $nama_foto;
            $galeri->save();

            return redirect()->route('galeris.index')->with('success', __('Galeri created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('galeris.createloker')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Galeri $galeri
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {

        return view('galeris.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Galeri $galeri
     *
     * @return \Illuminate\Http\Response
     */
public function edit(Galeri $galeri)
    {

        return view('galeris.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'kategori_promo' => 'required',
            'kode_loker' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Update data galeri
            $galeri->kategori_promo = $request->kategori_promo;
            $galeri->kode_loker = $request->kode_loker;

            // Cek apakah ada foto baru diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $nama_foto = time() . '_' . $foto->getClientOriginalName();
                $lokasi_foto = 'assets/img/galeri';
                $foto->move($lokasi_foto, $nama_foto);

                // Hapus foto lama jika ada
                if (file_exists(public_path($galeri->foto))) {
                    unlink(public_path($galeri->foto));
                }

                // Simpan foto baru ke database
                $galeri->foto = $lokasi_foto . '/' . $nama_foto;
            }

            $galeri->save();

            return redirect()->route('galeris.index')->with('success', __('Galeri edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('galeris.edit', compact('galeri'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Galeri $galeri
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {

        try {
            $galeri->delete();

            return redirect()->route('galeris.index', [])->with('success', __('Galeri deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('galeris.index', [])->with('error', 'Cannot delete Galeri: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Loker;

class LokerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Loker::class, 'loker');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $lokers = Loker::query();

        if (!empty($request->search)) {
            $lokers->where('kode_loker', 'like', '%' . $request->search . '%');
        }

        $lokers = $lokers->paginate(10);

        return view('lokers.index', compact('lokers'));
    }

    public function index2()
    {
        $lokers = Loker::leftJoin('galeris', 'lokers.kode_loker', '=', 'galeris.kode_loker')
            ->select('lokers.*', 'galeris.kategori_promo', 'galeris.foto')
            ->get();

        return view('lokers.index2', compact('lokers'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('lokers.create', []);
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

            $loker = new Loker();
            $loker->kode_loker = $request->kode_loker;
            $loker->nama = $request->nama;
            $loker->save();

            return redirect()->route('lokers.index', [])->with('success', __('Loker created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('lokers.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Loker $loker
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Loker $loker)
    {

        return view('lokers.show', compact('loker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Loker $loker
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Loker $loker)
    {

        return view('lokers.edit', compact('loker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loker $loker)
    {

        $request->validate([]);

        try {
            $loker->kode_loker = $request->kode_loker;
            $loker->nama = $request->nama;
            $loker->save();

            return redirect()->route('lokers.index', [])->with('success', __('Loker edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('lokers.edit', compact('loker'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Loker $loker
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loker $loker)
    {

        try {
            $loker->delete();

            return redirect()->route('lokers.index', [])->with('success', __('Loker deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('lokers.index', [])->with('error', 'Cannot delete Loker: ' . $e->getMessage());
        }
    }
}

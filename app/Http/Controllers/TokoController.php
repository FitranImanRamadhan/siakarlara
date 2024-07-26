<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Toko;

class TokoController extends Controller {

    public function __construct() {
		$this->authorizeResource(Toko::class, 'toko');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $tokos = Toko::query();

        if(!empty($request->search)) {
			$tokos->where('toko', 'like', '%' . $request->search . '%');
		}

        $tokos = $tokos->paginate(10);

        return view('tokos.index', compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('tokos.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ) {

        $request->validate(["toko" => "required"]);

        try {

            $toko = new Toko();
            $toko->toko = $request->toko;
            $toko->save();

            return redirect()->route('tokos.index', [])->with('success', __('Toko created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('tokos.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Toko $toko
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko,) {

        return view('tokos.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Toko $toko
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko,) {

        return view('tokos.edit', compact('toko'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toko $toko,) {

        $request->validate(["toko" => "required"]);

        try {
            $toko->toko = $request->toko;
            $toko->save();

            return redirect()->route('tokos.index', [])->with('success', __('Toko edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('tokos.edit', compact('toko'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Toko $toko
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko,) {

        try {
            $toko->delete();

            return redirect()->route('tokos.index', [])->with('success', __('Toko deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('tokos.index', [])->with('error', 'Cannot delete Toko: ' . $e->getMessage());
        }
    }

    
}

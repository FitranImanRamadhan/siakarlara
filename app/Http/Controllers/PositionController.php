<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Position;

class PositionController extends Controller {

    public function __construct() {
		$this->authorizeResource(Position::class, 'position');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $positions = Position::query();

        if(!empty($request->search)) {
			$positions->where('jabatan', 'like', '%' . $request->search . '%');
		}

        $positions = $positions->paginate(10);

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('positions.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ) {

        $request->validate(["jabatan" => "required"]);

        try {

            $position = new Position();
            $position->jabatan = $request->jabatan;
            $position->save();

            return redirect()->route('positions.index', [])->with('success', __('Position created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('positions.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Position $position
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position,) {

        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Position $position
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position,) {

        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position,) {

        $request->validate(["jabatan" => "required"]);

        try {
            $position->jabatan = $request->jabatan;
            $position->save();

            return redirect()->route('positions.index', [])->with('success', __('Position edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('positions.edit', compact('position'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Position $position
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position,) {

        try {
            $position->delete();

            return redirect()->route('positions.index', [])->with('success', __('Position deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('positions.index', [])->with('error', 'Cannot delete Position: ' . $e->getMessage());
        }
    }

    
}

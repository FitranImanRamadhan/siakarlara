<?php

namespace App\Http\Controllers;

use App\Exports\ExportPositions;
use App\Models\Position;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{
    public function index()
    {
        $title = "Data Positions";
        $positions = Position::orderBy('id', 'asc')->paginate(5);
        return view('positions.index', compact(['positions', 'title']));
    }

    public function create()
    {
        $title = "Tambah data position";
        return view('positions.create', compact(['title']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'gaji_perhari' => 'required',
            'tunjangan_jabatan' => 'required',
            'uang_makan' => 'required',
        ]);

        Position::create($request->post());

        return redirect()->route('positions.index')->with('success', 'Positions has been created successfully.');
    }


    public function show(Position $position)
    {
        return view('positions.show', compact('positions'));
    }


    public function edit(Position $position)
    {
        $title = "Edit Data position";
        return view('positions.edit', compact('position', 'title'));
    }


    public function update(Request $request, Position $position)
    {
        $request->validate([
            'jabatan' => 'required',
            'gaji_perhari' => 'required',
            'tunjangan_jabatan' => 'required',
            'uang_makan' => 'required',
        ]);

        $position->fill($request->post())->save();

        return redirect()->route('positions.index')->with('success', 'Positions Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Positions  $Positions
     * @return \Illuminate\Http\Response
     */

     
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Positions has been deleted successfully');
    }

    public function exportExcel()
    {
        return Excel::download(new ExportPositions, 'Positions.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\Exportpotongans;
use App\Models\potongan;

use App\Models\Umr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PotonganController extends Controller
{
    public function index()
{
    $title = "Data Potongan";
    $potongans = Potongan::with('umr')->orderBy('id', 'asc')->paginate(15);
    return view('potongans.index', compact('potongans', 'title'));
}


    public function create()
    {
        $title = "Tambah data potongan";
        $umr = Umr::all();
        return view('potongans.create', compact(['title','umr']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'umr_id' => 'required',
            'bpjs_tk' => 'required',
            'bpjs_kes' => 'required',
            'alpha' => 'required',
        ]);

        Potongan::create($request->post());

        return redirect()->route('potongans.index')->with('success', 'Potongans has been created successfully.');
    }


    public function show(Potongan $potongan)
    {
        return view('potongans.show', compact('potongans'));
    }


    public function edit(Potongan $potongan)
    {
        $title = "Edit Data potongan";
        $umr = Umr::all();
        return view('potongans.edit', compact('potongan', 'title','umr'));
    }


    public function update(Request $request, Potongan $potongan)
    {
        $request->validate([
            'umr_id' => 'required',
            'bpjs_tk' => 'required',
            'bpjs_kes' => 'required',
            'alpha' => 'required',
        ]);

        $potongan->fill($request->post())->save();

        return redirect()->route('potongans.index')->with('success', 'Potongans Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Potongans  $Potongans
     * @return \Illuminate\Http\Response
     */

     
    public function destroy(Potongan $potongan)
    {
        $potongan->delete();
        return redirect()->route('potongans.index')->with('success', 'Potongans has been deleted successfully');
    }

}

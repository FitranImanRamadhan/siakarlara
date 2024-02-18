<?php

namespace App\Http\Controllers;


use App\Models\Umr;
use Illuminate\Http\Request;


class UmrController extends Controller
{
    public function index()
    {
        $title = "Data Umrs";
        $umrs = Umr::orderBy('id', 'asc')->paginate(5);
        return view('umrs.index', compact(['umrs', 'title']));
    }

    public function create()
    {
        $title = "Tambah data umrs";
        return view('umrs.create', compact(['title']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required',
            'upah_umr' => 'required',
        ]);

        Umr::create($request->post());

        return redirect()->route('umrs.index')->with('success', 'Umrs has been created successfully.');
    }


    public function show(Umr $umr)
    {
        return view('umrs.show', compact('umrs'));
    }


    public function edit(Umr $umr)
    {
        $title = "Edit Data umrs";
        return view('umrs.edit', compact('umr', 'title'));
    }


    public function update(Request $request, Umr $umr)
    {
        $request->validate([
            'kota' => 'required',
            'upah_umr' => 'required',
        ]);

        $umr->fill($request->post())->save();

        return redirect()->route('umrs.index')->with('success', 'Umrs Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Umrs  $umrs
     * @return \Illuminate\Http\Response
     */

     
    public function destroy(Umr $umr)
    {
        $umr->delete();
        return redirect()->route('umrs.index')->with('success', 'Umrs has been deleted successfully');
    }


    
}

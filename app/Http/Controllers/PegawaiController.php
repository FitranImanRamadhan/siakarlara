<?php

namespace App\Http\Controllers;

use App\Exports\ExportPegawais;
use App\Imports\PegawaisImport;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Position;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{

    public function index()
{
    $title = "Data pegawai";
    $pegawais = Pegawai::with('position', 'toko')->get();
    return view('pegawais.index', compact(['pegawais', 'title']));
}


    public function create()
    {
        $title = "Tambah data pegawai";
        $pst = Position::all();
        $tk = Toko::all();
        return view('pegawais.create', compact(['title', 'pst', 'tk']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'toko' => 'required',
            'score' => 'required',
        ]);

        // Buat pegawai baru
        $pegawai = Pegawai::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'toko' => $request->toko,
            'score' => $request->score,
        ]);

        // Jika checkbox "Buat user login" dicentang
        if ($request->has('buat_user')) {
            $request->validate([
                'email' => 'required|unique:users',
                'password' => 'required',
                'hak_akses' => 'required',
            ]);

            // Buat pengguna baru dan kaitkan dengan pegawai
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'hak_akses' => $request->hak_akses,
                'pegawai_id' => $pegawai->id, // Kaitkan dengan pegawai yang baru dibuat
            ]);
        }

        return redirect()->route('pegawais.index')->with('success', 'Pegawai dan pengguna telah berhasil ditambahkan.');
    }



    public function show(Pegawai $pegawai)
    {
        return view('pegawais.show', compact('pegawai'));
    }


    public function edit(Pegawai $pegawai)
    {
        $title = "Edit Data pegawai";
        $pst = Position::all();
        $tk = Toko::all();
        return view('pegawais.edit', compact('pegawai', 'title', 'pst', 'tk'));
    }


    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'toko' => 'required',
            'score' => 'required',
        ]);

        $pegawai->fill($request->post())->save();

        return redirect()->route('pegawais.index')->with('success', 'Pegawais Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawais  $Pegawais
     * @return \Illuminate\Http\Response
     */


    public function destroy(Pegawai $pegawai)
    {
        // Hapus pengguna terkait
        $user = $pegawai->user;
        if ($user) {
            $user->delete();
        }

        // Hapus pegawai
        $pegawai->delete();

        return redirect()->route('pegawais.index')->with('success', 'Pegawai dan pengguna terkait telah berhasil dihapus.');
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new ExportPegawais, 'Pegawais.xlsx');
    // }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new PegawaisImport, $request->file('file'));

        return redirect()->route('pegawais.index')->with('success', 'Data Pegawai berhasil diimpor.');
    }

    public function export()
    {
        return Excel::download(new ExportPegawais, 'pegawai.xlsx');
    }
}

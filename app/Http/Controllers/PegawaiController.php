<?php

namespace App\Http\Controllers;

use App\Exports\ExportPegawais;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    
    public function index()
    {
        $title = "Data pegawai";
        $pegawais = Pegawai::with('position')->paginate(15);
        return view('pegawais.index', compact(['pegawais', 'title']));
    }

    public function create()
    {
        $title = "Tambah data pegawai";
        $pst = Position::all();
        return view('pegawais.create', compact(['title','pst']));
    }


    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'position_id' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_bergabung' => 'required',
    ]);

    // Buat pegawai baru
    $pegawai = Pegawai::create([
        'nama' => $request->nama,
        'position_id' => $request->position_id,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_bergabung' => $request->tanggal_bergabung,
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
        return view('pegawais.show', compact('pegawais'));
    }


    public function edit(Pegawai $pegawai)
    {
        $title = "Edit Data pegawai";
        $pst = Position::all();
        return view('pegawais.edit', compact('pegawai', 'title','pst'));
    }


    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required',
            'position_id' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_bergabung' => 'required',
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
}

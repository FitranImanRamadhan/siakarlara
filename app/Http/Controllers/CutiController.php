<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Cuti;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CutiController extends Controller {

    public function __construct() {
		$this->authorizeResource(Cuti::class, 'cuti');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ) {

        $cutis = Cuti::query();

        if(!empty($request->search)) {
			$cutis->where('nama', 'like', '%' . $request->search . '%');
		}

        $cutis = $cutis->paginate(10);

        return view('cutis.index', compact('cutis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti,) {

        return view('cutis.show', compact('cuti'));
    }


    public function create()
    {
        return view('cutis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'nullable|string',
            'date_cuti' => 'nullable|string',
            'end_cuti' => 'nullable|string',
            'jumlah_cuti' => 'nullable|string',
            'toko' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'jenis_cuti' => 'nullable|string',
            'alasan_cuti' => 'nullable|string',
            'ambil_tugas' => 'nullable|string',
            'filename' => 'nullable|string',
            'image_data' => 'nullable|string',
            'status' => 'nullable|string',
            'kode' => 'nullable|string',
            'date_acc' => 'nullable|string',
        ]);

        try {
            $cuti = new Cuti();
            $cuti->id = $request->id;
            $cuti->nama = $request->nama;
            $cuti->date_cuti = $request->date_cuti;
            $cuti->end_cuti = $request->end_cuti;
            $cuti->jumlah_cuti = $request->jumlah_cuti;
            $cuti->toko = $request->toko;
            $cuti->jabatan = $request->jabatan;
            $cuti->jenis_cuti = $request->jenis_cuti;
            $cuti->alasan_cuti = $request->alasan_cuti;
            $cuti->ambil_tugas = $request->ambil_tugas;
            $cuti->filename = $request->filename;
            $cuti->image_data = $request->image_data;
            $cuti->status = $request->status;
            $cuti->kode = $request->kode;
            $cuti->date_acc = $request->date_acc;
            $cuti->save();

            return redirect()->route('cutis.index')->with('success', __('Cuti created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.create')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti,) {

        return view('cutis.edit', compact('cuti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti,) {

        $request->validate(["urut" => "required|unique:cutis,urut,$cuti->id"]);

        try {
            $cuti->urut = $request->urut;
		$cuti->nama = $request->nama;
		$cuti->date_cuti = $request->date_cuti;
		$cuti->end_cuti = $request->end_cuti;
		$cuti->jumlah_cuti = $request->jumlah_cuti;
		$cuti->toko = $request->toko;
		$cuti->jabatan = $request->jabatan;
		$cuti->jenis_cuti = $request->jenis_cuti;
		$cuti->alasan_cuti = $request->alasan_cuti;
		$cuti->ambil_tugas = $request->ambil_tugas;
		$cuti->filename = $request->filename;
		$cuti->image_data = $request->image_data;
		$cuti->status = $request->status;
		$cuti->kode = $request->kode;
		$cuti->date_acc = $request->date_acc;
            $cuti->save();

            return redirect()->route('cutis.index', [])->with('success', __('Cuti edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.edit', compact('cuti'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti,) {

        try {
            $cuti->delete();

            return redirect()->route('cutis.index', [])->with('success', __('Cuti deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.index', [])->with('error', 'Cannot delete Cuti: ' . $e->getMessage());
        }
    }

    public function acc(Request $request, Cuti $cuti)
{
    try {
        // Lakukan proses Acc
        $cuti->update([
            'status' => 'Sudah Acc',
            'date_acc' => now(), // Atau gunakan tanggal yang diperlukan
        ]);

        // Kirim response JSON ke JavaScript dengan data Cuti yang telah di-Acc
        return response()->json([
            'success' => true,
            'cuti' => $cuti
        ]);
    } catch (\Throwable $e) {
        // Tangani kesalahan jika terjadi
        return response()->json([
            'success' => false,
            'message' => 'Failed to update status: ' . $e->getMessage(),
        ]);
    }
}


public function reject(Request $request, Cuti $cuti)
{
    try {
        // Update status to "Tidak Acc"
        $cuti->status = 'Tidak Acc';
        $cuti->date_acc = now(); // Set the current date/time as date_acc
        $cuti->save();

        return response()->json([
            'success' => true,
            'cuti' => $cuti, // Kirim objek cuti untuk dipindahkan ke tabel kedua dalam JavaScript
        ]);
    } catch (\Throwable $e) {
        // Tangani kesalahan jika terjadi
        return response()->json([
            'success' => false,
            'message' => 'Failed to update status: ' . $e->getMessage(),
        ]);
    }
}
}

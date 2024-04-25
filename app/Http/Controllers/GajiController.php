<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gaji;
use App\Models\Absensi;

class GajiController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Gaji::class, 'gaji');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,)
    {

        $gajis = Gaji::query();

        $gajis->with('absensi');
        $gajis->with('pegawai');
        $gajis->with('potongan');

        if (!empty($request->search)) {
            $gajis->where('tahun', 'like', '%' . $request->search . '%');
        }

        $gajis = $gajis->paginate(10);

        return view('gajis.index', compact('gajis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $absensis = [];
        $pegawais = \App\Models\Pegawai::all();
        $potongans = \App\Models\Potongan::all();

        if($request->has('bulan') && $request->has('tahun') && $request->has('pegawai')){
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            $pegawai = $request->input('pegawai');
            $absensis = \App\Models\Absensi::Where(['bulan'=>$bulan, 'tahun'=>$tahun , 'pegawai_id'=> $pegawai])->first();
        }
        return view('gajis.create', compact('absensis', 'pegawais', 'potongans'));
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

        $request->validate(["tanggal_gajian" => "required", "absensi_id" => "required", "pegawai_id" => "required", "potongan_id" => "required", "tahun" => "required", "bulan" => "required", "total_gaji" => "required", "gaji_kotor" => "required", "gaji_bersih" => "required", "pembulatan" => "required", "gaji_diterima" => "required"]);

        try {

            $gaji = new Gaji();
            $gaji->tanggal_gajian = $request->tanggal_gajian;
            $gaji->absensi_id = $request->absensi_id;
            $gaji->pegawai_id = $request->pegawai_id;
            $gaji->potongan_id = $request->potongan_id;
            $gaji->tahun = $request->tahun;
            $gaji->bulan = $request->bulan;
            $gaji->total_gaji = $request->total_gaji;
            $gaji->gaji_kotor = $request->gaji_kotor;
            $gaji->gaji_bersih = $request->gaji_bersih;
            $gaji->pembulatan = $request->pembulatan;
            $gaji->gaji_diterima = $request->gaji_diterima;
            $gaji->remember_token = $request->remember_token;
            $gaji->save();

            return redirect()->route('gajis.index', [])->with('success', __('Gaji created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('gajis.create', [])->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gaji $gaji
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Gaji $gaji,)
    {

        return view('gajis.show', compact('gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Gaji $gaji
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji,)
    {

        $absensis = \App\Models\Absensi::all();
        $pegawais = \App\Models\Pegawai::all();
        $potongans = \App\Models\Potongan::all();
        return view('gajis.edit', compact('gaji', 'absensis', 'pegawais', 'potongans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji,)
    {

        $request->validate(["tanggal_gajian" => "required", "absensi_id" => "required", "pegawai_id" => "required", "potongan_id" => "required", "tahun" => "required", "bulan" => "required", "total_gaji" => "required", "gaji_kotor" => "required", "gaji_bersih" => "required", "pembulatan" => "required", "gaji_diterima" => "required"]);

        try {
            $gaji->tanggal_gajian = $request->tanggal_gajian;
            $gaji->absensi_id = $request->absensi_id;
            $gaji->pegawai_id = $request->pegawai_id;
            $gaji->potongan_id = $request->potongan_id;
            $gaji->tahun = $request->tahun;
            $gaji->bulan = $request->bulan;
            $gaji->total_gaji = $request->total_gaji;
            $gaji->gaji_kotor = $request->gaji_kotor;
            $gaji->gaji_bersih = $request->gaji_bersih;
            $gaji->pembulatan = $request->pembulatan;
            $gaji->gaji_diterima = $request->gaji_diterima;
            $gaji->remember_token = $request->remember_token;
            $gaji->save();

            return redirect()->route('gajis.index', [])->with('success', __('Gaji edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('gajis.edit', compact('gaji'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gaji $gaji
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaji $gaji,)
    {

        try {
            $gaji->delete();

            return redirect()->route('gajis.index', [])->with('success', __('Gaji deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('gajis.index', [])->with('error', 'Cannot delete Gaji: ' . $e->getMessage());
        }
    }

    public function getAbsensiData(Request $request)
    {
        // Ambil tahun dan bulan dari request
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        // Query untuk mendapatkan data absensi berdasarkan tahun dan bulan
        $absensis = Absensi::where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->with('pegawai') // Mengambil relasi pegawai
            ->get();

        // Mengambil nama-nama pegawai dari data absensi
        $pegawaiNames = $absensis->pluck('pegawai.nama')->unique();

        return response()->json([
            'pegawai_names' => $pegawaiNames,
        ]);
    }
}

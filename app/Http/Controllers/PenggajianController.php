<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggajian;
use App\Models\Absensi;

class PenggajianController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Penggajian::class, 'penggajian');
    }

    public function index(Request $request)
    {
        $penggajians = Penggajian::query();
        $penggajians->with('absensi');

        if (!empty($request->search)) {
            $penggajians->where('tahun', 'like', '%' . $request->search . '%');
        }

        $penggajians = $penggajians->paginate(10);

        return view('penggajians.index', compact('penggajians'));
    }

    public function create(Request $request)
{
    $tahun = $request->input('tahun');
    $bulan = $request->input('bulan');

    if ($tahun && $bulan) {
        $absensis = Absensi::where('tahun', $tahun)
                            ->where('bulan', $bulan)
                            ->get();
    } else {
        $absensis = collect();
        $tahun = null;
        $bulan = null;
    }

    return view('penggajians.create', compact('absensis', 'tahun', 'bulan'));
}

    public function store(Request $request)
    {
        
        $request->validate([
            'tahun' => 'required',
            'bulan' => 'required',
            'absensi_id.*' => 'required',
            'total_gaji.*' => 'required',
            'gaji_kotor.*' => 'required',
            'bpjs_tk.*' => 'required',
            'bpjs_kes.*' => 'required',
            'gaji_bersih.*' => 'required',
            'pembulatan.*' => 'required',
            'gaji_diterima.*' => 'required',
        ]);

        try {
            foreach ($request->absensi_id as $key => $absensi_id) {
                Penggajian::create([
                    'absensi_id' => $absensi_id,
                    'tahun' => $request->tahun,
                    'bulan' => $request->bulan,
                    'total_gaji' => $request->total_gaji[$key],
                    'gaji_kotor' => $request->gaji_kotor[$key],
                    'bpjs_tk' => $request->bpjs_tk[$key],
                    'bpjs_kes' => $request->bpjs_kes[$key],
                    'gaji_bersih' => $request->gaji_bersih[$key],
                    'pembulatan' => $request->pembulatan[$key],
                    'gaji_diterima' => $request->gaji_diterima[$key],
                ]);
            }

            return redirect()->route('penggajians.index')->with('success', 'Penggajian created successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('penggajians.create')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Penggajian $penggajian)
    {
        return view('penggajians.show', compact('penggajian'));
    }

    public function edit(Penggajian $penggajian)
    {
        $absensis = Absensi::all();
        return view('penggajians.edit', compact('penggajian', 'absensis'));
    }

    public function update(Request $request, Penggajian $penggajian)
    {
        $request->validate([
            'tahun' => 'required',
            'bulan' => 'required',
            'total_gaji' => 'required',
            'gaji_kotor' => 'required',
            'bpjs_tk' => 'required',
            'bpjs_kes' => 'required',
            'gaji_bersih' => 'required',
            'pembulatan' => 'required',
            'gaji_diterima' => 'required',
        ]);

        try {
            $penggajian->update($request->all());
            return redirect()->route('penggajians.index')->with('success', 'Penggajian edited successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('penggajians.edit', compact('penggajian'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Penggajian $penggajian)
    {
        try {
            $penggajian->delete();
            return redirect()->route('penggajians.index')->with('success', 'Penggajian deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('penggajians.index')->with('error', 'Cannot delete Penggajian: ' . $e->getMessage());
        }
    }
}

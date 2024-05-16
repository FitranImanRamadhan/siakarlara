<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Gaji;
use App\Models\Absensi;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Exports\GajiExport;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{

    public function getPegawaiByBulanTahun(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $absensis = Absensi::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        return response()->json(['absensis' => $absensis]);
    }

    public function __construct()
    {
        $this->authorizeResource(Gaji::class, 'gaji');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user();
        $hak_akses = $user->hak_akses;

        $id = $user->pegawai_id;

        if($hak_akses == "Admin"){
                $gajis = Gaji::query()->with('absensi');

            if (!empty($request->search)) {
                $gajis->where('kode', 'like', '%' . $request->search . '%');
            }

            $gajis = $gajis->paginate(10);
            return view('gajis.index', compact('gajis'));
        }elseif($hak_akses == "Karyawan"){
            $gajis = Gaji::leftjoin('users','gajis.kode','=','users.pegawai_id')
            ->select('gajis.*','users.nama')
            ->where('gajis.kode',$id)
            ->get();
            return view('gajis.index', compact('gajis'));
        }
    }

    public function index2(Request $request)
    {
        $hak_akses= Auth()->user()->hak_akses;

        $pegawai_id = Auth()->user()->pegawai_id;

        $gajis = Gaji::leftjoin('users','gajis.kode','=','users.pegawai_id')
        ->select('gajis.*','users.nama')
        ->where('gajis.kode',$pegawai_id)
        ->get();
        return view('gajis.index2', compact('gajis'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('gajis.create', compact('absensis', 'tahun', 'bulan'));
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
        // Validasi data yang diterima dari form
        $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'kode.*' => 'required', // Ubah sesuai dengan aturan validasi yang Anda perlukan
            'total_gaji.*' => 'required|numeric',
            'insentif_absen.*' => 'required|numeric',
            'uang_lembur.*' => 'required|numeric',
            'gaji_kotor.*' => 'required|numeric',
            'bpjs_tk.*' => 'required|numeric',
            'bpjs_kes.*' => 'required|numeric',
            'gaji_bersih.*' => 'required|numeric',
            'gaji_diterima.*' => 'required|numeric',
        ]);

        // Loop untuk menyimpan data gaji
        foreach ($request->kode as $key => $pegawai_id) {
            Gaji::create([
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'kode' => $pegawai_id,
                'total_gaji' => $request->total_gaji[$key],
                'insentif_absen' => $request->insentif_absen[$key],
                'uang_lembur' => $request->uang_lembur[$key],
                'gaji_kotor' => $request->gaji_kotor[$key],
                'bpjs_tk' => $request->bpjs_tk[$key],
                'bpjs_kes' => $request->bpjs_kes[$key],
                'gaji_bersih' => $request->gaji_bersih[$key],
                'gaji_diterima' => $request->gaji_diterima[$key],
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('gajis.index')->with('success', 'Data gaji berhasil disimpan.');
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

        $absensis = Absensi::all();

        return view('gajis.edit', compact('gaji', 'absensis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'kode' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'total_gaji' => 'required',
            'insentif_absen' => 'required',
            'uang_lembur' => 'required',
            'gaji_kotor' => 'required',
            'bpjs_tk' => 'required',
            'bpjs_kes' => 'required',
            'gaji_bersih' => 'required',
            'gaji_diterima' => 'required'
        ]);

        try {
            $gaji->kode = $request->kode;
            $gaji->tahun = $request->tahun;
            $gaji->bulan = $request->bulan;
            $gaji->total_gaji = $request->total_gaji;
            $gaji->insentif_absen = $request->insentif_absen;
            $gaji->uang_lembur = $request->uang_lembur;
            $gaji->gaji_kotor = $request->gaji_kotor;
            $gaji->bpjs_tk = $request->bpjs_tk;
            $gaji->bpjs_kes = $request->bpjs_kes;
            $gaji->gaji_bersih = $request->gaji_bersih;
            $gaji->gaji_diterima = $request->gaji_diterima;
            $gaji->save();

            return redirect()->route('gajis.index')->with('success', __('Gaji edited successfully.'));
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

    public function getDataForTableGaji(Request $request)
    {
        $title = "Data Gaji";
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan pemfilteran data berdasarkan bulan dan tahun jika keduanya telah dipilih
        if ($bulan && $tahun) {
            $gajis = Gaji::where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->get();
        } else {
            // Jika tidak ada filter bulan dan tahun, ambil semua data pengGaji
            $gajis = Gaji::all();
        }

        return view('gajis.index', ['title' => $title, 'gajis' => $gajis]); // Kirim data yang telah difilter ke view
    }
    public function exportByMonthYearGaji(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan validasi bulan dan tahun
        $request->validate([
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:1900|max:' . (date('Y') + 1), // Mengatur batasan tahun, di sini diset hingga tahun berjalan
        ]);

        // Ambil data absensi sesuai dengan bulan dan tahun yang dipilih
        $gajis = Gaji::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
        if ($gajis->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data gaji untuk bulan dan tahun yang dipilih.');
        }

        // Buat nama file Excel
        $fileName = 'Data_gaji_' . Carbon::parse("{$tahun}-{$bulan}-01")->format('F_Y') . '.xlsx';

        // Export data ke Excel menggunakan Maatwebsite\Excel
        return Excel::download(new GajiExport($gajis), $fileName);
    }

    public function laporanGaji()
    {
        $title = "Laporan";
        $gajis = Gaji::with('absensi')->paginate(15);

        return view('gajis.laporan_gaji', ['title' => $title, 'gajis' => $gajis]);
    }
    
    public function cetakSlipGaji()
    {
        $title = "Laporan";
        $gajis = Gaji::with('absensi')->paginate(15);

        return view('gajis.cetak_slip_gaji', ['title' => $title, 'gajis' => $gajis]);
    }




    public function cetakSlipGajiPDF(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan validasi bulan dan tahun
        $request->validate([
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:1900|max:' . (date('Y') + 1), // Mengatur batasan tahun, di sini diset hingga tahun berjalan
        ]);

        // Ambil data absensi sesuai dengan bulan dan tahun yang dipilih
        $gajis = Gaji::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
        if ($gajis->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data gaji untuk bulan dan tahun yang dipilih.');
        }

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view blade slip gaji
        $pdfView = view('exports.slip_gaji', compact('gajis'))->render();

        // Load HTML content
        $dompdf->loadHtml($pdfView);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output the generated PDF to browser
        return $dompdf->stream('slip_gaji.pdf');
    }

    public function showOwnGaji()
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = auth()->user(); // Menggunakan helper auth() untuk mendapatkan pengguna yang sedang login
    
        // Mendapatkan data gaji berdasarkan pengguna yang sedang login
        $gaji = $user->gaji; // Pastikan relasi antara User dan Gaji sudah didefinisikan di model User
    
        if ($gaji) {
            // Jika data gaji ditemukan, tampilkan view dengan data gaji
            return view('gajis.gaji_saya', ['gaji' => $gaji]);
        } else {
            // Jika tidak ada data gaji ditemukan, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Data gaji tidak ditemukan.');
        }
    

}

}

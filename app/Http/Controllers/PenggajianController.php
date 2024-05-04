<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggajian;
use App\Models\Absensi;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Exports\PenggajianExport;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
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
            'uang_lembur.*' => 'required',
            'insentif_absen.*' => 'required',
            'gaji_kotor.*' => 'required',
            'bpjs_tk.*' => 'required',
            'bpjs_kes.*' => 'required',
            'gaji_bersih.*' => 'required',
            'gaji_diterima.*' => 'required',
        ]);

        try {
            foreach ($request->absensi_id as $key => $absensi_id) {
                Penggajian::create([
                    'absensi_id' => $absensi_id,
                    'tahun' => $request->tahun,
                    'bulan' => $request->bulan,
                    'total_gaji' => $request->total_gaji[$key],
                    'uang_lembur' => $request->total_gaji[$key],
                    'insentif_absen' => $request->insentif_absen[$key],
                    'gaji_kotor' => $request->gaji_kotor[$key],
                    'bpjs_tk' => $request->bpjs_tk[$key],
                    'bpjs_kes' => $request->bpjs_kes[$key],
                    'gaji_bersih' => $request->gaji_bersih[$key],
                    'gaji_diterima' => $request->gaji_diterima[$key],
                ]);
            }

            return redirect()->route('penggajians.index')->with('success', 'Penggajian created successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('penggajians.index')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
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
            'insentif_absen' => 'required',
            'uang_lembur' => 'required',
            'gaji_kotor' => 'required',
            'bpjs_tk' => 'required',
            'bpjs_kes' => 'required',
            'gaji_bersih' => 'required',
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

   

    public function getDataForTableGaji(Request $request)
    {
        $title = "Data Gaji";
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan pemfilteran data berdasarkan bulan dan tahun jika keduanya telah dipilih
        if ($bulan && $tahun) {
            $penggajians = Penggajian::where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->get();
        } else {
            // Jika tidak ada filter bulan dan tahun, ambil semua data pengPenggajian
            $penggajians = Penggajian::all();
        }

        return view('penggajians.index', ['title' => $title, 'penggajians' => $penggajians]); // Kirim data yang telah difilter ke view
    }

    public function laporanGaji()
    {
        $title = "Laporan";
        $penggajians = Penggajian::with('absensi')->paginate(15);

        return view('penggajians.laporan_penggajian', ['title' => $title, 'penggajians' => $penggajians]);
    }
    public function cetakSlipGaji()
    {
        $title = "Laporan";
        $penggajians = Penggajian::with('absensi')->paginate(15);

        return view('penggajians.cetak_slip_gaji', ['title' => $title, 'penggajians' => $penggajians]);
    }

    

    
public function cetakSlipGajiPDF(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Lakukan validasi bulan dan tahun
    $request->validate([
        'bulan' => 'required|numeric|min:1|max:12',
        'tahun' => 'required|numeric|min:1900|max:'.(date('Y')+1), // Mengatur batasan tahun, di sini diset hingga tahun berjalan
    ]);

    // Ambil data absensi sesuai dengan bulan dan tahun yang dipilih
    $penggajians = Penggajian::where('bulan', $bulan)
                        ->where('tahun', $tahun)
                        ->get();

    // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
    if ($penggajians->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data gaji untuk bulan dan tahun yang dipilih.');
    }

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Load view blade slip gaji
    $pdfView = view('exports.slip_gaji', compact('penggajians'))->render();

    // Load HTML content
    $dompdf->loadHtml($pdfView);

    // Set paper size (optional)
    $dompdf->setPaper('A4', 'landscape');

    // Render PDF
    $dompdf->render();

    // Output the generated PDF to browser
    return $dompdf->stream('slip_gaji.pdf');
}

// public function cetakSlipGajiPegawai(Request $request)
// {
//     // Ambil id pengguna yang sedang login
//     $userId = Auth::id();

//     // Ambil bulan dan tahun dari request
//     $bulan = $request->input('bulan');
//     $tahun = $request->input('tahun');

//     // Lakukan validasi bulan dan tahun
//     $request->validate([
//         'bulan' => 'required|numeric|min:1|max:12',
//         'tahun' => 'required|numeric|min:1900|max:'.(date('Y')+1),
//     ]);

//     // Ambil data penggajian sesuai dengan pengguna yang login, bulan, dan tahun yang dipilih
//     $penggajian = Penggajian::where('user_id', $userId)
//                         ->where('bulan', $bulan)
//                         ->where('tahun', $tahun)
//                         ->first();

//     // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
//     if (!$penggajian) {
//         return redirect()->back()->with('error', 'Tidak ada data gaji untuk bulan dan tahun yang dipilih.');
//     }

//     // Buat objek Dompdf
//     $dompdf = new Dompdf();

//     // Load view blade slip gaji perorangan
//     $pdfView = view('exports.slip_gaji', compact('penggajian'))->render();

//     // Load HTML content
//     $dompdf->loadHtml($pdfView);

//     // Set paper size (optional)
//     $dompdf->setPaper('A4', 'landscape');

//     // Render PDF
//     $dompdf->render();

//     // Output the generated PDF to browser
//     return $dompdf->stream('slip_gaji_' . $penggajian->nama . '.pdf'); // Memberikan nama file slip gaji berdasarkan nama pegawai
// }

    

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
        $penggajians = Penggajian::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
        if ($penggajians->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data gaji untuk bulan dan tahun yang dipilih.');
        }

        // Buat nama file Excel
        $fileName = 'Data_gaji_' . Carbon::parse("{$tahun}-{$bulan}-01")->format('F_Y') . '.xlsx';

        // Export data ke Excel menggunakan Maatwebsite\Excel
        return Excel::download(new PenggajianExport($penggajians), $fileName);
    }
}

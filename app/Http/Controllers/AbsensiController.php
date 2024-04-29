<?php

namespace App\Http\Controllers;

use App\Exports\Exportabsensi; // Perhatikan penamaan kelas
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $title = "Data absensi";
    $absensis = Absensi::with('pegawai')->paginate(15);
        return view('absensis.index', compact('absensis', 'title')); // Mengubah compact agar sesuai
    }

    public function create()
    {
        $title = "Tambah data absensi";
        $pgw = Pegawai::all();
        return view('absensis.create', compact('title','pgw')); // Mengubah compact agar sesuai
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'pegawai_id.*' => 'required|exists:pegawais,id',
            'hadir.*' => 'required|numeric',
            'izin.*' => 'required|numeric',
            'sakit.*' => 'required|numeric',
            'alpha.*' => 'required|numeric',
            'selisih.*' => 'required|numeric',
            'lembur.*' => 'required|numeric',
        ], [
            'pegawai_id.*.required' => 'Pegawai ID is required.',
            'pegawai_id.*.exists' => 'Invalid pegawai ID provided.',
            'hadir.*.required' => 'Hadir field is required.',
            'hadir.*.numeric' => 'Hadir field must be numeric.',
            'izin.*.required' => 'Izin field is required.',
            'izin.*.numeric' => 'Izin field must be numeric.',
            'sakit.*.required' => 'Sakit field is required.',
            'sakit.*.numeric' => 'Sakit field must be numeric.',
            'alpha.*.required' => 'Alpha field is required.',
            'alpha.*.numeric' => 'Alpha field must be numeric.',
            'selisih.*.required' => 'Selisih field is required.',
            'selisih.*.numeric' => 'Selisih field must be numeric.',
            'lembur.*.required' => 'Lembur field is required.',
            'lembur.*.numeric' => 'Lembur field must be numeric.',
        ]);
    
        // Mendapatkan bulan dan tahun dari input
        $bulan = $request->bulan;
        $tahun = $request->tahun;
    
        // Memeriksa apakah sudah ada entri absensi untuk bulan dan tahun yang sama
        $existingAbsensi = Absensi::where('bulan', $bulan)->where('tahun', $tahun)->exists();
    
        // Jika sudah ada, kembalikan dengan pesan error
        if ($existingAbsensi) {
            return redirect()->back()->withInput()->withErrors(['Absensi untuk bulan dan tahun yang sama sudah ada.']);
        }
    
        // Persiapan data absensi untuk disimpan
        $pegawaiIds = $request->pegawai_id;
        $hadir = $request->hadir;
        $izin = $request->izin;
        $sakit = $request->sakit;
        $alpha = $request->alpha;
        $selisih = $request->selisih;
        $lembur = $request->lembur;
    
        $attendanceData = [];
    
        // Persiapkan data absensi
        foreach ($pegawaiIds as $index => $pegawaiId) {
            $attendanceData[] = [
                'pegawai_id' => $pegawaiId,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'hadir' => $hadir[$index],
                'izin' => $izin[$index],
                'sakit' => $sakit[$index],
                'alpha' => $alpha[$index],
                'selisih' => $selisih[$index],
                'lembur' => $lembur[$index],
                // Anda dapat menambahkan lebih banyak kolom di sini jika diperlukan
            ];
        }
    
        // Simpan data absensi
        Absensi::insert($attendanceData);
    
        // Redirect dengan pesan sukses
        return redirect()->route('absensis.index')->with('success', 'Absen berhasil ditambahkan.');
    }
    





    public function show(Absensi $absensi)    
    {
        return view('absensis.show', compact('absensi')); // Mengubah compact agar sesuai
    }

    
    
    public function edit(Absensi $absensi)
    {
        $title = "Edit Data absensi";
        $pgw = Pegawai::all();
        return view('absensis.edit', compact('absensi', 'title','pgw'));
    }

    public function update(Request $request, Absensi $absensi)
{
    // Validasi input
    $request->validate([
        'hadir' => 'required|numeric',
        'izin' => 'required|numeric',
        'sakit' => 'required|numeric',
        'alpha' => 'required|numeric',
        'selisih' => 'required|numeric',
        'lembur' => 'required|numeric',
    ], [
        'hadir.required' => 'Hadir field is required.',
        'hadir.numeric' => 'Hadir field must be numeric.',
        'izin.required' => 'Izin field is required.',
        'izin.numeric' => 'Izin field must be numeric.',
        'sakit.required' => 'Sakit field is required.',
        'sakit.numeric' => 'Sakit field must be numeric.',
        'alpha.required' => 'Alpha field is required.',
        'alpha.numeric' => 'Alpha field must be numeric.',
        'selisih.required' => 'Selisih field is required.',
        'selisih.numeric' => 'Selisih field must be numeric.',
        'lembur.required' => 'Lembur field is required.',
        'lembur.numeric' => 'Lembur field must be numeric.',
    ]);

    // Isi model Absensi dengan data dari request dan simpan perubahan
    $absensi->hadir = $request->hadir;
    $absensi->izin = $request->izin;
    $absensi->sakit = $request->sakit;
    $absensi->alpha = $request->alpha;
    $absensi->selisih = $request->selisih;
    $absensi->lembur = $request->lembur;
    $absensi->save();

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('absensis.index')->with('success', 'Data absensi berhasil diperbarui.');
}



    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensis.index')->with('success', 'potongan has been deleted successfully'); // Mengubah pesan success agar sesuai
    }



    public function getDataForTable(Request $request)
    {
        $title = "Data absensi";
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan pemfilteran data berdasarkan bulan dan tahun jika keduanya telah dipilih
        if ($bulan && $tahun) {
            $absensis = Absensi::where('bulan', $bulan)
                                ->where('tahun', $tahun)
                                ->get();
        } else {
            // Jika tidak ada filter bulan dan tahun, ambil semua data absensi
            $absensis = Absensi::all();
        }

        return view('absensis.index', ['title' => $title, 'absensis' => $absensis]); // Kirim data yang telah difilter ke view
    }


    public function getDataAll()
    {
        $title = "Data absensi";
        $absensis = Absensi::all();
        
        return view('absensis.index', ['title' => $title, 'absensis' => $absensis]);
    }


public function laporan()
    {
        $title = "Laporan";
        $absensis = Absensi::with('pegawai')->paginate(15);
    
        return view('absensis.laporan_absensi', ['title' => $title, 'absensis' => $absensis]);
    }
   
    public function exportByMonthYear(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Lakukan validasi bulan dan tahun
        $request->validate([
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:1900|max:'.(date('Y')+1), // Mengatur batasan tahun, di sini diset hingga tahun berjalan
        ]);

        // Ambil data absensi sesuai dengan bulan dan tahun yang dipilih
        $absensis = Absensi::where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->get();

        // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan
        if ($absensis->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data absensi untuk bulan dan tahun yang dipilih.');
        }

        // Buat nama file Excel
        $fileName = 'Data_Absensi_' . Carbon::parse("{$tahun}-{$bulan}-01")->format('F_Y') . '.xlsx';

        // Export data ke Excel menggunakan Maatwebsite\Excel
        return Excel::download(new AbsensiExport($absensis), $fileName);
    }
    public function getByMonth(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $absensis = Absensi::where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->get();

        return response()->json($absensis);
    }
    
}

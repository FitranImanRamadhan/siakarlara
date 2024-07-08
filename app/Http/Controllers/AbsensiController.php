<?php

namespace App\Http\Controllers;

use App\Exports\DetailAbsenExport;
use App\Exports\ExportAbsensis;
use App\Exports\RekapAbsensiExport;
use App\Imports\AbsensisImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Position;
use App\Models\Toko;
use DateTime;
use Exception;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AbsensiController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Absensi::class, 'absensi');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $absensis = Absensi::all();

        return view('absensis.index', compact('absensis'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tokos = Toko::all();
        $pegawais = Pegawai::all();
        return view('absensis.create', compact('tokos', 'pegawais'));
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

        try {

            $absensi = new Absensi();
            $absensi->urut = $request->urut;
            $absensi->id = $request->id;
            $absensi->tanggal = $request->tanggal;
            $absensi->jam = $request->jam;
            $absensi->kode1 = $request->kode1;
            $absensi->kode2 = $request->kode2;
            $absensi->kode3 = $request->kode3;
            $absensi->keterangan = $request->keterangan;
            $absensi->save();

            return redirect()->route('absensis.index')->with('success', __('Absensi created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('absensis.create')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Absensi $absensi
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        $absensi = Absensi::leftJoin('pegawais', 'absensis.id', '=', 'pegawais.id')
            ->select('absensis.*', 'pegawais.nama as pegawai_nama')
            ->where('absensis.id', $absensi->id)
            ->firstOrFail();

        return view('absensis.show', compact('absensi'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Absensi $absensi
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {

        return view('absensis.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {

        try {
            $absensi->urut = $request->urut;
            $absensi->id = $request->id;
            $absensi->tanggal = $request->tanggal;
            $absensi->jam = $request->jam;
            $absensi->kode1 = $request->kode1;
            $absensi->kode2 = $request->kode2;
            $absensi->kode3 = $request->kode3;
            $absensi->keterangan = $request->keterangan;
            $absensi->save();

            return redirect()->route('absensis.index')->with('success', __('Absensi edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('absensis.edit', compact('absensi'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Absensi $absensi
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {

        try {
            $absensi->delete();

            return redirect()->route('absensis.index')->with('success', __('Absensi deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('absensis.index')->with('error', 'Cannot delete Absensi: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new ExportAbsensis, 'absensi.xlsx');
    }




    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new AbsensisImport, $request->file('file'));

            return redirect()->route('absensis.index')->with('success', 'Data Absensi berhasil diimpor.');
        } catch (\Throwable $e) {
            return redirect()->route('absensis.index')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }


    private function determineShift($cek_in, $cek_out)
    {
        if (is_null($cek_in) || is_null($cek_out) || $cek_in == $cek_out) {
            return "Tidak Ada IN/Out";
        }

        try {
            $jam_cekin = new DateTime($cek_in);
            $jam_cekout = new DateTime($cek_out);
        } catch (Exception $e) {
            return "Format waktu tidak valid";
        }

        $selisih = $jam_cekin->diff($jam_cekout);
        $jam_kerja = $selisih->h + ($selisih->i / 60);

        $cek_in = $jam_cekin->format('H:i');
        $cek_out = $jam_cekout->format('H:i');

        if (($cek_in >= '05:00' && $cek_in <= '07:00') && ($cek_out >= '15:30' && $cek_out <= '20:50')) {
            return "Pagi";
        }
        if (($cek_in >= '07:00' && $cek_in <= '08:30') && ($cek_out >= '16:00' && $cek_out <= '22:50')) {
            return "Office";
        }
        if (($cek_in >= '11:20' && $cek_in <= '13:40') && ($cek_out >= '22:00' && $cek_out <= '23:50')) {
            return "Siang";
        }
        if (($cek_in >= '05:00' && $cek_in <= '07:50') && ($cek_out >= '22:00' && $cek_out <= '23:50')) {
            return "Full";
        }
        if (($cek_in >= '08:50' && $cek_in <= '09:50') && ($cek_out >= '18:00' && $cek_out <= '23:50')) {
            return "Middle";
        }
        if ($jam_kerja >= 1 && $jam_kerja <= 8) {
            return "Setengah Hari";
        }

        return "";
    }

    // Function to determine shift status based on check in and check out times
    private function determinesShift($cek_in, $cek_out)
    {
        if (($cek_in >= '07:00' && $cek_in <= '08:30')) {
            $status = ($cek_in > '07:55:59') ? "Terlambat" : "";
            $status .= ($cek_out < '16:00') ? (($status ? ", " : "") . "Pulang Cepat") : "";
            return "" . ($status ? " ($status)" : "");
        }
        if (($cek_in >= '05:00' && $cek_in <= '07:00') && ($cek_out >= '15:30')) {
            $status = ($cek_in > '06:15:59') ? "Terlambat" : "";
            $status .= ($cek_out < '15:30') ? (($status ? ", " : "") . "Pulang Cepat") : "";
            return "" . ($status ? " ($status)" : "");
        }
        if (($cek_in >= '11:50' && $cek_in <= '14:40') && ($cek_out >= '21:00')) {
            $status = ($cek_in > '13:15:59') ? "Terlambat" : "";
            $status .= ($cek_out < '22:00') ? (($status ? ", " : "") . "Pulang Cepat") : "";
            return "" . ($status ? " ($status)" : "");
        }
        if (($cek_in >= '08:30' && $cek_in <= '09:50') && ($cek_out >= '18:00')) {
            $status = ($cek_in > '09:15:59') ? "Terlambat" : "";
            $status .= ($cek_out < '18:00') ? (($status ? ", " : "") . "Pulang Cepat") : "";
            return "" . ($status ? " ($status)" : "");
        }
        return "";
    }





    public function detailabsen(Request $request)
    {
        $absensis = Absensi::join('pegawais', 'absensis.id', '=', 'pegawais.id')
            ->join('tokos', 'pegawais.toko', '=', 'tokos.toko')
            ->select('pegawais.*', 'absensis.*');

        // Memproses filter jika ada rentang tanggal yang dipilih
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            // Filter data berdasarkan rentang tanggal
            $absensis->whereBetween('tanggal', [$start_date, $end_date]);
        }

        // Filter berdasarkan toko yang dipilih
        if ($request->has('toko')) {
            $toko = $request->toko;
            $absensis->where('tokos.toko', $toko);
        }

        $absensis = $absensis->get();

        // Group data based on employee ID and date
        $groupedAbsensis = $absensis->groupBy('id')->map(function ($absensiPegawai) {
            return $absensiPegawai->groupBy('tanggal')->map(function ($absensiTanggal) {
                $jamMasuk = null;
                $jamKeluar = null;
                $keterangan = null;

                foreach ($absensiTanggal as $absensi) {
                    if (($absensi->kode1 == 0 && $absensi->kode2 == 1) || ($absensi->kode1 == 1 && $absensi->kode2 == 0)) {
                        if (is_null($jamMasuk) || $absensi->jam < $jamMasuk) {
                            $jamMasuk = $absensi->jam;
                        }
                    } elseif ($absensi->kode1 == 1 && $absensi->kode2 == 1) {
                        if (is_null($jamKeluar) || $absensi->jam > $jamKeluar) {
                            $jamKeluar = $absensi->jam;
                        }
                    }
                    // Set keterangan value
                    if (is_null($keterangan) && !is_null($absensi->keterangan)) {
                        $keterangan = $absensi->keterangan;
                    }
                }

                // Determine shift and shift status
                $shift = $this->determineShift($jamMasuk, $jamKeluar); // Memanggil fungsi dari controller
                $statusShift = $this->determinesShift($jamMasuk, $jamKeluar); // Memanggil fungsi dari controller

                $jamKerja = null;
                if (!is_null($jamMasuk) && !is_null($jamKeluar)) {
                    $jamMasukObj = new DateTime($jamMasuk);
                    $jamKeluarObj = new DateTime($jamKeluar);
                    $diff = $jamMasukObj->diff($jamKeluarObj);

                    // Calculate total working hours
                    $jamKerja = $diff->h + ($diff->i / 60);

                    // Round minutes
                    $menit = round($diff->i);
                    if ($menit == 60) {
                        $jamKerja += 1;
                        $menit = 0;
                    }

                    // Format hours and minutes to add zero if only one digit
                    $jam = str_pad($diff->h, 2, "0", STR_PAD_LEFT);
                    $menit = str_pad($menit, 2, "0", STR_PAD_LEFT);
                    $jamKerja = "$jam:$menit";
                } else {
                    $jamKerja = "00:00"; // Default if there is no check in and check out data
                }

                return [
                    'tanggal' => $absensiTanggal->first()->tanggal,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'shift' => $shift,
                    'status_shift' => $statusShift,
                    'jam_kerja' => $jamKerja,
                    'nama' => $absensiTanggal->first()->nama,
                    'toko' => $absensiTanggal->first()->toko,
                    'keterangan' => $keterangan,
                ];
            });
        });

        $tokos = Toko::all(); // Get all stores data for dropdown

        $start_date = $request->start_date ?? date('Y-m-01');
        $end_date = $request->end_date ?? date('Y-m-t');

        if ($request->has('export') && $request->export == 'excel') {
            return Excel::download(new DetailAbsenExport($groupedAbsensis), 'detail_absen.xlsx');
        }

        return view('absensis.detailabsen', compact('groupedAbsensis', 'tokos', 'start_date', 'end_date'));
    }



    public function rekapabsen(Request $request)
    {
        $tokos = Toko::all(); // Get all stores data for dropdown
    
        $absensis = Absensi::join('pegawais', 'absensis.id', '=', 'pegawais.id')
            ->join('tokos', 'pegawais.toko', '=', 'tokos.toko')
            ->select('pegawais.*', 'absensis.*');
    
        $start_date = null;
        $end_date = null;
    
        // Process filters if date range is selected
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
    
            // Filter data based on date range
            $absensis->whereBetween('tanggal', [$start_date, $end_date]);
        }
    
        // Filter by selected store
        if ($request->has('toko')) {
            $toko = $request->toko;
            $absensis->where('tokos.toko', $toko);
        }
    
        $absensis = $absensis->get();
    
        // Initialize groupedAbsensis array
        $groupedAbsensis = [];
    
        // Process each employee's attendance records
        foreach ($absensis->groupBy('id') as $pegawaiId => $absensiPegawai) {
            $rekap = [
                'nama' => $absensiPegawai->first()->nama,
                'toko' => $absensiPegawai->first()->toko,
                'jumlah_masuk' => 0,
                'jumlah_terlambat' => 0,
                'jumlah_pulang_cepat' => 0,
                'jumlah_tidak_ada_in_out' => 0,
                'jumlah_full' => 0,
                'jumlah_off' => 0,
                'jumlah_setengah_hari' => 0,
                'total_jam_kerja' => 0,
                'jumlah_sakit' => 0, // Initialize jumlah sakit
                'jumlah_cuti' => 0, // Initialize jumlah cuti
                'jumlah_ijin' => 0, // Initialize jumlah ijin
                'jumlah_alpha' => 0, // Initialize jumlah alpha
            ];
    
            foreach ($absensiPegawai->groupBy('tanggal') as $tanggal => $absensiTanggal) {
                $jamMasuk = null;
                $jamKeluar = null;
                $keterangan = null;
    
                foreach ($absensiTanggal as $absensi) {
                    if (($absensi->kode1 == 0 && $absensi->kode2 == 1) || ($absensi->kode1 == 1 && $absensi->kode2 == 0)) {
                        // IN: either kode1 is 0 or kode2 is 1
                        if (is_null($jamMasuk) || $absensi->jam < $jamMasuk) {
                            $jamMasuk = $absensi->jam;
                        }
                    } elseif ($absensi->kode1 == 1 && $absensi->kode2 == 1) {
                        // OUT: kode1 is 1 and kode2 is 1
                        if (is_null($jamKeluar) || $absensi->jam > $jamKeluar) {
                            $jamKeluar = $absensi->jam;
                        }
                    }
    
                    // Set keterangan value
                    if (is_null($keterangan) && !is_null($absensi->keterangan)) {
                        $keterangan = $absensi->keterangan;
                    }
                }
    
                // Determine shift status
                $shiftStatus = $this->determineShift($jamMasuk, $jamKeluar);
    
                // Count "Tidak Ada IN/Out"
                if (is_null($jamMasuk) || is_null($jamKeluar)) {
                    $rekap['jumlah_tidak_ada_in_out']++;
                }
    
                // Count jumlah masuk kerja based on available data
                if (($jamMasuk && $jamKeluar) || (is_null($jamMasuk) || is_null($jamKeluar))) {
                    $rekap['jumlah_masuk']++;
                }
    
                // Count jumlah terlambat and pulang cepat based on shift status
                if (strpos($shiftStatus, 'Terlambat') !== false) {
                    $rekap['jumlah_terlambat']++;
                }
                if (strpos($shiftStatus, 'Pulang Cepat') !== false) {
                    $rekap['jumlah_pulang_cepat']++;
                }
    
                // Count jumlah full days based on shift status
                if (strpos($shiftStatus, 'Full') !== false) {
                    $rekap['jumlah_full']++;
                }
    
                // Count jumlah setengah hari based on shift status
                if ($shiftStatus === 'Setengah Hari') {
                    $rekap['jumlah_setengah_hari']++;
                }
    
                // Calculate total jam kerja based on shift status
                if (!in_array($shiftStatus, ['Tidak Ada IN/Out', 'Format waktu tidak valid', ''])) {
                    try {
                        if ($jamMasuk && $jamKeluar) {
                            $jam_cekin = new DateTime($jamMasuk);
                            $jam_cekout = new DateTime($jamKeluar);
                            $selisih = $jam_cekin->diff($jam_cekout);
                            $jam_kerja = $selisih->h + ($selisih->i / 60);
                            $rekap['total_jam_kerja'] += intval($jam_kerja); // Convert to integer
                        }
                    } catch (Exception $e) {
                        // Handle exception if any
                    }
                }
    
                // Count jumlah sakit, cuti, ijin, alpha based on keterangan
                if (!empty($keterangan)) {
                    if (stripos($keterangan, 'sakit') !== false) {
                        $rekap['jumlah_sakit']++;
                    }
                    if (stripos($keterangan, 'cuti') !== false) {
                        $rekap['jumlah_cuti']++;
                    }
                    if (stripos($keterangan, 'ijin') !== false) {
                        $rekap['jumlah_ijin']++;
                    }
                    if (stripos($keterangan, 'alpha') !== false) {
                        $rekap['jumlah_alpha']++;
                    }
                }
            }
    
            // Hitung jumlah off days
            $jumlahHariAbsensi = count($absensiPegawai->groupBy('tanggal'));
            if ($start_date && $end_date) {
                $jumlahHariKerja = count(CarbonPeriod::create($start_date, $end_date)->toArray());
                $rekap['jumlah_off'] = $jumlahHariKerja - $jumlahHariAbsensi;
            }
    
            $groupedAbsensis[$pegawaiId] = $rekap;
        }
    
        if ($request->has('export') && $request->export == 'excel') {
            return Excel::download(new RekapAbsensiExport($groupedAbsensis, $start_date, $end_date, $request->toko), 'rekap_absensi.xlsx');
        }
    
        return view('absensis.rekapabsen', compact('groupedAbsensis', 'tokos', 'start_date', 'end_date'));
    }
    







    // Function to determine shift based on check in and check out times


}

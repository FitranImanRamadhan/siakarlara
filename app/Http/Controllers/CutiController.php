<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Cuti;
use GuzzleHttp\Client;

class CutiController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Cuti::class, 'cuti');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve pending requests
        $cutis = Cuti::where('status', 'Pending')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('date_cuti', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        // Retrieve processed requests
        $processedCutis = Cuti::where('status', '!=', 'Pending')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('date_cuti', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('cutis.index', compact('cutis', 'processedCutis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cutis.create', []);
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
        // Validasi data yang masuk
        $request->validate([
            'id' => 'nullable|integer', // Tidak perlu unique
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
            'urut' => 'unique:cutis,urut' // Validasi unique untuk 'urut'
        ]);

        try {
            // Menyimpan data ke dalam database
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
            $cuti->status = $request->status ?? 'Pending';
            $cuti->kode = $request->kode;
            $cuti->date_acc = $request->date_acc;
            $cuti->urut = $request->urut; // Menyimpan nilai urut
            $cuti->save();

            // Kirim notifikasi ke Telegram
            $client = new Client();
            $token = '7260078077:AAFCgbDBM-IGvD4ysQQLVeIHrItSEShM05E'; // Token bot Anda
            $chat_id = '7429020681'; // Chat ID Anda

            $message = "Pengajuan Cuti Dari Tanggal " . $request->date_cuti . " Sampai Tanggal " . $request->end_cuti . ":\n";
            $message .= "Toko: " . $request->toko . "\n";
            $message .= "Nama: " . $request->nama . "\n";
            $message .= "Jenis Cuti: " . $request->jenis_cuti . "\n";
            $message .= "Ambil Tugas Oleh: " . $request->ambil_tugas . "\n";

            $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'form_params' => [
                    'chat_id' => $chat_id,
                    'text' => $message,
                ],
            ]);

            return redirect()->route('cutis.index')->with('success', __('Cuti created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.create')->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti,)
    {

        return view('cutis.show', compact('cuti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        // Menampilkan form edit dengan data cuti yang ada
        return view('cutis.edit', compact('cuti'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        // Validasi data yang masuk
        $request->validate([
            'id' => 'nullable|integer',
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
            'urut' => "unique:cutis,urut,{$cuti->urut}", // Validasi dengan pengecualian untuk record yang sedang di-update
        ]);

        try {
            // Update data pada record yang ditemukan
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

            return redirect()->route('cutis.index')->with('success', __('Cuti updated successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.edit', $cuti->urut)->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cuti $cuti
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti,)
    {

        try {
            $cuti->delete();

            return redirect()->route('cutis.index', [])->with('success', __('Cuti deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('cutis.index', [])->with('error', 'Cannot delete Cuti: ' . $e->getMessage());
        }
    }


    public function updateStatus(Request $request, Cuti $cuti)
    {
        $cuti->status = $request->status;
        $cuti->save();

        return redirect()->route('cutis.index')->with('success', 'Status cuti berhasil diperbarui.');
    }


    public function printSurat($id)
    {
        $cuti = Cuti::findOrFail($id);

        $pdf = PDF::loadView('print.surat', compact('cuti'));

        return $pdf->download('surat_cuti_' . $cuti->id . '.pdf');
    }
}

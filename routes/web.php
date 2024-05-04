<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\UserController; //mendaftarkan controler yang akan digunakan
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UmrController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenggajianController;
use App\Models\Absensi;
use App\Models\Departements;
use App\Models\Penggajian;
use App\Models\Potongan;
use App\Models\Umr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke route login
})->name('welcome')->middleware('guest');


Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return view('home', ['title' => 'Home']);
    })->name('home');
    Route::get('password', [UserController::class, 'password'])->name('password');
    Route::post('password', [UserController::class, 'password_action'])->name('password.action');
    Route::get('change-password', [UserController::class, 'password'])->name('change.password');
    

    Route::resource('positions', PositionController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('users', UserController::class);
    Route::resource('absensis', AbsensiController::class);
    Route::resource('jadwals', JadwalController::class);
    Route::resource('umrs', UmrController::class);
    Route::resource('potongans', PotonganController::class);
    Route::resource('pegawais', PegawaiController::class);
    Route::resource('gajis', GajiController::class);
    Route::resource('penggajians', PenggajianController::class);



    Route::get('departement/export-pdf', [DepartementController::class, 'exportPdf'])->name('departements.exportPdf');
    Route::get('user/export-pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');
    Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('position.exportExcel');
    Route::get('departement/export-excel', [DepartementController::class, 'exportExcel'])->name('departement.exportExcel');
    
    
    // New profile route
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/users/create', [UserController::class, 'create'])->name('users.create');


    //absensi
Route::get('laporan_absensi', [AbsensiController::class, 'laporan'])->name('laporan-absensi');
Route::get('/getDataForTable', [AbsensiController::class, 'getDataForTable'])->name('getDataForTable');
Route::get('/get-data-all', [AbsensiController::class, 'getDataAll'])->name('get.data.all');
Route::get('/export-by-month-year', [AbsensiController::class, 'exportByMonthYear'])->name('export.by.month.year');
Route::get('/get-absensi-data', [GajiController::class, 'getAbsensiData'])->name('get_absensi_data');

Route::get('/getDataForTableGaji', [PenggajianController::class, 'getDataForTableGaji'])->name('getDataForTableGaji');
Route::get('/export-by-month-year.gaji', [PenggajianController::class, 'exportByMonthYearGaji'])->name('export.by.month.year.gaji');
Route::get('/cetak-slip-gaji-pdf', [PenggajianController::class, 'cetakSlipGajiPDF'])->name('cetak.slip.gaji.pdf');
Route::get('laporan_penggajian', [PenggajianController::class, 'laporanGaji'])->name('laporan-penggajian');
Route::get('/cetak-slip-gaji', [PenggajianController::class, 'cetakSlipGaji'])->name('cetak_slip_gaji');


});



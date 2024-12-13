<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserController; // Mendaftarkan controller yang akan digunakan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UmrController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\TokoController;

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

// Route pertama: Menampilkan halaman welcome
Route::get('/', [PromoController::class, 'welcome'])->name('welcome');

// Route untuk halaman lainnya
Route::get('lokers/index2', [LokerController::class, 'index2'])->name('lokers.index2');
Route::get('/abouts', [HomeController::class, 'about'])->name('about');
Route::get('/kontas', [HomeController::class, 'kontak'])->name('kontak');

// Route Promo
Route::get('/reguler', [PromoController::class, 'reguler'])->name('reguler');
Route::get('/mailer', [PromoController::class, 'mailer'])->name('mailer');
Route::get('/dahsyat', [PromoController::class, 'dahsyat'])->name('dahsyat');
Route::get('/cap', [PromoController::class, 'cap'])->name('cap');

// Route Auth
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// Route Middleware Auth
Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('password', [UserController::class, 'password'])->name('password');
    Route::post('password', [UserController::class, 'password_action'])->name('password.action');
    Route::get('change-password', [UserController::class, 'password'])->name('change.password');

    // Route Resource
    Route::resource('lokers', LokerController::class);
    Route::resource('promos', PromoController::class);
    Route::resource('galeris', GaleriController::class);
    Route::get('createloker', [GaleriController::class, 'createloker'])->name('galeris.createloker');
    Route::post('/galeris/loker', [GaleriController::class, 'storeloker'])->name('galeris.storeloker');
    Route::resource('positions', PositionController::class);
    Route::resource('users', UserController::class);
    Route::resource('jadwals', JadwalController::class);
    Route::resource('pegawais', PegawaiController::class);
    Route::post('/pegawais/import', [PegawaiController::class, 'importExcel'])->name('pegawais.import');
    Route::get('/export-pegawais', [PegawaiController::class, 'export'])->name('export.pegawais');
    Route::resource('absensis', AbsensiController::class);
    Route::get('/export-absensis', [AbsensiController::class, 'export'])->name('export.absensis');
    Route::post('/absensis/import', [AbsensiController::class, 'import'])->name('absensis.import');
    Route::get('/absensi/detail', [AbsensiController::class, 'detailabsen'])->name('absensi.detail');
    Route::get('/detailabsen', [AbsensiController::class, 'detailabsen'])->name('detailabsen');
    Route::get('/rekapabsen', [AbsensiController::class, 'rekapabsen'])->name('rekapabsen');
    Route::get('/absensis/filter', [AbsensiController::class, 'filter'])->name('absensis.filter');
    Route::get('/detailabsen/detailexport', [AbsensiController::class, 'detailexport'])->name('detailabsen.detailexport');
    Route::resource('tokos', TokoController::class);
    Route::resource('cutis', CutiController::class);
    Route::patch('/cutis/{cuti}/status', [CutiController::class, 'updateStatus'])->name('cutis.updateStatus');
    Route::get('/print-surat/{id}', [CutiController::class, 'printSurat'])->name('print.surat');
    Route::get('user/export-pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');
    Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('position.exportExcel');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
});

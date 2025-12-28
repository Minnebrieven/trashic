<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\DetailSetoranController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LogTransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\ScoreboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard',[DashboardController::class,'index'])->middleware('peran:admin-manager-staff')->name('dashboard');

Route::get('/table', function () {
    return view('private.table');
})->middleware('auth');

Route::resource('/user',UserController::class)->middleware('peran:admin');

Route::get('/access-denied', function () {
    return view('private.access_denied');
})->middleware('auth');

Route::get('/generate-pdf', [TransaksiController::class, 'generatePDF']);
Route::get('/transaksi-pdf', [TransaksiController::class, 'transaksiPDF']);

Route::get('/generate-pdf', [BeritaController::class, 'generatePDF']);
Route::get('/berita-pdf', [BeritaController::class, 'beritaPDF']);


Route::resource('/berita', BeritaController::class)->middleware('peran:admin-manager-staff');
Route::resource('/sampah', SampahController::class)->middleware('peran:admin-manager-staff');
Route::resource('/jenissampah', JenisSampahController::class)->middleware('peran:admin-manager-staff');
Route::resource('/kategorisampah', KategoriSampahController::class)->middleware('peran:admin-manager-staff');
Route::resource('/kategoriberita', KategoriBeritaController::class)->middleware('peran:admin-manager-staff');
Route::resource('/transaksi', TransaksiController::class)->middleware('peran:admin-manager-staff');
Route::post('/transaksi/konfirmasi/{id}', [TransaksiController::class, 'konfirmasi_transaksi'])->middleware('peran:admin-manager-staff')->name('transaksi.konfirmasi');
Route::get('/transaksi/setoran/create', [SetoranController::class, 'create_setor_oleh_admin'])->middleware('peran:admin-manager-staff')->name('transaksi.setoran.create');
Route::post('/transaksi/setoran/store', [SetoranController::class, 'store_setor_oleh_admin'])->middleware('peran:admin-manager-staff')->name('transaksi.setoran.store');
Route::get('/transaksi/penarikan/create', [PenarikanController::class, 'create_tarik_oleh_admin'])->middleware('peran:admin-manager-staff')->name('transaksi.penarikan.create');
Route::post('/transaksi/penarikan/store', [PenarikanController::class, 'store_tarik_oleh_admin'])->middleware('peran:admin-manager-staff')->name('transaksi.penarikan.store');
Route::resource('/detail_setoran', DetailSetoranController::class)->middleware('peran:admin-manager-staff');
Route::resource('/metode_pembayaran', MetodePembayaranController::class)->middleware('peran:admin-manager-staff');
Route::resource('/hadiah', HadiahController::class)->middleware('peran:admin-manager-staff');
Route::resource('/penukaran', PenukaranController::class)->middleware('peran:admin-manager-staff');

Route::get('/setoran/create', [SetoranController::class, 'create'])->middleware('auth')->name('setoran.create');
Route::post('/setoran/store', [SetoranController::class, 'store'])->middleware('auth')->name('setoran.store');

Route::get('/penarikan/create', [PenarikanController::class, 'create'])->middleware('auth')->name('penarikan.create');
Route::post('/penarikan/store', [PenarikanController::class, 'store'])->middleware('auth')->name('penarikan.store');

Route::get('/transaksiku', [LogTransaksiController::class, 'index'])->middleware('auth')->name('transaksiku');
Route::post('/transaksiku/store', [LogTransaksiController::class, 'store'])->middleware('auth')->name('transaksiku.store');
Route::get('/transaksiku/setoran/{id}', [LogTransaksiController::class, 'show_setoran'])->middleware('auth')->name('transaksiku.show.setoran');
Route::get('/transaksiku/penarikan/{id}', [LogTransaksiController::class, 'show_penarikan'])->middleware('auth')->name('transaksiku.show.penarikan');

Route::get('/news', [BeritaController::class, 'news'])->name('berita.list');
Route::get('/news/{id}', [BeritaController::class, 'showNews'])->name('berita.detail');

Route::resource('quiz', QuizController::class);
Route::get('quiz/{quiz}/pertanyaan/create', [PertanyaanController::class, 'create'])->name('pertanyaan.create');
Route::post('quiz/{quiz}/pertanyaan', [PertanyaanController::class, 'store'])->name('pertanyaan.store');

// Route Hadiah & Penarikan
Route::get('/list-hadiah', [HadiahController::class, 'halamanListHadiah'])->name('hadiah.list')->middleware('auth');
Route::get('/penukaran/log/{id}', [PenukaranController::class, 'log_penukaran'])->name('penukaran.log')->middleware('auth');
Route::get('/penukaran/detail/{id}', [PenukaranController::class, 'detail_penukaran'])->name('penukaran.detail')->middleware('auth');
Route::post('/penukaran/tukar/{id}', [PenukaranController::class, 'tukar_hadiah'])->name('penukaran.tukar_hadiah')->middleware('auth');
// admin
Route::post('/penukaran/konfirmasi/{id}', [PenukaranController::class, 'konfirmasi_penukaran'])->middleware('peran:admin-manager-staff')->name('penukaran.konfirmasi');
//scoreboard
Route::get('/scoreboard', [ScoreboardController::class, 'index'])->name('scoreboard.index');
Route::get('/harga', [SampahController::class, 'daftar_harga_sampah'])->name('daftar_harga_sampah.index');

Route::get('', function () {
    return view('public.home');
});


 Route::get('/', function () {
     return view('public.home');
 });

Route::get('/home', function () {
    return view('public.home');
});

Route::get('/menu', function () {
    return view('public.menu');
});

Route::get('/organik', function () {
    return view('public.organik');
});

Route::get('/nonorganik', function () {
    return view('public.nonorganik');
});

Route::get('/services', function () {
    return view('public.services');
});

Route::get('/after-register', function () {
    return view('public.after_register');
});

Route::get('/Tim', function () {
    return view('public.Tim');
});

Route::get('/contact', function () {
    return view('public.contact');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//-----Rest API----
Route::get('/api-users', [UserController::class, 'apiUsers']);
Route::get('/api-user/{id}', [UserController::class, 'apiUserDetail']);
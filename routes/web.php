<?php
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ParameterBiayarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\TingkatController;
use App\Http\Controllers\UserLevelController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::prefix('api/v1')->group(function () {
        Route::get('apprep/{id}', [PpdbController::class, 'Report'])->name('apprep');

        Route::post('login', [Logincontroller::class, 'authenticate'])->name('login');
        Route::post('getuser', [Logincontroller::class, 'get_user'])->name('getuser');
        Route::get('penghargaan', [HomeController::class, 'penghargaan'])->name('penghargaan');
        Route::post('artikel', [HomeController::class, 'filterPosts'])->name('artikel');
        Route::post('listpromo', [HomeController::class, 'filterPromo'])->name('listpromo');
        Route::get('artikelBycategory', [HomeController::class, 'filterPostsBycat'])->name('artikelBycategory');
        Route::get('galery', [HomeController::class, 'filterGalery'])->name('galery');
        Route::get('event', [HomeController::class, 'filterEvent'])->name('event');
        Route::get('search', [HomeController::class, 'searchPost'])->name('search');
        Route::get('newgalery', [HomeController::class, 'filterNewGalery'])->name('newgalery');
        Route::get('randomPromo', [HomeController::class, 'randomPromo'])->name('randomPromo');
        Route::get('detailpromo/{id}', [HomeController::class, 'promoshow'])->name('detailpromo');
        Route::get('jadwalEdukasi', [HomeController::class, 'jadwalEdukasi'])->name('jadwalEdukasi');
        Route::get('currency', [HomeController::class, 'currency'])->name('currency');
        Route::post('loginppdb', [PpdbController::class, 'login'])->name('login');
        Route::post('verify', [PpdbController::class, 'getDataFromToken'])->name('login');

        Route::post('artikel', [HomeController::class, 'filterPosts'])->name('artikel');

        Route::get('ppdb_nomor', [PpdbController::class, 'generateUniquePpdbNumber'])->name('ppdb_nomor');
        Route::post('ppdb', [PpdbController::class, 'create'])->name('ppdb');

        // paramter boaya dan lain lain
        Route::post('parameter', [HomeController::class, 'parameterbiaya'])->name('parameterbiaya');
        Route::group(['middleware' => ['cors', 'ppdb.auth']], function () {
            Route::post('detailppdb/{id}', [PpdbController::class, 'show'])->name('ppdb');

            // get detail
            Route::post('uploadfile', [PpdbController::class, 'uploadFile'])->name('uploadfile');
            Route::post('cekkelulusan/{id}', [PpdbController::class, 'cekkelulusan'])->name('cekkelulusan');

        });
    });
});

Route::group(['middleware' => ['jwt.verify', 'cors']], function () {
    Route::prefix('api/v1')->group(function () {
        Route::prefix('artikel')->group(function () {
            Route::post('list', [PostController::class, 'index'])->name('list');
            Route::get('edit/{id}', [PostController::class, 'edit'])->name('list');
            Route::post('insert', [PostController::class, 'store'])->name('insert');
            Route::post('update/{id}', [PostController::class, 'update'])->name('update');
            Route::post('active', [PostController::class, 'actived'])->name('active');
            Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('statistik')->group(function () {
            Route::get('list', [StatistikController::class, 'index'])->name('list');
            Route::post('insert', [StatistikController::class, 'store'])->name('insert');
            Route::get('detail/{id}', [StatistikController::class, 'edit'])->name('detail');
            Route::post('update/{id}', [StatistikController::class, 'update'])->name('update');
            Route::delete('destroy', [StatistikController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('halaman')->group(function () {
            Route::get('list', [PagesController::class, 'index'])->name('list');
            Route::post('insert', [PagesController::class, 'store'])->name('insert');
            Route::get('detail/{id}', [PagesController::class, 'edit'])->name('detail');
            Route::post('update/{id}', [PagesController::class, 'update'])->name('update');
            Route::delete('destroy', [PagesController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('struktur')->group(function () {
            Route::get('list', [StrukturController::class, 'index'])->name('list');
            Route::post('insert', [StrukturController::class, 'store'])->name('insert');
            Route::get('detail/{id}', [StrukturController::class, 'edit'])->name('detail');
            Route::post('update/{id}', [StrukturController::class, 'update'])->name('update');
            Route::delete('destroy', [StrukturController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('kategori')->group(function () {
            Route::get('list', [CategoryController::class, 'index'])->name('list');
            Route::post('insert', [CategoryController::class, 'store'])->name('insert');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('destroy', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('level')->group(function () {
            Route::post('list', [UserLevelController::class, 'index'])->name('list');
            Route::post('insert', [UserLevelController::class, 'store'])->name('insert');
            Route::put('update/{id}', [UserLevelController::class, 'update'])->name('update');
            Route::delete('destroy', [UserLevelController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('tags')->group(function () {
            Route::get('list', [TagsController::class, 'index'])->name('list');
            Route::post('insert', [TagsController::class, 'store'])->name('insert');
            Route::post('update/{id}', [TagsController::class, 'update'])->name('update');
            Route::delete('destroy', [TagsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('download')->group(function () {
            Route::get('list', [DownloadController::class, 'index'])->name('list');
            Route::post('insert', [DownloadController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [DownloadController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [DownloadController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [DownloadController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('video')->group(function () {
            Route::get('list', [VideoController::class, 'index'])->name('list');
            Route::get('show/{id}', [VideoController::class, 'show'])->name('show');
            Route::post('insert', [VideoController::class, 'store'])->name('insert');
            Route::post('update/{id}', [VideoController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [VideoController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'index'])->name('list');
            Route::post('insert', [CategoryController::class, 'store'])->name('insert');
            Route::post('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('award')->group(function () {
            Route::get('list', [PenghargaanController::class, 'index'])->name('list');
            Route::post('insert', [PenghargaanController::class, 'store'])->name('insert');
            Route::put('update/{id}', [PenghargaanController::class, 'update'])->name('update');
            Route::get('edit/{id}', [PenghargaanController::class, 'edit'])->name('show');
            Route::delete('destroy/{id}', [PenghargaanController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('galery')->group(function () {
            Route::get('list', [GaleryController::class, 'index'])->name('list');
            Route::post('insert', [GaleryController::class, 'store'])->name('insert');
            Route::put('update/{id}', [GaleryController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [GaleryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('tags')->group(function () {
            Route::get('list', [TagsController::class, 'index'])->name('list');
            Route::post('insert', [TagsController::class, 'store'])->name('insert');
            Route::put('update/{id}', [TagsController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [TagsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('promo')->group(function () {
            Route::get('list', [PromosiController::class, 'index'])->name('list');
            Route::post('insert', [PromosiController::class, 'store'])->name('insert');
            Route::post('update/{id}', [PromosiController::class, 'update'])->name('update');
            Route::get('edit/{id}', [PromosiController::class, 'edit'])->name('edit');
            Route::delete('destroy', [PromosiController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('jadwal')->group(function () {
            Route::get('list', [JadwalController::class, 'index'])->name('list');
            Route::get('edit/{id}', [JadwalController::class, 'edit'])->name('edit');
            Route::post('insert', [JadwalController::class, 'store'])->name('insert');
            Route::post('update/{id}', [JadwalController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [JadwalController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('user')->group(function () {
            Route::get('list', [UsersController::class, 'index'])->name('list');
            Route::post('insert', [UsersController::class, 'store'])->name('insert');
            Route::post('edit/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [UsersController::class, 'update'])->name('update');
            Route::delete('destroy', [UsersController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('slider')->group(function () {
            Route::get('list', [SliderController::class, 'index'])->name('list');
            Route::post('insert', [SliderController::class, 'store'])->name('insert');
            Route::post('edit/{id}', [SliderController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [SliderController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('destroy');
        });

        // rest ful access to pointing apps
        Route::prefix('ppdb')->group(function () {
            Route::get('list', [PpdbController::class, 'index'])->name('list');
            Route::get('verify_bayar', [PpdbController::class, 'verifikasibayar'])->name('verifikasi_bayar');
            Route::post('insertsiswa/{id}', [PpdbController::class, 'insertsiswa'])->name('insertsiswa');
            Route::post('update/{id}', [PpdbController::class, 'update'])->name('update');
            Route::post('siswadetail/{id}', [PpdbController::class, 'siswadetail'])->name('siswadetail');
            Route::post('report/{id}', [PpdbController::class, 'Report'])->name('report');
        });
        Route::prefix('mapel')->group(function () {
            Route::get('list', [MapelController::class, 'index'])->name('list');
            Route::get('detail', [MapelController::class, 'verifikasibayar'])->name('edit');
            Route::post('edit/{id}', [MapelController::class, 'insertsiswa'])->name('edit');
            Route::post('update/{id}', [MapelController::class, 'update'])->name('update');
            Route::post('insert', [MapelController::class, 'store'])->name('insert');
            Route::post('delete/{id}', [MapelController::class, 'Report'])->name('delete');
        });
        Route::prefix('siswa')->group(function () {
            Route::get('list', [SiswaController::class, 'index'])->name('list');
            Route::post('create', [SiswaController::class, 'store']);

            Route::get('getBykelas/{id}', [SiswaController::class, 'getBykelas'])->name('getBykelas');
            Route::get('edit/{id}', [SiswaController::class, 'show'])->name('edit');
            Route::post('update/{id}', [SiswaController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [SiswaController::class, 'destroy']);
        });
        Route::prefix('tahunakademik')->group(function () {
            Route::get('list', [TahunAkademikController::class, 'index'])->name('list');
            Route::post('insert', [TahunAkademikController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [TahunAkademikController::class, 'edit'])->name('edit');
            Route::post('update', [TahunAkademikController::class, 'index'])->name('update');
            Route::delete('destroy/{id}', [TahunAkademikController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('parameterbiaya')->group(function () {
            Route::get('list', [ParameterBiayarController::class, 'index'])->name('list');
            Route::post('insert', [ParameterBiayarController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [ParameterBiayarController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ParameterBiayarController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [ParameterBiayarController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('absensi')->group(function () {
            Route::get('list', [AbsensiController::class, 'index'])->name('list');
            Route::post('insert', [ParameterBiayarController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [ParameterBiayarController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ParameterBiayarController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [ParameterBiayarController::class, 'destroy'])->name('destroy');
        });

        // Route::preg

        Route::prefix('tingkat')->group(function () {
            Route::get('list', [TingkatController::class, 'index'])->name('list');
            Route::post('insert', [ParameterBiayarController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [ParameterBiayarController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ParameterBiayarController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [ParameterBiayarController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('kelas')->group(function () {
            Route::get('list', [KelasController::class, 'index'])->name('list');
            Route::post('insert', [KelasController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [KelasController::class, 'edit'])->name('edit');
            Route::get('getbyUnit/{id}', [KelasController::class, 'getbyUnit'])->name('getbyUnit');

            Route::post('update/{id}', [KelasController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [KelasController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('divisi')->group(function () {
            Route::get('list', [DivisiController::class, 'index'])->name('list');
            Route::post('insert', [DivisiController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [DivisiController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [DivisiController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [DivisiController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pembayaran')->group(function () {
            // get jenis tagihan
            Route::get('getJenistagihan', [ParameterBiayarController::class, 'getJenistagihan'])->name('getJenisTagihan');
            Route::post('list', [PembayaranController::class, 'index'])->name('list');
            Route::post('terbitkanPembayaran', [PembayaranController::class, 'terbitkanPembayaran'])->name('terbitkanPembayaran');
            Route::post('insert', [PembayaranController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [PembayaranController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [PembayaranController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [PembayaranController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('pembayaran_detail')->group(function () {
            Route::get('list', [PembayaranDetailController::class, 'index'])->name('list');
            Route::post('insert', [PembayaranDetailController::class, 'store'])->name('insert');
            Route::get('edit/{id}', [PembayaranDetailController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [PembayaranDetailController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [PembayaranDetailController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('laporan')->group(function () {
            Route::get('ppdb', [PpdbController::class, 'reportpdb'])->name('ppdb');
        });

    });

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CcrController;
use App\Http\Controllers\PpcController;
use App\Http\Controllers\RjoController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\PekerjaanSelesaiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashController::class, 'index'])
                ->name('dashboard');
    Route::get('/akun', [UserController::class, 'viewAkun'])
                ->name('akun.view');
    Route::post('/akun', [UserController::class, 'saveAkun'])
                ->name('akun.save');


    Route::middleware(['role:ppc'])->group(function () {

        Route::get('/rjo/lists', [RjoController::class, 'lists'])
        ->name('rjo.lists');

        Route::get('/rjo/browse', [RjoController::class, 'browse'])
        ->name('rjo.browse');

        Route::get('/ccr/select', [CcrController::class, 'select'])
        ->name('ccr.select');

        Route::get('/selesai/list', [PekerjaanSelesaiController::class, 'list'])
        ->name('selesai.list');
        Route::resource('selesai', PekerjaanSelesaiController::class);

    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/user/list', [UserController::class, 'list'])
                ->name('user.list');
        Route::resource('user', UserController::class)->except('show');

        Route::get('/ppc/list', [PpcController::class, 'list'])
                ->name('ppc.list');
        Route::resource('ppc', PpcController::class)->except('show');
        
        Route::get('/marketing/list', [MarketingController::class, 'list'])
                ->name('marketing.list');
        Route::resource('marketing', MarketingController::class)->except('show');

        Route::get('/rjo/select', [RjoController::class, 'select'])
        ->name('rjo.select');

        Route::get('/ccr/list', [CcrController::class, 'list'])
        ->name('ccr.list');
        Route::get('/ccr/file/{ccr}', [CcrController::class, 'file'])
        ->name('ccr.file');
        Route::get('/ccr/surat/{ccr}', [CcrController::class, 'surat'])
        ->name('ccr.surat');
        Route::resource('ccr', CcrController::class);

        Route::get('/select/selesai', [PekerjaanSelesaiController::class, 'select'])
        ->name('selesai.select');
        
        Route::get('/sparepart/file/{sparepart}', [SparePartController::class, 'file'])
        ->name('sparepart.file');
        Route::get('/sparepart/perintah/{sparepart}', [SparePartController::class, 'perintah'])
        ->name('sparepart.perintah');
        Route::get('/sparepart/surat/{sparepart}', [SparePartController::class, 'surat'])
        ->name('sparepart.surat');
        Route::get('/sparepart/list', [SparePartController::class, 'list'])
        ->name('sparepart.list');
        Route::resource('sparepart', SparePartController::class)->except('edit','update');

    });

    Route::middleware(['role:marketing'])->group(function () {
        
        Route::get('/customer/list', [CustomerController::class, 'list'])
        ->name('customer.list');
        Route::resource('customer', CustomerController::class);
        
        Route::get('/rjo/list', [RjoController::class, 'list'])
        ->name('rjo.list');
        
        Route::resource('rjo', RjoController::class);

    });

    Route::middleware(['role:manager'])->group(function () {
        Route::get('/statistik/staff', [StatistikController::class, 'staff'])
        ->name('statistik.staff');
        Route::get('/statistik/customer', [StatistikController::class, 'customer'])
        ->name('statistik.customer');
    });


});


require __DIR__.'/auth.php';

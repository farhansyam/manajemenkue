<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KueController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DropingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SetoranController;
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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    
    Route::get('history', [KueController::class,'history'])->name('mylist.history');
    Route::Resource('mylist', KueController::class);
    Route::Resource('users', UsersController::class);
    Route::Resource('droping', DropingController::class);
    Route::Resource('setoran', SetoranController::class);
    Route::Resource('order', OrderController::class);
    Route::get('piutang', [OrderController::class,'piutang'])->name('piutang');
Route::Resource('return', ReturnController::class);
Route::get('approvalsetoran', [SetoranController::class,'approval'])->name('setoran.approval');
Route::get('approvinsetoran/{id}', [SetoranController::class,'approvin'])->name('setoran.approvin');
Route::get('ordermove/{id}', [OrderController::class,'move'])->name('order.move');
Route::get('approvalorder', [OrderController::class,'approval'])->name('order.approval');
Route::get('approvinorder/{id}', [OrderController::class,'approvin'])->name('order.approvin');
    Route::get('approvaldrop', [DropingController::class,'approval'])->name('droping.approval');
    Route::get('approvin/{id}', [DropingController::class,'approvin'])->name('droping.approvin');
    Route::get('decline/{id}', [DropingController::class,'decline'])->name('droping.decline');

    Route::get('users/detail/{id}', [UsersController::class,'detail'])->name('users.detail');
    Route::get('tracking', [KueController::class,'tracking'])->name('tracking');
    Route::get('trackkueid', [KueController::class,'trackingkueid'])->name('trackkue-id');
    Route::get('trackkue', [KueController::class,'trackingkue'])->name('trackkue');
    Route::get('trackagenid', [KueController::class,'trackingagenid'])->name('trackagen-id');
    Route::get('trackagen', [KueController::class,'trackingagen'])->name('trackagen');
    Route::get('trackkoorid', [KueController::class,'trackingkoorid'])->name('trackkoor-id');
    Route::get('trackkoor', [KueController::class,'trackingkoor'])->name('trackkoor');
    Route::get('tracksalesid', [KueController::class,'trackingsalesid'])->name('tracksales-id');
    Route::get('tracksales', [KueController::class,'trackingsales'])->name('tracksales');
    Route::get('approval', [UsersController::class,'approval'])->name('approval');
    Route::get('approvin-user/{id}', [UsersController::class,'approvin'])->name('users.approvin');
    Route::get('unapprovin-user/{id}', [UsersController::class,'unapprovin'])->name('users.unapprovin');
    // Route::get('users/detail/gudang/{id}', [UsersController::class,'detailgudang'])->name('users.detailgudang');
});
Route::post('signup', [UsersController::class,'signup'])->name('users.signup');
    Route::get('daftar', [UsersController::class,'daftar'])->name('users.unapprovin');

<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

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
Route::get('', [PagesController::class, 'index']);

// Route::get('/', function () {
//     return ("welcome");
// });

Route::get('/add_device', function () {
    return view ('pages.add_device');
});
// Route::get('/', function(){
// return view('index');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/service', [PagesController::class, 'service']);
Route::get('/add_device', [App\Http\Controllers\PagesController::class, 'add_device'])->name('add_device');
Route::get('pages.getDevice', [App\Http\Controllers\PagesController::class, 'getDeviceState'])->name("pages.getDevice");
Route::post('/add_device/', [App\Http\Controllers\PagesController::class, 'store'])->name("add.store");

//Route::

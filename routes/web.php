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

//Routes for Homecontroler
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for Pages Controller
Route::get('home', [App\Http\Controllers\PagesController::class, 'dashboard'])->name('dashboard');
Route::get('/add_device', [App\Http\Controllers\PagesController::class, 'add_device'])->name('add_device');
Route::get('pages.getDevice', [App\Http\Controllers\PagesController::class, 'getDeviceState'])->name("pages.getDevice");
Route::post('/add_device/', [App\Http\Controllers\PagesController::class, 'store'])->name("add.store");
Route::resource("posts", PagesController::class);

//Routes to Website Controller
Route::get('/index', [App\Http\Controllers\WebsiteController::class, 'index'])->name('website');

//Routes to DeviceConfig controller
Route::get('/deviceConfig', [App\Http\Controllers\DeviceConfig::class, 'index'])->name('deviceConfig');
Route::get('/editDeviceConfig', [App\Http\Controllers\DeviceConfig::class, 'edit'])->name('edit');
Route::post('', [App\Http\Controllers\DeviceConfig::class, 'update'])->name('config.update');




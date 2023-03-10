<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceControlController;

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

//Route::get('getDevice', [App\Http\Controllers\PagesController::class, 'updateState'])->name("getDevice");

Route::post('/add_device/', [App\Http\Controllers\PagesController::class, 'store'])->name("add.store");
Route::resource("posts", PagesController::class);

//Routes to Website Controller
Route::get('/index', [App\Http\Controllers\WebsiteController::class, 'index'])->name('website');

//Routes to DeviceConfig controller
//Route::resource('/pages', DeviceConfig::class);
Route::get('/deviceConfig', [App\Http\Controllers\DeviceConfig::class, 'index'])->name('deviceConfig');
Route::get('/editDeviceConfig', [App\Http\Controllers\DeviceConfig::class, 'edit'])->name('edit');
Route::post('', [App\Http\Controllers\DeviceConfig::class, 'update'])->name('config.update');
Route::delete('/deviceConfig', [App\Http\Controllers\DeviceConfig::class, 'destroy'])->name('delete');

//Route to Messages controller
Route::post('index', [App\Http\Controllers\MessagesController::class, 'store'])->name('store.messages');


//Route for DeviceControllers
//Route::get('pages.getDevice', [App\Http\Controllers\PagesController::class, 'getDeviceState'])->name("pages.getDevice");
Route::get('updatetwoState', [App\Http\Controllers\DeviceControlController::class, 'updatetwoState'])->name("updatetwoState");
Route::get('updateMultiState', [App\Http\Controllers\DeviceControlController::class, 'updateMultiState'])->name("updateMultiState");



//Route to monitor device current status
Route::get('monitor', [App\Http\Controllers\DeviceControlController::class, 'monitor'])->name("monitor");








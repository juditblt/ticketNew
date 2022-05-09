<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PublicController::class, 'index']);
/* Kipróbálás:
Route::get('/home', function (){
    return "HOME";
});
*/

Route::get('/home', [PrivateController::class, 'home'])->name('private.home')
    ->middleware('auth');
Route::post('/store', [PrivateController::class, 'store'])->name('private.ticket.store')
    ->middleware('auth');

Route::prefix('admin')->name('admin')->middleware('role:admin')->group(function (){

    Route::get('', function (){
        return 'Admin site...';
    })->name('');

    Route::prefix('/categories')->name('.categories')->controller(CategoryController::class)->group(function (){
        Route::get('','index')->name('');
        Route::post('/store','store')->name('.store');
        Route::post('/destroy/{id}','destroy')->name('.destroy');
        Route::post('/enable','enable')->name('.enable');
        Route::post('/disable','disable')->name('.disable');
    });

    Route::prefix('/tickets')->name('.tickets')->controller(TicketController::class)->group(function () {
        Route::get('','index')->name('');
        Route::get('/show/{id}','show')->name('.show');

        Route::get('/status/{id}/{status}','status')->name('.status');

        Route::post('/destroy', 'destroy')->name('.destroy');
        Route::post('/revert','revert')->name('.revert');
        Route::post('/permanent','permanent')->name('.permanent');
    });

    Route::prefix('/users')->name('.users')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('');
        Route::post('/destroy','destroy')->name('.destroy');
        Route::post('/promote', 'promote')->name('.promote');
    });
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';

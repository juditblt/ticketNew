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

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories')
    ->middleware('auth');
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store')
    ->middleware('auth');

Route::post('/admin/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy')
    ->middleware('auth');

Route::post('/admin/categories/enable', [CategoryController::class, 'enable'])->name('admin.categories.enable')
    ->middleware('auth');
Route::post('/admin/categories/disable', [CategoryController::class, 'disable'])->name('admin.categories.disable')
    ->middleware('auth');

Route::get('/admin/tickets', [TicketController::class, 'index'])
    ->name('admin.tickets')->middleware('auth');
Route::get('/admin/tickets/show/{id}', [TicketController::class, 'show'])
    ->name('admin.tickets.show')->middleware('auth');

Route::get('/admin/tickets/status/{id}/{status}', [TicketController::class, 'status'])
    ->name('admin.tickets.status')->middleware('auth');

Route::post('/admin/tickets/destroy', [TicketController::class, 'destroy'])
    ->name('admin.tickets.destroy')->middleware('auth');
Route::post('/admin/tickets/revert', [TicketController::class, 'revert'])
    ->name('admin.tickets.revert')->middleware('auth');
Route::post('/admin/tickets/permanent', [TicketController::class, 'permanent'])
    ->name('admin.tickets.permanent')->middleware('auth');

Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin.users')->middleware('auth');
Route::post('/admin/users/destroy', [UserController::class, 'destroy'])
    ->name('admin.users.destroy')->middleware('auth');
Route::post('/admin/users/promote', [UserController::class, 'promote'])
    ->name('admin.users.promote')->middleware('auth');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';

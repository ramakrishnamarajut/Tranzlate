<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Blogs;
use App\Http\Livewire\Clients;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('translations',\App\Http\Controllers\TranslationsController::class);
Route::get('blog', Blogs::class);

Route::get('clients', Clients::class);

Route::resource('roles',\App\Http\Controllers\RoleController::class);

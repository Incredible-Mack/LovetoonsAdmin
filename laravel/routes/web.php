<?php

use App\Http\Controllers\LetReadTheBible;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('addvideo', [LetReadTheBible::class, 'addvideo'])->name('addvideo');

Route::post('addvideo', [LetReadTheBible::class, 'store'])->name('addvideo');


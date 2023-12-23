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

Route::get('/', function () { return view('welcome'); });

//let read the bible
Route::get('addvideo', [LetReadTheBible::class, 'addvideo'])->name('addvideo');
Route::get('updatevideo', [LetReadTheBible::class, 'fetchvideo'])->name('fetchvideo');
Route::get('lrdb', [LetReadTheBible::class, 'fetchuploadedvideo'])->name('lrdb');
Route::get('editvideo/{id}', [LetReadTheBible::class, 'editvideo'])->name('editvideo');

Route::post('updatevideo', [LetReadTheBible::class, 'updatevideo'])->name('updatevideo');
Route::post('addvideo', [LetReadTheBible::class, 'store'])->name('addvideo');
Route::post('deletevideo', [LetReadTheBible::class, 'deletevideo'])->name('deletevideo');
Route::post('confirm_video_used', [LetReadTheBible::class, 'confirmvideo'])->name('confirmvideo');



<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/youtube', [DownloadController::class, 'youtubeDownload'])->name('youtube.download');
Route::get('/instagram', [DownloadController::class, 'instagramDownload'])->name('instagram.download');
Route::get('/tiktok', [DownloadController::class, 'tiktokDownload'])->name('tiktok.download');

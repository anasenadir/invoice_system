<?php

use App\Http\Controllers\General;
use App\Http\Controllers\Invoices;
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

Route::get('/', [Invoices::class , 'index'])->name('home');


// Auth::routes();

Route::get('change-language/{locale}',[General::class , 'changeLanguage'])->name('changelocale');

Route::get('invoice/download/{id}' , [Invoices::class , 'downloadInvoice'])->name('invoice.downloadInvoice');
Route::get('invoice/sendInvoice/{id}' , [Invoices::class , 'sendInvoice'])->name('invoice.sendInvoice');
Route::resource('invoice' , Invoices::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

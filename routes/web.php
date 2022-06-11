<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\UserController;
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
Route::resource('api/user', UserController::class);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('generateSummary/{id}', [PDFController::class, 'generateSummary']);
    Route::resource('api/vendedor', VendedorController::class);
    Route::resource('api/document', DocumentController::class);
    Route::resource('api/product', ProductController::class);

   
    Route::get('/auditores', function () {
        return view('vendedor.index');
    });

    Route::get('/documents', function () {
        return view('document.index');
    });

    Route::get('/products', function () {
        return view('product.index');
    });

    Route::get('/reports', function () {
        return view('reports');
    });

    Route::get('/summary', function () {
        return view('summary.index');
    });
});


Auth::routes(['reset'=>false]);

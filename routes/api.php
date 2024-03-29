<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\Sponsors\SponsorController;
use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Admin\AdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/apartments', [PageController::class, 'index']);
Route::get('/research/{tosearch}', [PageController::class, 'searchApartments']);
Route::get('/apartments/get-apartment/{slug}', [PageController::class, 'getSlugApartment']);
Route::post('/research/{address}', [PageController::class, 'searchDistanceApartments']);
Route::get('/services', [PageController::class, 'getServices']);
Route::get('/advanced-search', [PageController::class, 'searchAdvanceApartments']);


Route::get('/generate', [OrderController::class, 'generate']);
Route::post('orders/make/payment', [OrderController::class, 'makePayment'])->name('makePayment');
Route::get('/sponsors', [SponsorController::class, 'index']);
// Route::middleware(['auth', 'verified'])
// ->prefix('pay')
// ->name('pay.')
// ->group(function () {
//     });
Route::post('/payment/create', [OrderController::class, 'create'])->name('payment.create');
Route::post('/send-email', [MessageController::class, 'store']);

<?php

use App\Http\Controllers\Api\garage\AuthController as GarageAuthController;
use App\Http\Controllers\Api\montir\AuthController as MontirAuthController;
use App\Http\Controllers\Api\user\AddressController;
use App\Http\Controllers\Api\user\AuthController;
use App\Http\Controllers\Api\user\BrandController;
use App\Http\Controllers\Api\user\HistoryController;
use App\Http\Controllers\Api\user\MotorcycleController;
use App\Http\Controllers\Api\user\PanggilDaruratController;
use App\Http\Controllers\Api\user\PanggilServiceController;
use App\Http\Controllers\Api\user\TypeController;
use App\Http\Controllers\Api\user\VariantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/is-email-exist', [AuthController::class, 'isEmailExist']);
Route::post('/garage/register', [GarageAuthController::class, 'register']);
Route::post('/montir/register', [MontirAuthController::class, 'register']);

Route::post('/user/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function ($router) {
    Route::get('/user/get-current-user', [AuthController::class, 'getCurrentUser']);
    Route::post('/user/logout', [AuthController::class, 'logout']);

    Route::get('/user/get-garages', [PanggilServiceController::class, 'getGaragesByUserLocation']);
    Route::get('/user/get-current-address', [PanggilServiceController::class, 'getAddressByIsSelected']);
    Route::get('/user/get-services/{id}', [PanggilServiceController::class, 'getServicesByGarageId']);
    Route::get('/user/get-detail-garage/{id}', [PanggilServiceController::class, 'getDetailGarageById']);
    Route::get('/user/get-motorcycles', [PanggilServiceController::class, 'getMotorcyclesByUser']);
    Route::post('/user/store-order-servis', [PanggilServiceController::class, 'storeOrder']);

    Route::get('/user/get-current-motorcycle', [MotorcycleController::class, 'getCurrentMotorcycle']);
    Route::get('/user/get-list-motorcycles', [MotorcycleController::class, 'index']);
    Route::post('/user/store-motorcycle', [MotorcycleController::class, 'store']);
    Route::post('/user/update-motorcycle/{id}', [MotorcycleController::class, 'update']);
    Route::post('/user/delete-motorcycle/{id}', [MotorcycleController::class, 'destroy']);

    Route::get('/user/get-list-address', [AddressController::class, 'index']);
    Route::post('/user/store-address', [AddressController::class, 'store']);
    Route::post('/user/update-address/{id}', [AddressController::class, 'update']);
    Route::delete('/user/delete-address/{id}', [AddressController::class, 'destroy']);

    Route::get('/user/get-history-order', [HistoryController::class, 'index']); 

    Route::post('/user/find-montir', [PanggilDaruratController::class, 'findMontir']);

    Route::get('/user/get-brands', [BrandController::class, 'index']);
    Route::get('/user/get-types/{id}', [TypeController::class, 'index']);
    Route::get('/user/get-variants/{id}', [VariantController::class, 'index']);
});
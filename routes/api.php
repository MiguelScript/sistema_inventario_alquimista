<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DollarRate\GetDollarRateController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']); */
include("admin-routes/usuarios.php");


Route::group([
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'get_user']);
});



Route::group(['middleware' => ['jwt.verify']], function () {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/


    include("admin-routes/productos.php");
    include("admin-routes/ventas.php");
    include("admin-routes/stats.php");

});

Route::get('/obtener-tasa-dolar-actual', [GetDollarRateController::class, '__invoke']);


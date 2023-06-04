<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PMIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BdrsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RequestsController;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('forget', [AuthController::class, 'forget']);
  Route::post('login', [AuthController::class, 'login']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
});

Route::get('/getReq', [RequestsController::class, 'index']);
Route::get('/getReq/filter/{goldar}', [RequestsController::class, 'filter']);
Route::get('/getReq/detail/{id}', [RequestsController::class, 'detail']);
Route::get('/getReq/my', [RequestsController::class, 'my'])->middleware('jwt.verify');
Route::post('/postReq', [RequestsController::class, 'add']);

Route::get('/getBDRS', [BdrsController::class, 'get'])->middleware('jwt.verify');

Route::get('/getNews', [NewsController::class, 'get'])->middleware('jwt.verify');
Route::get('/getNews/{id}', [NewsController::class, 'ById'])->middleware('jwt.verify');


Route::get('/pmi/jadwal', [PMIController::class, 'jadwal'])->middleware('jwt.verify');
Route::get('/pmi/stok/', [PMIController::class, 'stok']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

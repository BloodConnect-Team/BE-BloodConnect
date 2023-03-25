<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PMIController;
use App\Http\Controllers\AuthController;
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
  Route::post('reset/{token}', [AuthController::class, 'reset']);
  Route::post('login', [AuthController::class, 'login']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
});

Route::get('/getReq', [RequestsController::class, 'index'])->middleware('jwt.verify');
Route::get('/getReq/filter/{goldar}', [RequestsController::class, 'filter'])->middleware('jwt.verify');
Route::get('/getReq/detail/{id}', [RequestsController::class, 'detail'])->middleware('jwt.verify');
Route::get('/getReq/my', [RequestsController::class, 'my'])->middleware('jwt.verify');
Route::post('/postReq', [RequestsController::class, 'add'])->middleware('jwt.verify');

Route::get('/pmi/jadwal', [PMIController::class, 'jadwal']);
Route::get('/pmi/udd', [PMIController::class, 'udd']);
Route::get('/pmi/stok/{udd}', [PMIController::class, 'stok']);






// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

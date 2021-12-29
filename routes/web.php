<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

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
    return view('welcome');
});

Route::get('Users/Create',[studentController::class,'create']);
Route::post('Users/Store',[studentController::class,'store']);

Route::get('Users', [studentController::class, 'index']);
Route::get('Users/remove/{id}', [studentController::class, 'destroy']);
Route::get('Users/edit/{id}', [studentController::class, 'edit']);
Route::post('Users/update', [studentController::class, 'update']);

//#Auth ....
//Route::get('Login', [studentController::class, 'Login']);
//Route::post('DoLogin', [studentController::class, 'DoLogin']);
//Route::get('logout', [studentController::class, 'logout']);

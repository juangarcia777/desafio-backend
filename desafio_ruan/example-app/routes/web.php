<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OperationsController;

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

// ROTAS DESTINADAS AO USUÁRIO
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users/create', [UsersController::class, 'create']);
Route::put('/users/edit/{id}', [UsersController::class, 'edit']);
Route::delete('/users/delete/{id}', [UsersController::class, 'destroy']);
Route::put('/users/alter_value/{id}', [UsersController::class, 'alterValue']);
Route::get('/users/total/{id}', [UsersController::class, 'showTotal']);


Route::get('/operations/all', [OperationsController::class, 'index']);
Route::post('/operations/user/{id}', [OperationsController::class, 'createOperation']);
Route::delete('/operations/delete/{id}', [OperationsController::class, 'destroyMoviment']);
Route::get('/operations/csv/{user}/{type}', [OperationsController::class, 'showCSV']);

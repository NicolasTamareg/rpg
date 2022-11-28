<?php

use App\Http\Controllers\UserController;
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

Route::post('/inscription', [UserController::class, 'createinscription']) -> name('user.inscription');
Route::post('/connexion', [UserController::class, 'createconnexion']) -> name('user.connexion');
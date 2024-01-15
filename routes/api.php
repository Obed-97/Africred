<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CreditController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RecouvrementController;
use App\Http\Controllers\Api\MarcheController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\EncoursController;

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

Route::apiResources([
    '/' => HomeController::class,
    'client' => ClientController::class,
    'credit' => CreditController::class,
    'user' => UserController::class,
    'recouvrement' => RecouvrementController::class,
    'marche' => MarcheController::class,
    'role' => RoleController::class,
    'encours' => EncoursController::class,
]);
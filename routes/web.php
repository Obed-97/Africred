<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\RecouvrementController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\FiltreController;
use App\Http\Controllers\EtatGlobalController;
use App\Http\Controllers\EtatRecouvrementController;
use App\Http\Controllers\EtatCaisseController;
use App\Http\Controllers\EtatCreditController;

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
Route::group(['middleware'=>['auth']], function(){

Route::resources([
    '/' => DashboardController::class,
    '/filtre' => FiltreController::class,
    '/etat_global' => EtatGlobalController::class,
    '/etat_recouvrement' => EtatRecouvrementController::class,
    '/etat_caisse' => EtatCaisseController::class,
    '/etat_credit' => EtatCreditController::class,
    '/role' => RoleController::class,
    '/personnel' => PersonnelController::class,
    '/client' => ClientController::class,
    '/credit' => CreditController::class,
    '/recouvrement' => RecouvrementController::class,
    '/historique' => HistoriqueController::class,
    '/depot_caisse' => DepotController::class,
    
]);

});


require __DIR__.'/auth.php';

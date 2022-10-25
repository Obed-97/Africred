<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\RecouvrementController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\FiltreController;
use App\Http\Controllers\EtatGlobalController;
use App\Http\Controllers\EtatRecouvrementController;
use App\Http\Controllers\EtatCreditController;
use App\Http\Controllers\EtatEncoursGlobalSIController;
use App\Http\Controllers\EtatClientController;
use App\Http\Controllers\DateRecController;

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
    '/etat_credit' => EtatCreditController::class,
    '/etat_client' => EtatClientController::class,
    '/role' => RoleController::class,
    '/personnel' => PersonnelController::class,
    '/client' => ClientController::class,
    '/credit' => CreditController::class,
    '/recouvrement' => RecouvrementController::class,
    '/historique' => HistoriqueController::class,
    '/etat_encours_global' => EtatEncoursGlobalSIController::class,
    '/date' => DateRecController::class,
    
]);

Route::get('/afficher', [EtatRecouvrementController::class, 'affiche'])->name('etat_recouvrement.affiche');
Route::get('/marche', [CreditController::class, 'marche'])->name('credit.marche');
Route::get('/marche/jour', [EtatCreditController::class, 'marche'])->name('etat_credit.marche');

Route::get('/marche/client', [clientController::class, 'marche'])->name('client.marche');


});


require __DIR__.'/auth.php';

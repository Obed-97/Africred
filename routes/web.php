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
use App\Http\Controllers\DepotController;
use App\Http\Controllers\HistDepotController;
use App\Http\Controllers\EncaissementController;
use App\Http\Controllers\DecaissementController;
use App\Http\Controllers\EtatEncController;
use App\Http\Controllers\EtatDecController;
use App\Http\Controllers\BanqueController;

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
    '/depot' => DepotController::class,
    '/historique_depot' => HistDepotController::class,
    '/encaissement' => EncaissementController::class,
    '/decaissement' => DecaissementController::class,
    '/etat_encaissement' => EtatEncController::class,
    '/etat_decaissement' => EtatDecController::class,
    '/banque' => BanqueController::class,
    
]);

Route::get('/afficher', [EtatRecouvrementController::class, 'affiche'])->name('etat_recouvrement.affiche');
Route::get('/marche', [CreditController::class, 'marche'])->name('credit.marche');
Route::get('/marche/jour', [EtatCreditController::class, 'marche'])->name('etat_credit.marche');

Route::get('/marche/client', [clientController::class, 'marche'])->name('client.marche');

Route::post('/retrait', [DepotController::class, 'retrait'])->name('depot.retrait');
Route::get('/tontine', [DepotController::class, 'tontine'])->name('depot.tontine');
Route::get('/epargne', [DepotController::class, 'epargne'])->name('depot.epargne');

Route::post('/date_encaissement', [EtatEncController::class, 'date'])->name('etat_encaissement.date');
Route::post('/date_decaissement', [EtatDecController::class, 'date'])->name('etat_decaissement.date');


});


require __DIR__.'/auth.php';

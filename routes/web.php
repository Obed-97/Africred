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
use App\Http\Controllers\Etat_actualiseController;
use App\Http\Controllers\ControleController;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\AttenteController;
use App\Http\Controllers\SoldeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ArreteController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\IndicateurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MarcheController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\TransfertController;
use App\Http\Controllers\TauxController;

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
    '/etat_actualise' => Etat_actualiseController::class,
    '/controle' => ControleController::class,
    '/journalier' => JournalierController::class,
    '/attente' => AttenteController::class,
    '/credit_solde' => SoldeController::class,
    '/profile' => ProfileController::class,
    '/performance' => PerformanceController::class,
    '/arrete' => ArreteController::class,
    '/reporting' => ReportingController::class,
    '/indicateur' => IndicateurController::class,
    '/entreprise' => EntrepriseController::class,
    '/transfert' => TransfertController::class,
    '/taux' => TauxController::class,
    '/les_marches' => MarcheController::class,
    '/filieres' => FiliereController::class,
    '/secteurs' => SecteurController::class,
]);

Route::get('/permission', [PersonnelController::class, 'permission'])->name('permission');
Route::post('/store/permission', [PersonnelController::class, 'permission_store'])->name('store.permission');
Route::post('/revok/permission', [PersonnelController::class, 'permission_revok'])->name('revok.permission');


Route::get('/afficher', [EtatRecouvrementController::class, 'affiche'])->name('etat_recouvrement.affiche');
Route::get('/marche', [CreditController::class, 'marche'])->name('credit.marche');
Route::get('/marche/jour', [EtatCreditController::class, 'marche'])->name('etat_credit.marche');

Route::get('/credit_en_perte', [EtatCreditController::class, 'perte'])->name('etat_credit.perte');

Route::get('/marche/client', [clientController::class, 'marche'])->name('client.marche');

Route::post('/retrait', [DepotController::class, 'retrait'])->name('depot.retrait');
Route::get('/tontine', [DepotController::class, 'tontine'])->name('depot.tontine');
Route::get('/epargne', [DepotController::class, 'epargne'])->name('depot.epargne');
Route::post('/solde_épargne', [DepotController::class, 'livret'])->name('depot.livret');

Route::post('/date_encaissement', [EtatEncController::class, 'date'])->name('etat_encaissement.date');
Route::post('/date_decaissement', [EtatDecController::class, 'date'])->name('etat_decaissement.date');

Route::get('/retard/2', [ControleController::class, 'retard2'])->name('retard2');
Route::get('/retard/3', [ControleController::class, 'retard3'])->name('retard3');
Route::get('/retard/4', [ControleController::class, 'retard4'])->name('retard4');

Route::post('/supprimer_depot', [HistDepotController::class, 'destroy'])->name('supprimer.depot');

Route::post('/supprimer', [HistoriqueController::class, 'destroy'])->name('supprimer');

Route::post('/supprimer_crédit', [CreditController::class, 'destroy'])->name('supprimer.credit');

Route::post('/retrait_epargne', [RecouvrementController::class, 'retrait'])->name('retrait.epargne');

Route::post('/supprimer_client', [ClientController::class, 'destroy'])->name('supprimer.client');

Route::post('/accorder_credit', [AttenteController::class, 'update'])->name('credit.accorder');

Route::post('/nano_credit', [CreditController::class, 'nano'])->name('nano.store');

Route::post('/supprime_credit', [CreditController::class, 'destroy'])->name('supprimer.pret');

Route::get('/nano', [CreditController::class, 'nano_index'])->name('nano.index');

Route::get('/nano_affiche/{id}', [CreditController::class, 'shownano'])->name('nano.show');

Route::post('/adhesion', [ClientController::class, 'demande'])->name('demande.adhesion');

Route::post('/supp_entreprise', [EntrepriseController::class, 'destroy'])->name('delete.client');

Route::post('/indicateur_date', [IndicateurController::class, 'dates'])->name('indicateur.date');

Route::post('/filtre_solde', [EtatCreditController::class, 'filtre_solde'])->name('etat_credit.solde');

Route::get('/envois', [TransfertController::class, 'envois'])->name('transfert.envois');

Route::post('/date_operations', [BanqueController::class, 'date'])->name('banque.date');

Route::post('/update_password', [ProfileController::class, 'update_password'])->name('profile.password');

Route::get('/ab_sugu', [EtatRecouvrementController::class, 'arrete_s'])->name('ab_sugu');

Route::post('/historique_credit', [HistoriqueController::class, 'hist'])->name('hist');

Route::post('/histo/epargne/plus/filtre', [HistDepotController::class, 'filtre'])->name('histo.epargne.plus.filtre');

});


require __DIR__.'/auth.php';

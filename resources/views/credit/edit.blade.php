@section('title', 'Crédit')

@extends('master')

@section('content')
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                   

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                            <li class="breadcrumb-item active">Fiche d'identification</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                       

                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Formulaire d'identification</h4>
    
                                            <div id="progrss-wizard" class="twitter-bs-wizard">
                                                <ul class="twitter-bs-wizard-nav nav-justified">
                                                    <li class="nav-item">
                                                        <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                            <span class="step-number">01</span>
                                                            <span class="step-title">Informations personelles du client</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                            <span class="step-number">02</span>
                                                            <span class="step-title">Informations sur l'activité du client</span>
                                                        </a>
                                                    </li>
    
                                                    <li class="nav-item">
                                                        <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                            <span class="step-number">03</span>
                                                            <span class="step-title">Informations finanacières</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                                            <span class="step-number">04</span>
                                                            <span class="step-title">Envoi</span>
                                                        </a>
                                                    </li>
                                                </ul>
    
                                                <div id="bar" class="progress mt-4">
                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                                </div>
                                                <form action="{{route('credit.update', $credit->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                {{method_field('PUT')}}
                                                <div class="tab-content twitter-bs-wizard-tab-content">
                                                    <div class="tab-pane" id="progress-seller-details">
                                                        
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-firstname-input">Nom complet</label>
                                                                        <select class="form-control select2" name="client_id" required>
                                                                            <option value="{{$credit->client_id}}|{{$credit->sexe}}">{{$credit->Client['nom_prenom']}}</option>
                                                                            @foreach ($clients as $item)
                                                                                <option value="{{$item->id}}|{{$item->type_compte_id}}|{{$item->sexe}}">{{$item->nom_prenom}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-lastname-input">Marché</label>
                                                                        <select class="form-control select2" name="marche_id" required>
                                                                            <option value="{{$credit->marche_id}}">{{$credit->Marche['libelle']}} </option>
                                                                                @foreach ($marches as $item)
                                                                                <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                                                @endforeach
                                                                         </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-lastname-input">Sexe</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-lastname-input" value="{{$credit->Client['sexe']}}" name="sexe" required>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Adresse</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-phoneno-input"  value="{{$credit->Client['adresse']}}" name="adresse" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Numéro téléphone</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input"  value="{{$credit->Client['telephone']}}" name="telephone" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Situation de famille</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="situation_familiale"  required>
                                                                                    <option value="Marié">Marié</option>
                                                                                    <option value="Célibataire">Célibataire</option>
                                                                                    <option value="Fiancé">Fiancé</option>
                                                                                    <option value="En couple">En couple</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Nombre d'enfants</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-phoneno-input" name="nbre_enfant" value="{{$credit->nbre_enfant}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Nombre de femmes</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-email-input" name="nbre_femme" value="{{$credit->nbre_femme}}" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Projet immobilier</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="projet_immobilier"  required>
                                                                                    <option value="OUI">OUI</option>
                                                                                    <option value="NON">NON</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Sponsor</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input" name="sponsor" value="{{$credit->sponsor}}" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Filière d'activité</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="filiere_id"  required>
                                                                                   @foreach ($filieres as $item)
                                                                                        <option value="1"></option>
                                                                                        <option value="{{ $item->id }}">{{ $item->libelle }} | {{ $item->Marche['libelle'] }}</option>
                                                                                   @endforeach 
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Secteur d'activité</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="secteur_id"  required>
                                                                                   @foreach ($secteurs as $item)
                                                                                        <option value="1"></option>
                                                                                        <option value="{{ $item->id }}">{{ $item->libelle }} | {{ $item->Marche['libelle'] }}</option>
                                                                                   @endforeach 
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       
                                                    </div>
                                                    <div class="tab-pane" id="progress-company-document">
                                                      <div>
                                                       
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-firstname-input">Nom de l'entreprise / Activité</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-firstname-input" name="nom_entreprise" value="{{$credit->nom_entreprise}}"> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-lastname-input">Type de l'activité</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="type_activite"  required>
                                                                                    <option value="Commerce">Commerce</option>
                                                                                    <option value="Prestation de service">Prestation de service</option>
                                                                                    <option value="Artisanat">Artisanat</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-firstname-input">Date de création de l'entreprise / Activité</label>
                                                                        <input type="date" class="form-control" id="progress-basicpill-firstname-input" name="date_entreprise" value="{{$credit->date_entreprise}}"  >
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Structure juridique de l'entreprise / Activité</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="structure"  >
                                                                                    <option value="S.A">S.A</option>
                                                                                    <option value="S.A.R.L">S.A.R.L</option>
                                                                                    <option value="S.N.C">S.N.C</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Adresse de l'entreprise</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input" name="adresse_entreprise" value="{{$credit->adresse_entreprise}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Numéro RCCM</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input" name="rccm" value="{{$credit->rccm}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Nombre d'années d'expérience</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-phoneno-input" name="annee_experience" value="{{$credit->annee_experience}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Description des produits et services offerts</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input" name="description_produit" value="{{$credit->description_produit}}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        
                                                      </div>
                                                    </div>
                                                    <div class="tab-pane" id="progress-bank-detail">
                                                        <div>
                                                       
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-firstname-input">Revenu mensuel brut de l'entreprise / Activité</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-firstname-input" name="revenu_brute" value="{{$credit->revenu_brute}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-lastname-input">Revenu mensuel net de l'entreprise / Activité</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-firstname-input" name="revenu_net" value="{{$credit->revenu_net}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-firstname-input">Autres sources de revenu</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-firstname-input" name="autre_source" value="{{$credit->autre_source}}">
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Dettes existantes "Crédits encours, prêts anterieurs"</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-phoneno-input" name="dettes_existantes" value="{{$credit->dettes_existantes}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Valeur des actifs de l'entreprise</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-email-input" name="valeur_actif" value="{{$credit->valeur_actif}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Montant du crédit demandé</label>
                                                                        <input type="number" class="form-control" id="progress-basicpill-email-input" value="{{$credit->montant}}" name="montant" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-phoneno-input">Durée souhaitée du crédit "Jour/Mois/Années"</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-phoneno-input" name="duree_souhaitee" value="{{$credit->duree_souhaitee}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Utilisation prévue des fonds empruntés</label>
                                                                        <input type="text" class="form-control" id="progress-basicpill-email-input" name="utilisation_fonds" value="{{$credit->utilisation_fonds}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="progress-basicpill-email-input">Plan de remboursement proposé</label>
                                                                        <div>
                                                                            <select class="form-control select2" name="plan_remboursement"  required>
                                                                                    <option value="Journalier">Journalier</option>
                                                                                    <option value="Mensuel">Mensuel</option>
                                                                                    <option value="Trimestriel">Trimestriel</option>
                                                                                    <option value="Semestriel">Semestriel</option>
                                                                                    <option value="Annuel">Annuel</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        
                                                      </div>
                                                       
                                                    </div>
                                                    <div class="tab-pane" id="progress-confirm-detail">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6">
                                                                <div class="text-center">
                                                                    <div class="mb-4">
                                                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h5><button type="submit" class="btn btn-success waves-effect waves-light">Envoyer le formulaire</button></h5>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="#">P&eacute;c&eacute;dent</a></li>
                                                    <li class="next"><a href="#">Suivant</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div> <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

 @endsection

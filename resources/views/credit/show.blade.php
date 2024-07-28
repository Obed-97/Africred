@section('title', 'Contat de prêt')

@extends('master')

@section('content')

<div class="main-content">
   
    <div class="page-content">
        <div class="container-fluid">
        <div class="row" >
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="col-xl-2"><a href="{{URL::previous()}}" class="btn  btn-primary waves-effect waves-light"><i class="ri-arrow-go-back-fill"></i></a></div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0" id="web">
                           
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        
        <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-5 ">
                    <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="75">
                </div>
                
            </div>
            <div class="text-center mt-2 ">
                <H3 class="mb-4"><b>FICHE D'IDENTIFICATION</b> </H3>
                <img src="/assets/images/users/{{$credit->Client['image']}}" alt="" class="rounded avatar-lg">
            </div>
            

            <div class="row mt-4">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <H5 class="mb-4 text-center"><b> I - Informations personnelles du client</b> </H5>
                    <table  class="table border dt-responsive nowrap " style = "color: black;" >
                        <tr>
                            <td>* Nom complet </td>
                            <td style = "text-transform:uppercase;" >{{$credit->Client['nom_prenom']}}</td>
                        </tr>
                        <tr>
                            <td>* Date de naissance </td>
                            <td> {{(new DateTime($credit->Client["date_n"]))->format('d-m-Y')}}</td>
                        </tr>
                       
                        <tr>
                            <td>* Sexe</td>
                            <td style = "text-transform:uppercase;">{{$credit->sexe}} </td>
                        </tr>
                        <tr>
                            <td>* Adresse actuelle </td>
                            <td style = "text-transform:uppercase;">{{$credit->adresse}} </td>
                        </tr>
                        <tr>
                            <td>* Numéro de téléphone </td>
                            <td style = "text-transform:uppercase;">{{$credit->telephone}} </td>
                        </tr>
                        <tr>
                            <td>* Situation de famille </td>
                            <td style = "text-transform:uppercase;">{{$credit->situation_familiale}} </td>
                        </tr>
                        <tr>
                            <td>* Nombre d'enfants </td>
                            <td style = "text-transform:uppercase;">{{$credit->nbre_enfant}} enfant(s) </td>
                        </tr>
                        <tr>
                            <td>* Nombre de femmes </td>
                            <td style = "text-transform:uppercase;">{{$credit->nbre_enfant}} femme(s) </td>
                        </tr>
                        
                    </table>
                   
                </div>
                <div class="col-md-5">
                    <H5 class="mb-4 text-center"><b>II - Informations sur l'entreprise / Activité</b> </H5>
                    <table  class="table border dt-responsive nowrap " style = "color: black;" >
                        <tr>
                            <td>* Nom de l'entreprise </td>
                            <td style = "text-transform:uppercase;">{{$credit->nom_entreprise}} </td>
                        </tr>
                        <tr>
                            <td>* Type d'activité </td>
                            <td style = "text-transform:uppercase;">{{$credit->type_activite}} </td>
                        </tr>
                       
                        <tr>
                            <td>* Date de création</td> 
                            <td> {{(new DateTime($credit->date_entreprise))->format('d-m-Y')}}</td>
                        </tr>
                        <tr>
                            <td>* Structure juridique </td>
                            <td style = "text-transform:uppercase;">{{$credit->structure}} </td>
                        </tr>
                        <tr>
                            <td>* Adresse de l'entreprise </td>
                            <td style = "text-transform:uppercase;">{{$credit->adresse_entreprise}} </td>
                        </tr>
                        <tr>
                            <td>* Numéro RCCM </td>
                            <td style = "text-transform:uppercase;">{{$credit->rccm}} </td>
                        </tr>
                        <tr>
                            <td>* Années d'expérience </td>
                            <td style = "text-transform:uppercase;">{{$credit->annee_experience}} an(s) </td>
                        </tr>
                        <tr>
                            <td>* Description des produits </td>
                            <td style = "text-transform:uppercase;">{{$credit->description_produit}} </td>
                        </tr>
                    </table>
                   
                </div>
            </div>

            <div class="row mt-4 mb-4">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <H5 class="mb-4 text-center"><b>III - Informations financières</b> </H5>
                    <table  class="table border dt-responsive nowrap " style = "color: black;" >
                        <tr>
                            <td>* Prêt demandé</td>
                            <td>{{number_format($credit->montant, 0, ',', ' ')}} CFA</td>
                        </tr>
                        <tr>
                            <td>* Revenu mensuel brut</td>
                            <td>{{number_format($credit->revenu_brut, 0, ',', ' ')}} CFA</td>
                        </tr>
                        <tr>
                            <td>* Revenu mensuel net </td>
                            <td>{{number_format($credit->revenu_net, 0, ',', ' ')}} CFA</td>
                        </tr>
                       
                        <tr>
                            <td>* Autres sources de revenu </td>
                            <td style = "text-transform:uppercase;">{{$credit->autre_source}} </td>
                        </tr>
                       
                        <tr>
                            <td>* Dettes existantes </td>
                            <td style = "text-transform:uppercase;">{{$credit->dettes_existantes}} </td>
                        </tr>
                        <tr>
                            <td>* Valeur des actifs </td>
                            <td style = "text-transform:uppercase;">{{$credit->valeur_actif}} </td>
                        </tr>
                        
                    </table>
                   
                </div>
                <div class="col-md-5">
                    <H5 class="mb-4 text-center"><b>IV - Autres informations</b> </H5>
                    <table  class="table border dt-responsive nowrap " style = "color: black;" >
                        <tr>
                            <td>* Marché</td>
                            <td style = "text-transform:uppercase;">{{$credit->Marche["libelle"]}} </td>
                        </tr>
                        <tr>
                            <td>* Durée souhaitée</td>
                            <td style = "text-transform:uppercase;">{{$credit->duree_souhaitee}} jours </td>
                        </tr>
                        <tr>
                            <td>* Utilisation prévue des fonds</td>
                            <td style = "text-transform:uppercase;">{{$credit->utilisation_fonds}} </td>
                        </tr>
                       
                        <tr>
                            <td>* Plan de remboursement</td>
                            <td style = "text-transform:uppercase;">{{$credit->plan_remboursement}} </td>
                        </tr>
                        <tr>
                            <td>* Projet immobilier</td>
                            <td style = "text-transform:uppercase;">{{$credit->projet_immobilier}} </td>
                        </tr>
                        
                    </table>
                   
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-md-2"></div>
                <H5 class="mt-4 "><b class="text-danger"> NOTE : </b> <i>{{$credit->note}}</i></H5> 
            </div>
        
        </div>

       
        {{-- Contrat de prêt --}}
        <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-5 ">
                    <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="75">
                </div>
                
            </div>
            <div class="text-center mt-2 ">
                <H4><b>CEC-BS-PRODUIT-ABEYAN-FINANCE </b> </H4>
                <p>Agr&eacute;&eacute;e suivant D&eacute;cision N°0100075 MEF-SG du 20 Juillet 2001 <br>
                Bamako - Mali <br>
                Adresse : Kanadjiguila <br>
                T&eacute;l : 20 20 05 66 / 83 88 88 04 / 61 53 53 56</p>
            </div>
            <div class="text-center mt-2 mb-2">
                <H4><u><b>CONTRAT DE PR&Ecirc;T ET DE RECONNAISSANCE DE DETTE ABEYAN FOU </b></u> </H4>
            </div>

            <div class="row mt-4">
                <div class="col-1">
                
                    
                </div>
                <div class="col-1">
                <img src="/assets/images/users/{{$credit->Client['image']}}" alt="" class="rounded avatar-lg">
                    
                </div>
                <div class="col-md-5">
                    <ul style="text-align: justify; font-size: 20px">
                        <li style="list-style-type: none;">
                            <h6>Pr&eacute;nom & Nom : <b style = "text-transform:uppercase;"> {{$credit->Client['nom_prenom']}}</b></h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6>Membre de la caisse depuis : <b style = "text-transform:uppercase;"> {{(new DateTime($credit->Client['created_at']))->format('M-Y')}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6>Lieu de r&eacute;sidence : <b style = "text-transform:uppercase;">{{$credit->Client['adresse']}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>Profession : <b style = "text-transform:uppercase;">{{$credit->Client['activite']}}</b></h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>Objet de pr&ecirc;t : <b style = "text-transform:uppercase;">{{$credit->motif}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>March&eacute; : <b style = "text-transform:uppercase;"> {{$credit->Marche['libelle']}}</b> </h6>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-4">
                    <table  class="table border dt-responsive nowrap " style = "color: black;" >
                        <tr>
                            <td>Date de demande </td>
                            <td>{{(new DateTime($credit->created_at))->format('d-m-Y')}}</td>
                        </tr>
                        <tr>
                            <td>N° de compte </td>
                            <td>ABF-{{$credit->Client['id']}}  </td>
                        </tr>
                    
                        <tr>
                            <td>N° de pr&ecirc;t </td>
                            <td>{{$credit->id}} </td>
                        </tr>
                        <tr>
                            <td>Renouvellement </td>
                            <td>{{$credits}} fois </td>
                        </tr>
                        <tr>
                            <td>Date du pr&ecirc;t </td>
                            <td>{{(new DateTime($credit->date_deblocage))->format('d-m-Y')}} </td>
                        </tr>
                        <tr>
                            <td>Date d'&eacute;cheance </td>
                            <td>{{(new DateTime($credit->date_fin))->format('d-m-Y')}} </td>
                        </tr>
                        <tr>
                            <td>Taux d'int&eacute;r&ecirc;t </td>
                            @if(($credit->interet/$credit->montant) == 0.2)
                            <td> 20% </td>
                            @elseif(($credit->interet/$credit->montant) == 0.18)
                            <td> 18% </td>
                            @elseif(($credit->interet/$credit->montant) == 0.15)
                            <td> 15% </td>
                            @elseif(($credit->interet/$credit->montant) == 0.1)
                            <td> 10% </td>
                            @elseif(($credit->interet/$credit->montant) == 0.05)
                            <td> 5% </td>
                            @endif
                        </tr>
                    </table>
                
                </div>
            </div>
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="table border dt-responsive nowrap" style = "color: black;" >
                        <thead>
                            <tr>
                                <th>Montant du pr&ecirc;t</th>
                                <th>Dur&eacute;e du pr&ecirc;t</th>
                                <th>Int&eacute;r&ecirc;t &agrave; payer</th>
                                <th>Total encours</th>
                                <th>Frais de carte</th>
                                <th>Frais de d&eacute;blocage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{number_format($credit->montant, 0, ',', ' ')}} CFA</td>
                                @if(($credit->date_deblocage) < ($credit->date_fin))
                                <td >{{$credit->nbre_jrs}} jours</td>
                            @else
                                <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                            @endif
                            <td>{{number_format($credit->interet, 0, ',', ' ')}} CFA</td>
                            <td>{{number_format($credit->montant_interet, 0, ',', ' ')}} CFA</td>
                            <td>{{number_format($credit->frais_carte, 0, ',', ' ')}} CFA</td>
                            <td>{{number_format($credit->frais_deblocage, 0, ',', ' ')}} CFA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="row mt-4">  
            <div class="col-1"></div>
            <div class="col-md-10">
                <p style="text-align: justify; font-size: 17px">
                    Je soussign&eacute; @if($credit->Client['sexe'] == 'Masculin') M. @else Mme @endif <b style = "text-transform:uppercase;"> {{$credit->Client['nom_prenom']}}</b>  atteste avoir re&ccedil;u la somme de <b style = "text-transform:uppercase;">{{number_format($credit->montant, 0, ',', ' ')}} CFA </b> de la part de l'institution AB-FINANCE
                    Agr&eacute;&eacute;e suivant D&eacute;cision N°0100075 MEF-SG du 20 Juillet 2001 Bamako-Mali.
                    Et je m'engage &agrave; rembourser avec int&eacute;r&ecirc;ts dans un d&eacute;lai de <b style = "text-transform:uppercase;"> @if(($credit->date_deblocage) < ($credit->date_fin))
                        {{$credit->nbre_jrs}}  jours.
                    @endif </b>  <br><br>
                    En foi de quoi je signe ce pr&eacute;sent pour servir et valoir ce que de droit. <br>
                    Fait &agrave; Bamako le <b>{{(new DateTime($credit->date_deblocage))->format('d-m-Y')}}</b>
                </p>
            </div>
        </div>
        
        <div class="row ml-2 mt-2 mb-3">
            <div class="col-1"></div>
            <div class="col-md-4 mb-2">
            <h5><b><u>AFRICRED</u></b></h5>
            <img src="{{asset('assets/images/Signature de Obed.png')}}" alt="" height="75">
            </div>
            <div class="col-md-3 mb-5">
            
            </div>
            <div class="col-md-2 mb-5">
                <h5> <b><u>Client(e)</u></b></h5> 
            </div>
            <div class="col-md-2 mb-5">
                <h5> <b><u>Caution</u></b></h5> 
            </div>
        </div>

        
</div>
<div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
    <div class="row mt-4 mb-4">
        <div class="col-1"></div>
        <div class="col-md-5 ">
            <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="75">
        </div>
        
    </div>
    <div class="text-center mt-2 ">
        <H3 class="mb-4"><b>REÇU D'ENCAISSEMENT DES FRAIS</b> </H3>
        
    </div>
    

    <div class="row mt-4">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            
            <table  class="table border dt-responsive nowrap " style = "color: black;" >
                <tr>
                    <td>FRAIS D'OUVERTURE DE COMPTE </td>
                    <td style = "text-transform:uppercase;" >N/A</td>
                </tr>
                <tr>
                    <td>FRAIS DE DÉBLOCAGE</td>
                    <td> {{number_format($credit->frais_deblocage, 0, ',', ' ')}} CFA</td>
                </tr>
               
                <tr>
                    <td>FRAIS DE CARTE</td>
                    <td style = "text-transform:uppercase;">{{number_format($credit->frais_carte, 0, ',', ' ')}} CFA</td>
                </tr>
                <tr>
                    <td>ASSURANCE CIF</td>
                    <td style = "text-transform:uppercase;">N/A</td>
                </tr>
                <tr>
                    <td>ASSURANCE PLUS</td>
                    <td style = "text-transform:uppercase;">N/A</td>
                </tr>
                <tr>
                    <td>FRAIS FERMETURE DE COMPTE</td>
                    <td style = "text-transform:uppercase;">N/A </td>
                </tr>
                
                
            </table>
           
        </div>
       
    </div>


    <div class="row mt-4 mb-4">
        <div class="col-md-2"></div>
        <H5 class="mt-4 "><b class="text-success"> TOTAL : </b> <i>{{number_format($credit->frais_deblocage + $credit->frais_carte, 0, ',', ' ')}} CFA</i></H5> 
    </div>

</div>

</div>
</div>


@endsection
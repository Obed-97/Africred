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
                    <img src="{{asset('assets/images/AB-FINANCE.png')}}">
                </div>
                
            </div>
            <div class="text-center mt-4 ">
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
                    Et je m'engage &agrave; rembourser avec int&eacute;r&ecirc;t dans un d&eacute;lai de <b style = "text-transform:uppercase;"> @if(($credit->date_deblocage) < ($credit->date_fin))
                        {{$credit->nbre_jrs}}  jours
                    @endif </b>  avec assurance. <br><br>
                    En foi de quoi je signe ce pr&eacute;sent pour servir et valoir ce que de droit. <br>
                    Fait &agrave; Bamako le <b>{{(new DateTime($credit->date_deblocage))->format('d-m-Y')}}</b>
                </p>
            </div>
        </div>
        
        <div class="row ml-2 mt-4 mb-3">
            <div class="col-1"></div>
            <div class="col-md-2 mb-5">
            <h5><b><u>GESTIONNAIRE</u></b></h5>
            <img src="{{asset('assets/images/siganture.png')}}" width="135" height="135">
            </div>
            <div class="col-md-6 mb-5">
            <h5><b><u>CONTRÔLEUR</u></b></h5>
            <img src="{{asset('assets/images/controleur.png')}}" width="150" height="150">
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u>Client(e)</u></b></h5> 
            </div>
        </div>
       
       
        
        <div class="row ml-2 ">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u></u></b></h5> 
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u> </u></b></h5> 
            </div>
        </div>
        
        <div class="mt-2"></div>
        <div class="text-center mt-4 ">
           
            <p style="font-size: 12px; color: black">CECB NoA2/01.0459 <br>
            Adresse : Faladj&egrave; SEMA, AVENUE OUA Porte <br>
            Site web : finance.abeyan.com // 20 20 05 66 / 71 39 39 27 / 61 37 37 76</p>
        </div>
    </div>

        
</div>
</div>
</div>


@endsection
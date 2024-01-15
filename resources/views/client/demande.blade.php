@section('title', 'Demande d\'adhésion')

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
                <H4><u><b>FICHE DE DEMANDE D'ADHÉSION D'UN MEMBRE</b></u> </H4>
            </div>
            
             <div class="row mt-4">
               <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p style="text-align: justify; font-size: 16px">
                    Ayant pris pleinement connaissance des activités et du règlement intérieur de l’institution financière &nbsp; &nbsp; « CEC-BENSO-PRODUIT-ABEYAN-FINANCE », je désire en devenir membre pour l’année {{(new DateTime($info->created_at))->format('Y')}}
                    </p>
                </div>
                
            </div>

            <div class="row mt-4">
               <div class="col-md-2"></div>
                <div class="col-md-8">
                    <ul style="text-align: justify; font-size: 20px">
                        <li style="list-style-type: none;">
                            <h6 class="mb-4">Pr&eacute;nom & Nom : <b style = "text-transform:uppercase;">{{$info->nom_prenom}} </b></h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6 class="mb-4">Adresse :
                                <b style = "text-transform:uppercase;">
                                    @if($info->adresse == NULL)
                                     {{$info->Marche['libelle']}}
                                    @else
                                     {{$info->adresse}}
                                    @endif
                                </b>
                            </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6 class="mb-4">Ville : <b style = "text-transform:uppercase;">{{$info->ville}} </b></h6>
                        </li>
                        
                        <li style="list-style-type: none;" >
                            <h6 class="mb-4">Téléphone : <b style = "text-transform:uppercase;"> {{$info->telephone}}</b></h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6 class="mb-4">Date et lieu de naissance : 
                                <b style = "text-transform:uppercase;">
                                    @if($info->date_n == NULL && $info->lieu_n == NULL )
                                     ...................
                                    @else
                                     {{(new DateTime($info->date_n))->format('d-m-Y')}} &nbsp; à  &nbsp; {{$info->lieu_n}}
                                    @endif
                                    
                                </b>
                            </h6>
                        </li>
                        
                        
                    </ul>
                </div>
                
            </div>
            <div class="row mt-4">
               <div class="col-md-2"></div>
                <div class="col-md-8">
                   <p style="text-align: justify; font-size: 16px">
                        <b style="color: black">Je souhaite adhérer à l’institution financière « CEC-BENSO-PRODUIT-ABEYAN-FINANCE » dont la cotisation annuelle est fixée à 6.000Fcfa selon le statut de l’institution.</b><br>
                        Montant versé pour la cotisation :……………<br>
                        Reliquat de la cotisation :………....<br>
                        Les demandes d’adhésion sont remplies auprès de nos agents ou à notre siège, les cotisations sont payées moyennant un reçu.
                   </p>

                </div>
               
            </div>
           
        
        <div class="row ml-2 mt-4 mb-5">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u>Client(e)</u></b></h5> 
            </div>
        </div>
       
       
        
        <div class="row ml-2 mb-5">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u></u></b></h5> 
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u> </u></b></h5> 
            </div>
        </div>
        <div class="row ml-2 mb-5">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u></u></b></h5> 
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u> </u></b></h5> 
            </div>
        </div>
        
        <div class="mt-5"></div>
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
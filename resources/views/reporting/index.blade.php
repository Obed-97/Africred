<!DOCTYPE html>

<html>

<head>
        
    <meta charset="utf-8" />
    <title>AFRICRED | RAPPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    
    <style>
        .tables{
          border: 1px solid black;
          border-collapse: collapse;
          border-spacing: 30px;
        }
       
        
        .thead, th, td {
          padding-top: 10px;
          padding-bottom: 20px;
          padding-left: 10px;
          padding-right: 20px;
          
          border: 1px solid black;
          border-collapse: collapse;
          border-spacing: 30px;
          
        }
        
      
        .input{
            border:0;
            border-color: transparent;
            
        }
        
        .ligne{
            line-height: 23px;
            word-spacing: 2px;
        }
        
        .first{
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
           
        }
        
    
        
        
        
        
    </style>
    

</head>

<body data-keep-enlarged="true" class="vertical-collpsed">
        <!-- Loader -->
        <div id="web">
            <div id="preloader">
                <div id="status">
                    <div class="spinner">
                        <i class="ri-loader-line spin-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.header')

		@include('layouts.left_sidebar')
		
         

<div class="main-content">
    @php
        $sum_montant = 0;
        
        foreach($montant as $m){
            $sum_montant = $m->montant + $sum_montant ;
            
        }
        
        $sum_montants = 0;
        
        foreach($montants as $ms){
            $sum_montants = $ms->montant + $sum_montants ;
            
        }
        
        if($trimestre != 'TRIMESTRE 4'){
        
            $sum_montantss = 0;
        
            foreach($montantss as $mss){
                $sum_montantss = $mss->montant + $sum_montantss ;
                
            }
        }
        
    @endphp
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
        <div class="container mt-3 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('assets/images/logo-benso.png')}}">
                </div>
                
                <div class="col-md-7 mt-2 ">
                   <H6 class="text-center">CAISSE D’ÉPARGNE ET DE CRÉDIT RECA DONKASIGUI DE BENSO <br><br>
                        Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali
                    </H6>
                </div>
                
            </div>
            
            <div class="row mb-4">
                <div class="col-1"></div>
                
                
                <div class="col-md-10 mt-5 ">
                  <H6 class="ligne"><b> CEC-BENSO N°0100075 MEF-SG DU 20 JUILLET 2001 <br><br>
                DONNÉES DU MOIS
                @if($trimestre == 'TRIMESTRE 1')
                DE JANVIER, FÉVRIER ET MARS  
                @elseif($trimestre == 'TRIMESTRE 2')
                D'AVRIL, MAI ET JUIN
                @elseif($trimestre == 'TRIMESTRE 3')
                DE JUILLET, AOÛT ET SEPTEMBRE
                @elseif($trimestre == 'TRIMESTRE 4')
                D'OCTOBRE, NOVEMBRE ET DÉCEMBRE
                @endif
               
                DU RAPPORT À FOURNIR AUX AUTORITÉS DE TUTELLE À LA DATE DU  {{(new DateTime($date_fin))->format('d/m/Y')}}<br><br>
                
                1-DONNÉES GÉNÉRALES
                </b> </H6>

                </div>
                
            </div>
            
           
           <div class="row">
            <div class="col-1"></div>
            <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                <h6 class="mt-2 ligne"><b>INDICATEURS DU {{(new DateTime($date_debut))->format('d/m/Y')}} AU {{(new DateTime($date_fin))->format('d/m/Y')}} </b></h6><br>
                <h6><b>Tableau n°1 : Nombre de membres, b&eacute;n&eacute;ficiaires ou clients (unit&eacute;s)</b> </h6>
            </div>
           </div>
            
            
           

            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive nowrap w-100  text-black" style="font-size: 17px;" >
                        <thead class="thead-light ">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1" >Trimestre<br> (T-1)</th>
                                <th colspan="1" >Trimestre<br> (T)</th>
                                <th colspan="1" >Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3" >Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                               
                                <td colspan="3" >
                                    Nombre total de membres, b&eacute;n&eacute;ficiaires ou clients <br>
                                    Les groupements sont comptés sur base unitaire (1)+(2)
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$clients->count() - $clientss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$clients->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((($clients->count() - ($clients->count() - $clientss->count()))/($clients->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$clients->count() - $clientss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$clients->count() - $clientsss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($clients->count() - $clientsss->count()) -($clients->count() - $clientss->count()))/($clients->count() - $clientsss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de personnes physiques non membre d'un <br> 
                                    Groupement (1) = (a)+(b) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$physiques->count() - $physiquess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$physiques->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($physiques->count()) - ($physiques->count() - $physiquess->count())) / ($physiques->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$physiques->count() - $physiquess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$physiques->count() - $physiquesss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($physiques->count() - $physiquesss->count()) - ($physiques->count() - $physiquess->count())) / ($physiques->count() - $physiquesss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                              
                                @endif
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">
                                    . Hommes (a) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$hommes->count() - $hommess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$hommes->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($hommes->count() ) -($hommes->count() - $hommess->count()))/($hommes->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$hommes->count() - $hommess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$hommes->count() - $hommesss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($hommes->count() - $hommesss->count()) -($hommes->count() - $hommess->count()))/($hommes->count() - $hommesss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
           
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">
                                    . Femmes (b) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$femmes->count() - $femmess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$femmes->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($femmes->count()) -($femmes->count() - $femmess->count()))/($femmes->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$femmes->count() - $femmess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$femmes->count() - $femmesss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($femmes->count() - $femmesss->count()) -($femmes->count() - $femmess->count()))/($femmes->count() - $femmesss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de personnes morales <br> 
                                    (groupement de personnes physiques, entreprises, associations etc.) (2) <br>
                                   
                                </td>
                                
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$morales->count() - $moraless->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$morales->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($morales->count() ) -($morales->count() - $moraless->count()))/($morales->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                               
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$morales->count() - $moraless->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$morales->count() - $moralesss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($morales->count() - $moralesss->count()) -($morales->count() - $moraless->count()))/($morales->count() - $moralesss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de groupement de personnes physiques bénéficaires
                                   
                                </td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre total des membres de groupements des personnes physiques bénéficaires (3) = (c)+(d)
                                   
                                </td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">
                                    . Hommes (c) <br>
                                   
                                </td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">
                                    . Femmes (d) <br>
                                   
                                </td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
            
            
            
        
        
        <div class="text-center">
           
            <p style="font-size: 12px; color: black">Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali<br>
                                                                        Siège social à Kanadjiguila //20-20-05-66/83-88-88-04
                                                                        </p>
        </div>
    </div>
        
    <!--================================================================================================================================    -->
    
    
    <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-3 mb-4">
                <div class="col-1"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('assets/images/logo-benso.png')}}">
                </div>
                
                <div class="col-md-7 mt-2 ">
                   <H6 class="text-center">CAISSE D’ÉPARGNE ET DE CRÉDIT RECA DONKASIGUI DE BENSO <br><br>
                        Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali
                    </H6>
                </div>
                
            </div>
           <div class="row">
            <div class="col-1"></div>
            <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                <h6 class="mt-2"><b>Tableau n°2 : Effectif des dirigeants et du personnel employé (en unit&eacute;)</b> </h6>
            </div>
           </div>
            
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Nombre de membres du CA ou de l'organe équivalent</td>
                                
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($cas->count()) - ($cas->count() - $cass->count()))/($cas->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($ca->count() - $cass->count()) -($ca->count() - $cas->count()))/($ca->count() - $cass->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre de membres de conseil de surveillance</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$surveillants->count() - $surveillantss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$surveillants->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($surveillants->count()) - ($surveillants->count() - $surveillantss->count()))/($surveillants->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                               
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$surveillant->count() - $surveillants->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$surveillant->count() - $surveillantss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($surveillant->count() - $surveillantss->count()) -($surveillant->count() - $surveillants->count()))/($surveillant->count() - $surveillantss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre de membres du comité de crédit</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre de membres des autres comités créer par le SFD</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Effectif total des employés</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$employes->count() - $employess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$employes->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($employes->count()) - ($employes->count() - $employess->count()))/($employes->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                         
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$employe->count() - $employes->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$employe->count() - $employess->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($employe->count() - $employess->count()) -($employe->count() - $employes->count()))/($employe->count() - $employess->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Dirigeants (fonction de direction ou gérance) dont (1)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($cas->count()) - ($cas->count() - $cass->count()))/($cas->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($ca->count() - $cass->count()) -($ca->count() - $cas->count()))/($ca->count() - $cass->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">- Nationaux</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($cas->count()) - ($cas->count() - $cass->count()))/($cas->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cas->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$ca->count() - $cass->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($ca->count() - $cass->count()) -($ca->count() - $cas->count()))/($ca->count() - $cass->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">- Personnel expatrié</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Autres employés (2) = a+b+c</td>
                                
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agents->count() - $agentss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agents->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($agents->count()) - ($agents->count() - $agentss->count()))/($agents->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agent->count() - $agents->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agent->count() - $agentss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($agent->count() - $agentss->count()) -($agent->count() - $agents->count()))/($agent->count() - $agentss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Agents permanents (a)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agents->count() - $agentss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agents->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($agents->count()) - ($agents->count() - $agentss->count()))/($agents->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agent->count() - $agents->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$agent->count() - $agentss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($agent->count() - $agentss->count()) -($agent->count() - $agents->count()))/($agent->count() - $agentss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                             
                                
                                @endif
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Agents contractuels (b)</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Personnel expatrié (c)</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>   
                            
                        </tbody>
                        
                    </table>
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
           
            <p style="font-size: 12px; color: black">Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali<br>
                                                                        Siège social à Kanadjiguila //20-20-05-66/83-88-88-04
                                                                        </p>
        </div>
    </div>
    
     <!--================================================================================================================================    -->
     
     
    <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-3 mb-4">
                <div class="col-1"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('assets/images/logo-benso.png')}}">
                </div>
                
                <div class="col-md-7 mt-2 ">
                   <H6 class="text-center">CAISSE D’ÉPARGNE ET DE CRÉDIT RECA DONKASIGUI DE BENSO <br><br>
                        Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali
                    </H6>
                </div>
                
            </div>
         
            <div class="row">
            <div class="col-1"></div>
            <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                <h6 class="mt-2"><b>Tableau n°3 : Nombre de déposants</b> </h6>
            </div>
           </div>
            
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black mb-3" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Nombre total de déposants (1) + (2)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot->count() - $depots->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot->count()) - ($depot->count() - $depots->count()))/($depot->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot->count() - $depots->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot->count() - $depotss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot->count() - $depotss->count()) -($depot->count() - $depots->count()))/($depot->count() - $depotss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif  
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de déposants personnes physiques non membre d'un
                                    groupement (1) = (a)+(b)
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_p->count() - $depot_ps->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_p->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_p->count()) - ($depot_p->count() - $depot_ps->count()))/($depot_p->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_p->count() - $depot_ps->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_p->count() - $depot_pss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_p->count() - $depot_pss->count()) -($depot_p->count() - $depot_ps->count()))/($depot_p->count() - $depot_pss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif  
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Hommes (a)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_h->count() - $depot_hs->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_h->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_h->count()) - ($depot_h->count() - $depot_hs->count()))/($depot_h->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_h->count() - $depot_hs->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_h->count() - $depot_hss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_h->count() - $depot_hss->count()) -($depot_h->count() - $depot_hs->count()))/($depot_h->count() - $depot_hss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif  
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Femmes (b)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_f->count() - $depot_fs->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_f->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_f->count()) - ($depot_f->count() - $depot_fs->count()))/($depot_f->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_f->count() - $depot_fs->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_f->count() - $depot_fss->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_f->count() - $depot_fss->count()) -($depot_f->count() - $depot_fs->count()))/($depot_f->count() - $depot_fss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif  
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de déposants personnes morales  
                                    (groupement de personnes physiques, entreprises, associations etc.) (2) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_m->count() - $depot_ms->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_m->count()}}" style="text-align:center; color:#696969;"></td>
                                
                                @if($depot_m->count() == 0)
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                @else
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_m->count()) - ($depot_m->count() - $depot_ms->count()))/($depot_m->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                @endif
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_m->count() - $depot_ms->count()}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{$depot_m->count() - $depot_mss->count()}}" style="text-align:center; color:#696969;"></td>
                                @if(($depot_m->count() - $depot_mss->count()) == 0)
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                @else
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format((((($depot_m->count() - $depot_mss->count()) -($depot_m->count() - $depot_ms->count()))/($depot_m->count() - $depot_mss->count())) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                @endif
                               
                               
                               
                                
                                @endif  
                               
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                    <h6 class="mt-2"><b>Tableau n°4 : Nombre de crédits en cours</b> </h6>
                </div>
           </div>

            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Nombre de crédits encours (1) + (2)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit) - count($credits)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit)) - (count($credit) - count($credits)))/(count($credit))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit) - count($credits)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit) - count($creditss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit) - count($creditss)) -(count($credit) - count($credits)))/(count($credit) - count($creditss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif     
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de crédits encours sur les personnes physiques non membre d'un
                                    groupement (1) = (a)+(b)
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_p) - count($credit_ps)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_p)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_p)) - (count($credit_p) - count($credit_ps)))/(count($credit_p))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_p) - count($credit_ps)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_p) - count($credit_pss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_p) - count($credit_pss)) -(count($credit_p) - count($credit_ps)))/(count($credit_p) - count($credit_pss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif    
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Nombre de crédits encours sur les hommes (a)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_h) - count($credit_hs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_h)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_h)) - (count($credit_h) - count($credit_hs)))/(count($credit_h))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_h) - count($credit_hs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_h) - count($credit_hss)}}" style="text-align:center; color:#696969;"></td>
                               <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_h) - count($credit_hss)) -(count($credit_h) - count($credit_hs)))/(count($credit_h) - count($credit_hss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                @endif   
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Nombre de crédits encours sur les femmes (b)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_f) - count($credit_fs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_f)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_f)) - (count($credit_f) - count($credit_fs)))/(count($credit_f))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_f) - count($credit_fs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_f) - count($credit_fss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_f) - count($credit_fss)) -(count($credit_f) - count($credit_fs)))/(count($credit_f) - count($credit_fss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif    
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de crédits encours sur les personnes morales 
                                    (groupement de personnes physiques, entreprises, associations etc.) (2) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_m) - count($credit_ms)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_m)}}" style="text-align:center; color:#696969;"></td>
                                
                                    @if(count($credit_m) == 0)
                                    <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                    @else
                                    <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_m)) - (count($credit_m) - count($credit_ms)))/(count($credit_m))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                    @endif
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_m) - count($credit_ms)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_m) - count($credit_mss)}}" style="text-align:center; color:#696969;"></td>
                                @if((count($credit_m) - count($credit_mss)) == 0)
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                @else
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_m) - count($credit_mss)) -(count($credit_m) - count($credit_ms)))/(count($credit_m) - count($credit_mss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                @endif
                                
                                @endif    
                               
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div> 
         
        
            
      
        <div class="mt-2"></div>
        <div class="text-center mt-4 ">
           
            <p style="font-size: 12px; color: black">Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali<br>
                                                                        Siège social à Kanadjiguila //20-20-05-66/83-88-88-04
                                                                        </p>
        </div>
    </div>
    
    <!--==================================================================================================================-->
    
    
    <div class="container mt-3 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('assets/images/logo-benso.png')}}">
                </div>
                
                <div class="col-md-7 mt-2 ">
                   <H6 class="text-center">CAISSE D’ÉPARGNE ET DE CRÉDIT RECA DONKASIGUI DE BENSO <br><br>
                        Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali
                    </H6>
                </div>
                
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                    <h6 class="mt-2"><b>Tableau n°5 : Répartition des crédits selon leur objet (en millier de FCFA)</b> </h6>
                </div>
           </div>
          
            
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black mb-3" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Crédits immobiliers</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Crédits équipements</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" >Crédits à la consommation</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" >Crédits de trésorerie</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="{{number_format($sum_montant - $sum_montants , 0, ',', ' ')}} CFA" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="{{number_format($sum_montant , 0, ',', ' ')}} CFA" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="{{number_format($sum_montant - $sum_montants , 0, ',', ' ')}} CFA" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="{{number_format($sum_montant - $sum_montantss , 0, ',', ' ')}} CFA" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((($sum_montant - $sum_montantss)-($sum_montant - $sum_montants))/($sum_montant - $sum_montantss))*100 , 0, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif   
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Autres crédits</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="12" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                    <h6 class="mt-2"><b>Tableau n°6 : Nombre de crédits en soufrance</b> </h6>
                </div>
           </div>
            
            
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Nombre de crédits en souffrance (1) + (2)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_r) - count($credit_rs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_r)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_r)) - (count($credit_r) - count($credit_rs)))/(count($credit_r))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_r) - count($credit_rs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_r) - count($credit_rss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_r) - count($credit_rss)) -(count($credit_r) - count($credit_rs)))/(count($credit_r) - count($credit_rss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif   
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de crédits en souffrance sur les personnes physiques non membre d'un
                                    groupement (1) = (a)+(b)
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rp) - count($credit_rps)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rp)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rp)) - (count($credit_rp) - count($credit_rps)))/(count($credit_rp))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rp) - count($credit_rps)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rp) - count($credit_rpss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rp) - count($credit_rpss)) -(count($credit_rp) - count($credit_rps)))/(count($credit_rp) - count($credit_rpss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif 
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Nombre de crédits en souffrance sur les hommes (a)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rh) - count($credit_rhs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rh)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rh)) - (count($credit_rh) - count($credit_rhs)))/(count($credit_rh))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rh) - count($credit_rhs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rh) - count($credit_rhss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rh) - count($credit_rhss)) -(count($credit_rh) - count($credit_rhs)))/(count($credit_rh) - count($credit_rhss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif 
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" class="text-center">. Nombre de crédits en souffrance sur les femmes (b)</td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rf) - count($credit_rfs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rf)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rf)) - (count($credit_rf) - count($credit_rfs)))/(count($credit_rf))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rf) - count($credit_rfs)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rf) - count($credit_rfss)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rf) - count($credit_rfss)) -(count($credit_rf) - count($credit_rfs)))/(count($credit_rf) - count($credit_rfss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                
                                
                                @endif 
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">
                                    Nombre de crédits en souffrance sur les personnes morales 
                                    (groupement de personnes physiques, entreprises, associations etc.) (2) <br>
                                   
                                </td>
                                @if($trimestre == 'TRIMESTRE 4')
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rm) - count($credit_rms)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rm)}}" style="text-align:center; color:#696969;"></td>
                                
                                    @if(count($credit_rm) == 0)
                                    <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                    @else
                                    <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rm)) - (count($credit_rm) - count($credit_rms)))/(count($credit_rm))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                    @endif
                                
                                
                                @else
                                
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rm) - count($credit_rms)}}" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="{{count($credit_rm) - count($credit_rmss)}}" style="text-align:center; color:#696969;"></td>
                                @if((count($credit_rm) - count($credit_rmss)) == 0)
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                                @else
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="{{number_format(((((count($credit_rm) - count($credit_rmss)) -(count($credit_rm) - count($credit_rms)))/(count($credit_rm) - count($credit_rmss))) * 100), 2, ',', ' ')}} %" style="text-align:center; color:#696969;"></td>
                                @endif
                                
                                @endif  
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            
      
       
        
        <div class="mt-2"></div>
        <div class="text-center mt-4 ">
           
            <p style="font-size: 12px; color: black">Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali<br>
                                                                        Siège social à Kanadjiguila //20-20-05-66/83-88-88-04
                                                                        </p>
        </div>
    </div>
    
     <!--==================================================================================================================-->
    
    
    <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
           <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-2 ">
                    <img src="{{asset('assets/images/logo-benso.png')}}">
                </div>
                
                <div class="col-md-7 mt-5 ">
                   <H6 class="text-center">CAISSE D’ÉPARGNE ET DE CRÉDIT RECA DONKASIGUI DE BENSO <br><br>
                        Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali
                    </H6>
                </div>
                
            </div>
         
           <div class="row">
                <div class="col-1"></div>
                <div class="col-md-10 text-center mt-2 mb-2" style="background-color: gray;">
                    <h6 class="mt-2"><b>Tableau n°7 : Indicateurs sur la surveillance</b> </h6>
                </div>
           </div>
            
            <div class="row mt-4 mb-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black mb-2" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="3" class="first"></th>
                                <th colspan="1">Trimestre<br> (T-1)</th>
                                <th colspan="1">Trimestre<br> (T)</th>
                                <th colspan="1">Variation<br> (%)</th>
                            </tr>
                            <tr class="text-center">
                                
                                <th colspan="3">Indicateurs</th>
                                <th colspan="1">{{(new DateTime($t_1))->format('m-Y')}}</th>
                                <th colspan="1">{{(new DateTime($date_fin))->format('m-Y')}}</th>
                                <th colspan="1">Situation T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td colspan="3">Nombre d'institutions affilées</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre d'institutions affilées contrôlées</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" >Taxes de mise en oeuvre des recommandations issus de contrôle</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3" >Nombre de réunions tenues par le conseil de surveillance</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre d'agences ou de points de service</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            <tr>
                               
                                <td colspan="3">Nombre de rapport de contrôle interne</td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="5" value="0" style="text-align:center; color:#696969;"></td>
                                <td colspan="1" class="text-center"><input class="input" type="text" size="7" value="0,00 %" style="text-align:center; color:#696969;"></td>
                               
                            </tr>
                            
                        </tbody>
                        
                    </table>
                    
                    (*) &nbsp; À renseinger par les structures faitières des institutions mutualistes ou coopératives d'épargne et de crédit.<br>
                    (**) À renseinger par les institutions non mutualistes.
                </div>
            </div>
            
            
            
            
        <div class="row ml-2 mt-5 mb-3">
            <div class="col-2"></div>
            <div class="col-md-6 mb-5">
           
            </div>
            
            <div class=" col-md-4 mb-5">
                <h5>Fait à Bamako le <?php
                                    echo date('d/m/Y');
                                    ?> </h5>
            </div>
        </div>
        
        <div class="row ml-2 mt-4 mb-3">
            <div class="col-1"></div>
            <div class="col-md-2 mb-5">
            <h5><b><u>RESPONSABLE</u></b></h5>
            <img src="{{asset('assets/images/siganture.png')}}" width="135" height="135">
            </div>
            <div class="col-md-6 mb-5">
            
            </div>
            <div class=" col-md-2 mb-5">
                
            </div>
        </div>
       
       
        
    
        
        <div class="mt-2"></div>
        <div class="text-center mt-4 ">
           
            <p style="font-size: 12px; color: black">Agréée suivant Décision N°0100075 MEF-SG du 20 juillet 2001 Bamako-Mali<br>
                                                                        Siège social à Kanadjiguila //20-20-05-66/83-88-88-04
                                                                        </p>
        </div>
    </div>
    
</div>
</div>
</div>


@include('layouts.footer')

@include('layouts.script')


	</body>
</html>
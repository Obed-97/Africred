@section('title', 'Tableau de bord')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    @php
        use App\Services\Tool;
        $tool = new Tool();
    @endphp

    
<div class="modal fade" id="performance" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <form action="{{route('performance.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-survey-line  align-middle mr-2"></i>Performance de recouvrement </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    
                        <div class="row">
                            
                            <div class="col-xl-6">
                                    <div class="form-group">
                                    <label>De</label>
                                    <input class="form-control" type="date" name="date_d">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                    <div class="form-group ">
                                    <label>&Agrave;</label>
                                    <input class="form-control" type="date" name="date_f">
                                </div>
                            </div>
                            
                             <div class="col-xl-12">
                                 <div class="form-group ">
                                    <label>Performance par :</label>
                                    <select class="form-control" name="id" required>
                                        
                                        <option value="agent">AGENT</option>
                                        <option value="marche">MARCH&Eacute;</option>
                                        <option value="credit">CLIENT</option>
                                        <option value="ab_sugu">ABEYAN SUGU</option>
                                        
                                    </select>
                                </div>
                             </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-info waves-effect waves-light" type="submit"><i class="ri-survey-line  align-middle mr-1"></i> Afficher</button>
                </div>
            </div>
        </form>
        </div>
    </div>
 <div class="page-content">
    <div class="container-fluid">
        <div class="modal fade" id="Backdrop1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{route('reporting.store')}}" enctype="multipart/form-data" class="mr-2">
                    @csrf
                 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">TRIMESTRE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                            
                            <select class="form-control select2" name="trimestre" required>
                                <option value="TRIMESTRE 1">1<sup>er</sup> TRIMESTRE</option>
                                <option value="TRIMESTRE 2">2ème TRIMESTRE</option>
                                <option value="TRIMESTRE 3">3ème TRIMESTRE</option>
                                <option value="TRIMESTRE 4">4ème TRIMESTRE</option>
                            </select>
                            
                        </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">RAPPORT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> 

        <!-- start page title -->
        <div class="row" >
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 text-success">
                        Aujourd'hui,&nbsp; le &nbsp;
                        <?php
                        echo date('d-m-Y');
                        ?> 
                       
                    </h4>
                    

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0" id="web"> 
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                            <li class="breadcrumb-item active">État du jour</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

@if (auth()->user()->role_id == 5)
        <!-- end page title -->
        <div class="row mb-4">
         <div class="col-xl-2" id="web">
            <a href="{{route('etat_global.index')}}" class="btn btn-primary btn-block  waves-effect waves-light">ÉTAT GLOBAL</a>
        </div>
         <div class="col-xl-4" id="web">
            <form  method="POST" action="{{route('etat_global.store')}}" class="d-flex mb-4">
                @csrf
                <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
            </form>
         </div>
           <div class="col-xl-2" id="web">
            
        </div>
            <div class="col-xl-2"><a href="{{route('prevision.index')}}" class="btn btn-primary btn-block  waves-effect waves-light">PRÉV./RÉAL.</a></div>
            <div class="col-xl-2"><a href="{{route('etat_global.index')}}" class="btn btn-primary btn-block  waves-effect waves-light">ÉTAT GLOBAL</a></div>
        </div>

           
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Encaissement</p>
                                            <h4 class="mb-0">{{number_format($encaissements->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-success">
                                            <i class="ri-arrow-down-fill font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Décaissement</p>
                                            <h4 class="mb-0">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-danger">
                                            <i class="ri-arrow-up-fill font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-white font-size-14 mb-2">Caisse</p>
                                            <h4 class="mb-0 text-white">{{ number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-white">
                                            <i class="ri-coin-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-white font-size-14 mb-2">Banque</p>
                                            <h4 class="mb-0 text-white">{{ number_format(($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-white">
                                            <i class="ri-bank-fill font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- end row -->
                    <!-- end row -->
               <!-- start page title -->
               <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"> ADMINISTRATION</h4>
    
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0"> 
                                
                            </ol>
                        </div>
    
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                            <div class="col-md-4" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Nouveaux comptes</p>
                                                <h4 class="mb-0">{{count($clients)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-bank-card-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agents de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>  
@elseif(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 6)
             <!-- end page title -->
            <div class="row mb-4">
             @if(auth()->user()->role_id == 1)
             <div class="col-xl-2" id="web">
                 <a  class="btn btn-info btn-block text-white  waves-effect waves-light" data-toggle="modal" data-target="#Backdrop1">RAPPORT</a>
             </div>
             @endif
             <div class="col-xl-2" id="web">
                <a href="{{route('indicateur.index')}}" class="btn btn-primary btn-block  waves-effect waves-light">V&Eacute;RIFICATION</a>
            </div>
             <div class="col-xl-4" id="web">
                <form  method="POST" action="{{route('etat_global.store')}}" class="d-flex mb-4">
                    @csrf
                    <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                    <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                </form>
             </div>
                @if(auth()->user()->role_id == 1)
                <div class="col-xl-2"><a href="#" class="btn btn-info btn-block  waves-effect waves-light" data-toggle="modal" data-target="#performance" id="web">PERFORMANCE</a></div>
                @else
                <div class="col-xl-4"></div>
                @endif
                <div class="col-xl-2"><a href="{{route('etat_global.index')}}" class="btn btn-primary btn-block  waves-effect waves-light" id="web">ÉTAT GLOBAL</a></div>
            </div>
            
            <div class="row" id="web">
                <div class="col-xl-8" >
                    <div id="container" class="mb-4"></div>
                </div>
                <div class="col-xl-4">
                    <div id="chart_container" class="mb-4"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                         <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Total Recouvrement & Frais</b></p>
                                            <div class="row">
                                                <div class="col-9">
                                                    <p class="mb-2"> Aujourd'hui : <b>{{number_format(($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hier : <b>{{number_format(($hier->sum('recouvrement_jrs') + $hier->sum('interet_jrs') + $hier->sum('epargne_jrs') + $hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte')), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2"> &nbsp; Avant-hier : <b>{{number_format(($avant_hier->sum('recouvrement_jrs') + $avant_hier->sum('interet_jrs') + $avant_hier->sum('epargne_jrs') + $avant_hier->sum('assurance') + $credits_av_hier->sum('frais_deblocage') + $credits_av_hier->sum('frais_carte')), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                @if($totalCapitalParJour > 0)
                                                    @if (((($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')) / ($totalMontantParJour)) * 100) < 50)
                                                     <p class="mb-1 " > <i class="ri-arrow-down-line font-size-15 text-danger"></i> {{number_format(((($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @elseif(((($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')) / ($totalMontantParJour)) * 100) >= 50)
                                                     <p class="mb-1 " > <i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format(((($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @endif

                                                    @if (((($hier->sum('recouvrement_jrs') + $hier->sum('interet_jrs') + $hier->sum('epargne_jrs') + $hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100) < 50)
                                                     <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i> {{number_format(((($hier->sum('recouvrement_jrs') + $hier->sum('interet_jrs') + $hier->sum('epargne_jrs') + $hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @elseif(((($hier->sum('recouvrement_jrs') + $hier->sum('interet_jrs') + $hier->sum('epargne_jrs') + $hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100) >= 50)
                                                     <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format(((($hier->sum('recouvrement_jrs') + $hier->sum('interet_jrs') + $hier->sum('epargne_jrs') + $hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @endif

                                                    @if (((($avant_hier->sum('recouvrement_jrs') + $avant_hier->sum('interet_jrs') + $avant_hier->sum('epargne_jrs') + $avant_hier->sum('assurance') + $credits_av_hier->sum('frais_deblocage') + $credits_av_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100) < 50)
                                                     <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i>  {{number_format(((($avant_hier->sum('recouvrement_jrs') + $avant_hier->sum('interet_jrs') + $avant_hier->sum('epargne_jrs') + $avant_hier->sum('assurance') + $credits_av_hier->sum('frais_deblocage') + $credits_av_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @elseif(((($avant_hier->sum('recouvrement_jrs') + $avant_hier->sum('interet_jrs') + $avant_hier->sum('epargne_jrs') + $avant_hier->sum('assurance') + $credits_av_hier->sum('frais_deblocage') + $credits_av_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100) >= 50)    
                                                     <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i>  {{number_format(((($avant_hier->sum('recouvrement_jrs') + $avant_hier->sum('interet_jrs') + $avant_hier->sum('epargne_jrs') + $avant_hier->sum('assurance') + $credits_av_hier->sum('frais_deblocage') + $credits_av_hier->sum('frais_carte')) / ($totalMontantParJour)) * 100), 0, ',', ' ')}} % </p>
                                                    @endif
                                                @elseif($totalCapitalParJour == 0)    
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                @endif
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-white">
                                            <i class=" ri-scales-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-white">
                                        <span class="ml-2 ">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16 mr-2">{{number_format($totalMontantParJour , 0, ',', ' ')}} CFA </span> |
                                        <span class="ml-2">AB-SUGU :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format(($ab_sugu->sum('recouvrement_jrs') + $ab_sugu->sum('interet_jrs') + $ab_sugu->sum('epargne_jrs')), 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Recouvrement capital</b></p>
                                            <div class="row">
                                                <div class="col-9">
                                                    <p class="mb-2" > Aujourd'hui : <b>{{number_format($recouvrements->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hier : <b>{{number_format($hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp; Avant-hier : <b>{{number_format($avant_hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                    @if($totalCapitalParJour > 0)
                                                        @if ((($recouvrements->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) < 50)
                                                            <p class="mb-1 " > <i class="ri-arrow-down-line font-size-15 text-danger"></i> {{number_format((($recouvrements->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($recouvrements->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) >= 50)
                                                            <p class="mb-1 " > <i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format((($recouvrements->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($hier->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) < 50)
                                                            <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i>  {{number_format((($hier->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($hier->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) >= 50)
                                                            <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format((($hier->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($avant_hier->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) < 50)
                                                            <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i>  {{number_format((($avant_hier->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($avant_hier->sum('recouvrement_jrs')  / ($totalCapitalParJour)) * 100) >= 50)
                                                            <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i>  {{number_format((($avant_hier->sum('recouvrement_jrs') / ($totalCapitalParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                
                                                    @elseif($totalCapitalParJour == 0)    
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    @endif

                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-store-2-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16 mr-2">{{number_format($totalCapitalParJour , 0, ',', ' ')}} CFA </span>|
                                        <span class="text-muted ml-2">AB-SUGU :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($ab_sugu->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Recouvrement intérêt net</b></p>
                                            <div class="row">
                                                <div class="col-9">
                                                    <p class="mb-2" > Aujourd'hui : <b>{{number_format($recouvrements->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hier : <b>{{number_format($hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp; Avant-hier : <b>{{number_format($avant_hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                    @if($totalInteretParJour > 0)
                                                        @if ((($recouvrements->sum('interet_jrs')  / ($totalInteretParJour)) * 100) < 50)
                                                            <p class="mb-1 " > <i class="ri-arrow-down-line font-size-15 text-danger"></i> {{number_format((($recouvrements->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($recouvrements->sum('interet_jrs')  / ($totalInteretParJour)) * 100) >= 50)
                                                            <p class="mb-1 " > <i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format((($recouvrements->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($hier->sum('interet_jrs')  / ($totalInteretParJour)) * 100) < 50)
                                                            <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i> {{number_format((($hier->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($hier->sum('interet_jrs')  / ($totalInteretParJour)) * 100) >= 50)
                                                            <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i> {{number_format((($hier->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($avant_hier->sum('interet_jrs')  / ($totalInteretParJour)) * 100) < 50)
                                                            <p class="mb-1" ><i class="ri-arrow-down-line font-size-15 text-danger"></i>  {{number_format((($avant_hier->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($avant_hier->sum('interet_jrs')  / ($totalInteretParJour)) * 100) >= 50)
                                                            <p class="mb-1" ><i class="ri-arrow-up-line font-size-15 text-success"></i>  {{number_format((($avant_hier->sum('interet_jrs') / ($totalInteretParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                    
                                                    @elseif($totalInteretParJour == 0)    
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    @endif
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-calendar-check-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16 mr-2">{{number_format($totalInteretParJour , 0, ',', ' ')}} CFA </span>|
                                        <span class="text-muted ml-2">AB-SUGU :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($ab_sugu->sum('interet_jrs'), 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Recouvrement épargne</b></p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-2 font-size-13" > J-0 : <b>{{number_format($recouvrements->sum('epargne_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-1 : <b>{{number_format($hier->sum('epargne_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-2 : <b>{{number_format($avant_hier->sum('epargne_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">

                                                    @if($totalEpargneParJour > 0)
                                                        @if ((($recouvrements->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) < 50)
                                                            <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($recouvrements->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($recouvrements->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) >= 50)
                                                            <p class="mb-1 font-size-13" > <i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($recouvrements->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($hier->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) < 50)
                                                            <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($hier->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($hier->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) >= 50)
                                                            <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($hier->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif

                                                        @if ((($avant_hier->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) < 50)
                                                            <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i>  {{number_format((($avant_hier->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($avant_hier->sum('epargne_jrs')  / ($totalEpargneParJour)) * 100) >= 50)
                                                            <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i>  {{number_format((($avant_hier->sum('epargne_jrs') / ($totalEpargneParJour)) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                    
                                                    @elseif($totalEpargneParJour == 0)    
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    @endif

                                                    
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-funds-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($totalEpargneParJour , 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                         <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Frais de déblocage</b></p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-2 font-size-13" > J-0 : <b>{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-1 : <b>{{number_format($credits_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-2 : <b>{{number_format($credits_av_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                 @if($prev_credits->sum('frais_deblocage') > 0)
                                                    @if ((($credits->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) < 50)
                                                     <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits->sum('frais_deblocage')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                    @elseif((($credits->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) >= 50)
                                                     <p class="mb-1 font-size-13" > <i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits->sum('frais_deblocage') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                    @endif

                                                    @if ((($credits_hier->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) < 50)
                                                     <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_hier->sum('frais_deblocage')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} %</p>
                                                    @elseif((($credits_hier->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) >= 50)
                                                     <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_hier->sum('frais_deblocage') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                    @endif
                                                    
                                                    @if ((($credits_av_hier->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) < 50)
                                                     <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_av_hier->sum('frais_deblocage')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} %</p>
                                                    @elseif((($credits_av_hier->sum('frais_deblocage')  / ($prev_credits->sum('frais_deblocage'))) * 100) >= 50)
                                                     <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_av_hier->sum('frais_deblocage') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                    @endif
                                                @elseif($prev_credits->sum('frais_deblocage') == 0)   
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                @endif  
                                                 
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-wallet-3-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($prev_credits->sum('frais_deblocage') , 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Frais de carte</b></p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-2 font-size-13" > J-0 : <b>{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-1 : <b>{{number_format($credits_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-2 : <b>{{number_format($credits_av_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                    @if($prev_credits->sum('frais_carte') > 0)
                                                        @if ((($credits->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits->sum('frais_carte')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($credits->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" > <i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits->sum('frais_carte') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
    
                                                        @if ((($credits_hier->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_hier->sum('frais_carte')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($credits_hier->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_hier->sum('frais_carte') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                        
                                                        @if ((($credits_av_hier->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_av_hier->sum('frais_carte')/ ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($credits_av_hier->sum('frais_carte')  / ($prev_credits->sum('frais_carte'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_av_hier->sum('frais_carte') / ($prev_credits->sum('frais_deblocage'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                    @elseif($prev_credits->sum('frais_carte') == 0)    
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-bank-card-2-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($prev_credits->sum('frais_carte') , 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-3">
                            <div class="card bg-primary text-white ">
                                <div class="card-body ">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class=" font-size-14 mb-4">Montant de déblocage</p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-2 font-size-13" > J-0 : <b>{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-1 : <b>{{number_format($credits_hier->sum('montant'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-2 : <b>{{number_format($credits_av_hier->sum('montant'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-0">
                                                    @if($prev_credits->sum('montant') > 0)
                                                        @if ((($credits->sum('montant')  / ($prev_credits->sum('montant'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits->sum('montant')/ ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} % </p>
                                                        @elseif((($credits->sum('montant')  / ($prev_credits->sum('montant'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" > <i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits->sum('montant') / ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
    
                                                        @if ((($credits_hier->sum('montant')  / ($prev_credits->sum('montant'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_hier->sum('montant')/ ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($credits_hier->sum('montant')  / ($prev_credits->sum('montant'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_hier->sum('montant') / ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                        
                                                        @if ((($credits_av_hier->sum('montant')  / ($prev_credits->sum('montant'))) * 100) < 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-down-line font-size-13 text-danger"></i> {{number_format((($credits_av_hier->sum('montant')/ ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} %</p>
                                                        @elseif((($credits_av_hier->sum('montant')  / ($prev_credits->sum('montant'))) * 100) >= 50 )
                                                         <p class="mb-1 font-size-13" ><i class="ri-arrow-up-line font-size-13 text-success"></i> {{number_format((($credits_av_hier->sum('montant') / ($prev_credits->sum('montant'))) * 100), 0, ',', ' ')}} % </p>
                                                        @endif
                                                    @elseif($prev_credits->sum('montant') == 0)    
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                        <p class="mb-1 font-size-13" > <i class="ri-arrow-down-line font-size-13 text-danger"></i> 0 % </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div >
                                            <i class="ri-hand-coin-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-white border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-white ml-2">Prévision :</span>
                                        <span class="badge badge-soft-success font-size-16">{{number_format($prev_credits->sum('montant') , 0, ',', ' ')}} CFA </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-black font-size-14 mb-4"><b>Assurance</b></p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-2 font-size-13" > J-0 : <b>{{number_format($recouvrements->sum('assurance'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-1 : <b>{{number_format($hier->sum('assurance'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2 font-size-13" > J-2 : <b>{{number_format($avant_hier->sum('assurance'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-2">
                                                    @if (($recouvrements->sum('assurance')) < ($hier->sum('assurance')))
                                                    <img src="{{asset('assets/images/decreasing.png')}}" alt="" width="13" height="13"> <br/>
                                                    @elseif(($recouvrements->sum('assurance')) == ($hier->sum('assurance')))
                                                        <i class="ri-arrow-right-fill text-primary font-size-13"></i> <br/>
                                                    @else
                                                       <img src="{{asset('assets/images/growth-chart.png')}}" alt=""  width="13" height="13"><br/>
                                                    @endif
    
                                                    @if (($hier->sum('assurance')) < ($avant_hier->sum('assurance')))
                                                        <img src="{{asset('assets/images/decreasing.png')}}" alt="" width="13" height="13"> <br/>
                                                    @elseif(($hier->sum('assurance')) == ($avant_hier->sum('assurance')))
                                                        <i class="ri-arrow-right-fill text-primary font-size-13"></i> 
                                                    @else
                                                       <img src="{{asset('assets/images/growth-chart.png')}}" alt=""  width="13" height="13">
                                                    @endif
                              
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-vip-crown-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-muted ml-2">Agents en charge :</span>
                                        <span class="badge badge-soft-success font-size-16">{{count($agents)}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-white font-size-14 mb-2">Solde épargne</p>
                                            <h4 class="mb-0 text-white">{{number_format(($epargne->sum('depot')) - ($epargne->sum('retrait')), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-white">
                                            <i class="ri-funds-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-white ml-2">Nombre clients :</span>
                                        <span class="badge badge-soft-success font-size-16">{{count($epargne)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-white font-size-14 mb-2">Solde tontine</p>
                                            <h4 class="mb-0 text-white">{{number_format(($tontine->sum('depot')) - ($tontine->sum('retrait')), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-white">
                                            <i class="ri-recycle-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-white ml-2">Nombre clients :</span>
                                        <span class="badge badge-soft-success font-size-16">{{count($tontine)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-white font-size-14 mb-2">Caisse</p>
                                            <h4 class="mb-0 text-white">{{ number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-white">
                                            <i class="ri-coin-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top py-3">
                                    <div class="text-truncate">
                                        <span class="text-white ml-2">Enc. :</span>
                                            <span class="badge badge-soft-white text-white font-size-12">{{number_format($encaissements->sum('montant'), 0, ',', ' ')}} CFA</span>
                                            <span class="text-white ml-2">Déc. :</span>
                                            <span class="badge badge-soft-white text-white font-size-12">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} CFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                    <!-- end row -->
               <!-- start page title -->
               <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"> ADMINISTRATION</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0"> 
                                
                            </ol>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                            <div class="col-md-3" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Nouveaux comptes</p>
                                                <h4 class="mb-0">{{count($clients)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class="ri-bank-card-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agents de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}}</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agents de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}}</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>

                            <div class="col-md-3" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agents de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}}</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>

               
                
            </div>
            <!-- end page title -->

            
        </div>  
 @elseif(auth()->user()->role_id == 7 )
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-right mb-4"><a type="button" href="{{route('transfert.create')}}" class="btn btn-primary waves-effect waves-light">Nouveau transfert</a></h4>
                        
                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Exp&eacutediteur</th>
                            <th>Destinataire</th>
                            <th>Montant envoyé</th>
                            <th>Frais {{$frais->valeur}}%</th>
                            <th>Montant à percevoir</th>
                            <th>Pays expéditeur</th>
                            <th>Statut</th>
                            <th>Actions</th>
                           
                            
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($transferts as $item)
                           <tr>
                                <td>{{(new DateTime($item->created_at))->format('d-m-Y')}}</td>
                                <td>{{$item->nom_e}} {{$item->prenom_e}}</td>
                                <td>{{$item->nom_d}} {{$item->prenom_d}}</td>
                                <td><div class="badge badge-soft-primary font-size-15">{{number_format($item->montant, 0, ',', ' ')}} CFA</div></td>
                                <td><div class="badge badge-soft-secondary font-size-15">{{number_format($item->frais, 0, ',', ' ')}} CFA</div></td>
                                <td><div class="badge badge-soft-success font-size-15">{{number_format($item->montant_p, 0, ',', ' ')}} CFA</div></td>
                                
                                @if($item->pays_e == 'Mali')
                                <td><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                @elseif($item->pays_e == 'Côte d\'ivoire')
                                <td><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                @elseif($item->pays_e == 'Nigeria')
                                <td><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                @elseif($item->pays_e == 'Niger')
                                <td><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                @elseif($item->pays_e == 'Togo')
                                <td><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                @endif
                                
                                @if($item->statut == 'En cours..')
                                <td><div class="badge badge-soft-warning font-size-15">{{$item->statut}}</div></td>
                                @elseif($item->statut == 'Terminé')
                                <td><div class="badge badge-soft-success font-size-15">{{$item->statut}}</div></td>
                                @endif
                                <td class="d-flex">
                                    <a href="{{route('transfert.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fiche client"><i class="mdi mdi-eye font-size-18"></i></a>
                                   
                                </td>
                               
                               
                            </tr>
                        @endforeach
                        
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

 @endif
    </div> <!-- container-fluid -->
    
   
       
    
</div>
<!-- End Page-content -->




@endsection

@section('extra-js')

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">

    var datas =<?php echo json_encode($datas)?>;
    var donnes_deblocage =<?php echo json_encode($donnes_deblocage)?>;
    var donnes_attente =<?php echo json_encode($donnes_attente)?>;
   
    

    Highcharts.chart('container', {

       title:{
           text: 'Statistiques de l\'année <?php echo date('Y')?>',
            style: {
                  fontSize: '18px',
                  fontFamily: 'Inter'
               }
       }, 
       subtitle:{
           text: 'Source : AFRICRED',
           style: {
                    fontFamily: 'Inter'
                }
       }, 
       
        credits: {
            enabled: false
        },

       xAxis:{
        categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aoû', 'Sep',

                'Oct', 'Nov', 'Déc']
       },

       yAxis: [{
                    title: {
                        text: 'Échelles'
                    },

                }
                ],

      

       plotOptions:{
           line: {
            dataLabels: {
                enabled: true
            },
            
            enableMouseTracking: false
            }
       },
       series: [{
            name: 'Nouveaux clients',
            type: 'line',
            color:'#5664d2',
            data: datas
        },
        {
            name: 'Liste d\'attente',
            type: 'column',
            color: '#fcb92c',
            data: donnes_attente
        },{
            name: 'Déblocages',
            type: 'column',
            color: '#1cbb8c',
            data: donnes_deblocage
        }
    
    ],

       responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    

  
</script>

<script>
        Highcharts.chart('chart_container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
            
        },
        title: {
            text: 'Chiffres d\'affaire en <?php echo date('Y')?>',
            align: 'left',
            style: {
                  fontSize: '18px',
                  fontFamily: 'Inter'
               }
    
        },
         credits: {
            enabled: false
        },
        
        tooltip: {
            outside: true,
            pointFormat: '{series.name}: <b>{point.y} CFA</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [ {
                name: 'Déblocage ',
                y: <?= $deblocage_annee ?>,
                color: '#4aa3ff',
                dataLabels: {
                    enabled: true,
                    useHTML: true,
                    allowOverlap: true,
                    distance: -130,
                   
                    format:'<img src="/assets/images/Logo AfriCRED.png" alt="" height="50" width="150"></img>'  

              }
            },
            {
                name: 'Encours Global',
                y: <?= $encours_global  ?>,
                color: '#fcb92c',
            },
            {
                name: 'Intérêt',
                y: <?= $interet_recouvre ?>,
                color: '#1cbb8c' 
            },
            {
                name: 'Capital',
                y: <?= $capital_recouvre ?>,
                color: '#5664d2', 
                
            }
           ],
           
            size: 250,
            innerSize: '80%',
            showInLegend: true,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }]
            
    });

</script>

@endsection


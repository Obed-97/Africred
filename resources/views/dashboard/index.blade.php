@section('title', 'Bienvenue à AFRICRED')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

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
         <div class="col-xl-4" id="web">
            <form  method="POST" action="{{route('etat_global.store')}}" class="d-flex mb-4">
                @csrf
                <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
            </form>
         </div>
           <div class="col-xl-6" id="web">
                <form  method="POST" action="{{route('filtre.store')}}" class="d-flex mb-4">
                    @csrf
                    <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                    <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                    <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                </form>
            </div> 
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
                            <div class="col-md-3" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Nouveaux clients</p>
                                                <h4 class="mb-0">{{count($clients)}} client(s)</h4>
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
                                                <p class="text-truncate font-size-14 mb-2">Nombre total agent de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}} agent(s)</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>

                            <div class="col-md-3" >
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Trésorerie</p>
                                                <h4 class="mb-0 text-white">{{number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))) + ($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ') }} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class=" ri-line-chart-fill font-size-24"></i>
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
        @elseif(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
             <!-- end page title -->
            <div class="row mb-4">
                <div class="col-xl-4" id="web">
                <form  method="POST" action="{{route('etat_global.store')}}" class="d-flex mb-4">
                    @csrf
                    <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                    <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                </form>
                </div>
                <div class="col-xl-6" id="web">
                    <form  method="POST" action="{{route('filtre.store')}}" class="d-flex mb-4">
                        @csrf
                        <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                        <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                        <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                    </form>
                </div> 
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
                                            <p class="text-primary font-size-16 mb-4"><b>Total capital recouvré</b></p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="mb-2" >Aujourd'hui : <b>{{number_format($recouvrements->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hier : <b>{{number_format($hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;Avant-hier : <b>{{number_format($avant_hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-2">
                                                    @if (($recouvrements->sum('recouvrement_jrs')) < ($hier->sum('recouvrement_jrs')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($recouvrements->sum('recouvrement_jrs')) == ($hier->sum('recouvrement_jrs')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
                                                    @endif

                                                    @if (($hier->sum('recouvrement_jrs')) < ($avant_hier->sum('recouvrement_jrs')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($hier->sum('recouvrement_jrs')) == ($avant_hier->sum('recouvrement_jrs')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
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
                                        <span class="text-muted ml-2">Agents en charge :</span>
                                        <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-primary font-size-16 mb-4"><b>Recouvrement intérêt net</b></p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="mb-2" >Aujourd'hui : <b>{{number_format($recouvrements->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hier : <b>{{number_format($hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;Avant-hier : <b>{{number_format($avant_hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-2">
                                                    @if (($recouvrements->sum('interet_jrs')) < ($hier->sum('interet_jrs')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($recouvrements->sum('interet_jrs')) == ($hier->sum('interet_jrs')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
                                                    @endif

                                                    @if (($hier->sum('interet_jrs')) < $avant_hier->sum('interet_jrs'))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($hier->sum('interet_jrs')) == ($avant_hier->sum('interet_jrs')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
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
                                        <span class="text-muted ml-2">Agents en charge :</span>
                                        <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-primary font-size-16 mb-4"><b>Total frais de déblocage</b></p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="mb-2" >Aujourd'hui : <b>{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hier : <b>{{number_format($credits_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;Avant-hier : <b>{{number_format($credits_av_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-2">
                                                    @if (($credits->sum('frais_deblocage')) < ($credits_hier->sum('frais_deblocage')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($credits->sum('frais_deblocage')) == ($credits_hier->sum('frais_deblocage')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
                                                    @endif

                                                    @if (($credits_hier->sum('frais_deblocage')) < ($credits_av_hier->sum('frais_deblocage')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($credits_hier->sum('frais_deblocage')) == ($credits_av_hier->sum('frais_deblocage')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
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
                                        <span class="text-muted ml-2">Nombre total de déblocages :</span>
                                        <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-primary font-size-16 mb-4"><b>Total frais de carte</b></p>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="mb-2" >Aujourd'hui : <b>{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hier : <b>{{number_format($credits_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                    <p class="mb-2" > &nbsp;Avant-hier : <b>{{number_format($credits_av_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</b></p>
                                                </div>
                                                <div class="col-2">
                                                    @if (($credits->sum('frais_carte')) < ($credits_hier->sum('frais_carte')))
                                                    <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($credits->sum('frais_carte')) == ($credits_hier->sum('frais_carte')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
                                                    @endif
    
                                                    @if (($credits_hier->sum('frais_carte')) < ($credits_av_hier->sum('frais_carte')))
                                                        <i class="ri-arrow-down-fill text-danger font-size-15"></i> 
                                                    @elseif(($credits_hier->sum('frais_carte')) == ($credits_av_hier->sum('frais_carte')))
                                                        <i class="ri-arrow-right-line text-primary font-size-15"></i> 
                                                    @else
                                                        <i class="ri-arrow-up-fill text-success font-size-15"></i> 
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
                                        <span class="text-muted ml-2">Nombre total de cartes :</span>
                                        <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white ">
                                <div class="card-body ">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class=" font-size-14 mb-2">Total montant déblocage</p>
                                            <h4 class="mb-0 text-white">{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                        </div>
                                        <div >
                                            <i class="ri-hand-coin-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-white border-top py-3">
                                    <div class="text-truncate">
                                        <span class=" ml-2">Nombre total de déblocages :</span>
                                        <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
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
                                        <span class="badge badge-soft-success font-size-20">{{count($epargne)}}</span>
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
                                        <span class="badge badge-soft-success font-size-20">{{count($tontine)}}</span>
                                    </div>
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
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                            <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Nouveaux clients</p>
                                                <h4 class="mb-0">{{count($clients)}} client(s)</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agent de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}} agent(s)</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Marchés</p>
                                                <h4 class="mb-0">{{count($marches)}} marché(s)</h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>

                            <div class="col-md-3" >
                                <div class="card bg-info">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Banque</p>
                                                <h4 class="mb-0 text-white">{{ number_format(($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class=" ri-bank-fill font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Trésorerie</p>
                                                <h4 class="mb-0 text-white">{{number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))) + ($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ') }} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class="ri-line-chart-fill font-size-24"></i>
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
    @else
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Retard de paiement du jour</p>
                                    <h4 class="mb-0">{{number_format($encaissements->sum('montant'), 0, ',', ' ')}} Clients</h4>
                                </div>
                                <div class="text-success">
                                    <i class="ri-team-fill font-size-24"></i>
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
                                    <p class="text-truncate font-size-14 mb-2">Retard de paiement hier</p>
                                    <h4 class="mb-0">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} Clients</h4>
                                </div>
                                <div class="text-secondary">
                                    <i class="ri-team-fill font-size-24"></i>
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
                                    <p class="text-truncate font-size-14 mb-2">Retard de paiement avant-hier</p>
                                    <h4 class="mb-0">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} Clients</h4>
                                </div>
                                <div class="text-warning">
                                    <i class="ri-team-fill font-size-24"></i>
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
                                    <p class="text-truncate font-size-14 mb-2">Retard de paiement J-3</p>
                                    <h4 class="mb-0">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} Clients</h4>
                                </div>
                                <div class="text-danger">
                                    <i class="ri-team-fill font-size-24"></i>
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
      

</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endif

@endsection

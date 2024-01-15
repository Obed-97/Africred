@section('title', 'AB-SUGU' )

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @php
                $sum_capital_interet = 0;
                $sum_capital = 0;
                $sum_interet = 0;
                $sum_epargne = 0;
                $sum_assurance = 0;
                $sum_retrait = 0;
                $sum_frais_deblocage = 0;
                $sum_frais_carte = 0;
                $encours = 0;
                $solde = 0;
                foreach($credits as $credit){
                    $encours = $credit->encours($credit->montant_interet) + $encours;
                    $solde = $credit->solde($credit->montant) + $solde;
                    $sum_capital = $credit->totalRecouv() + $sum_capital;
                    $sum_interet = $credit->totalIntreret() + $sum_interet;
                    $sum_epargne = $credit->totalEpargne() + $sum_epargne;
                    $sum_assurance = $credit->totalAssurance() + $sum_assurance;
                    $sum_retrait = $credit->totalRetrait() + $sum_retrait;
                    $sum_capital_interet = $credit->montant_interet + $sum_capital_interet ;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    
                }
            @endphp
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success"> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement Global</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        
                        <div class="col-xl-2" id="web">
                    
                            <div class="col-xl-2"><a href="{{URL::previous()}}" class="btn  btn-primary waves-effect waves-light"><i class="ri-arrow-go-back-fill"></i></a></div>
                            
                        </div>
                        
                         <div class="col-xl-6" id="web">
                               
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                     <div class="text-center  font-size-18 mb-4"><b> ARR&Ecirc;T&Eacute; &nbsp; DU &nbsp;<?php
                                                                                        echo date('d-m-Y');
                                                                                        ?> </b> </div> 
                                    <table class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        

                                        <tbody style="text-transform: uppercase">
                                            <tr>
                                                <td>CR&Eacute;DIT</td>
                                                <td class="text-right ">ABEYAN SUGU</td>
                                            </tr>
                                           <tr class="bg-secondary text-white">
                                                <td>Encours S.I</td>
                                                <td class="text-right ">{{number_format($solde, 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr class="bg-primary text-white">
                                                <td>Int&eacute;r&ecirc;t</td>
                                                <td class="text-right">{{number_format($encours - $solde, 0, ',', ' ')}} CFA</td>
                                            </tr>
                                           <tr class="bg-success text-white">
                                                <td>Encours Global</td>
                                                <td class="text-right">{{number_format($encours, 0, ',', ' ')}} CFA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                                             
                                        </div>
                                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Client</th>
                                                <th>March&eacute;</th>
                                                <th >Pr&ecirc;t & Int&eacute;r&eacute;t</th>
                                                <th >Capital &agrave; recouvrir</th>
                                                <th >Int&eacute;r&ecirc;t &agrave; recouvrir</th>
                                                <th >&Eacute;pargne recouvr&eacute;</th>
                                                <th >Assurance</th>
                                                
                                                
                                                <th >Encours global</th>

                                                <th >Jours restant</th>
                                                
                                                
                                               
                                                
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td >{{number_format($item->montant_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->montant - $item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet - $item->totalIntreret(), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->totalEpargne() - $item->totalRetrait()), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->totalAssurance(), 0, ',', ' ')}} CFA</td>
                                                    
                                                    @if(($item->encours($item->montant_interet)) < 0 )
                                                    
                                                    <td>{{number_format(($item->encours($item->montant_interet)), 0, ',', ' ')}} CFA <div class="badge badge-soft-danger font-size-14">(Erreur)</div> </td>
                                                    
                                                    @else
                                                    
                                                    <td>{{number_format($item->encours(($item->montant_interet)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    @if ((\Carbon\Carbon::now() < $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0))
                                                        <td><div class="badge badge-soft-success font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jours</div></td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin) == 0)
                                                        <td><div class="badge badge-soft-primary font-size-14">Aujourd'hui</div> </td>
                                                    @else
                                                        <td><div class="badge badge-soft-danger font-size-14">D&eacute;lai expir&eacute;</div> </td>
                                                    @endif


                                                    
                                                   
                                                    
                                                    

                                                </tr>
                                            @endforeach
                                                
                                        </tbody>
                                    </table>
                                        

                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                         
                    </div> <!-- end row -->
                    
                    

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

@section('title', 'Crédit')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @php
                $sum_montant = 0;
                $sum_interet = 0;
                $sum_frais_deblocage = 0;
                $sum_frais_carte = 0;
                $sum_montant_interet = 0;
                foreach($credits as $credit){
                    $sum_montant = $credit->montant + $sum_montant ;
                    $sum_interet = $credit->interet + $sum_interet ;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    $sum_montant_interet = $credit->montant_interet + $sum_montant_interet;
                }
            @endphp

            <div class="page-content">
                <div class="container-fluid " id="phone">
                
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Déblocages &nbsp; du jour : &nbsp; {{number_format($sum_montant, 0, ',', ' ')}} CFA</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-2">
                            <a href="/" type="button" class="btn btn-primary  waves-effect waves-light" >
                                <i class="ri-arrow-go-back-line"></i>
                            </a>
                        </div>
                        <div class="col-5">
                           
                        </div>
                        <div class="col-5">
                           
                        </div>
                
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table  dt-responsive nowrap" style="font-size:13px; border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                
                                                <th>Bénéficiaire</th>
                                                <th>Capital </th>
                                                <th style="text-align: right">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                   
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    
                                                    <td style="text-align: right" class="d-flex">
                                                        @if (auth()->user()->role_id == 2)
                                                        <a href="{{route('credit.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        
                                                        @endif
                                                       
                                                    </td>

                                                </tr>
                                             @endforeach
                                               
                                        </tbody>
                                    </table>

                                    
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                            
                    </div> <!-- end row -->
                
                </div> 
                <div class="container-fluid" id="web">

                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Déblocages &nbsp; du jour : &nbsp;  {{number_format($sum_montant, 0, ',', ' ')}} CFA</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Crédits encours</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8" id="web">
                            <form  method="POST" action="{{route('etat_credit.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div>
                        <div class="col-xl-2"><a href="{{route('credit.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"> TOUS LES CRÉDITS</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                        
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <label for="">Afficher par :</label>
                                                @if (auth()->user()->role_id == 2)
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                                @else
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                                @endif
                                            </div>
                                        </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>N° Compte</th>
                                                <th>Bénéficiaire</th>
                                                
                                                <th>Date de déblocage</th>
                                                
                                                <th>Nombre de jours</th>
                                                <th>Capital & Intérêt</th>

                                                <th>Capital</th>
                                                <th>Intérêt</th>
                                                <th>Frais de déblocage</th>
                                                <th>Frais de carte</th>
                                        
                                               
                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                    <th>Agent </th>
                                                @endif
                                                    
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    
                                                    <td >{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                   
                                                    @if(($item->date_deblocage) < ($item->date_fin))
                                                     <td >{{$item->nbre_jrs}} jours</td>
                                                    @else
                                                     <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                                                    @endif
                                                    <td >{{number_format($item->montant_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                                                    
                                                    
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                     <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    @endif

                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 2)
                                                        <a href="{{route('credit.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        
                                                        @endif
                                                        @if (auth()->user()->role_id == 1)
                                                        <a href="{{route('credit.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contrat de prêt"><i class="mdi mdi-eye font-size-18"></i></a>
                                                        @endif
                                                        
                                                       
                                                    </td>

                                                </tr>
                                             @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td >{{number_format($sum_montant_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_carte, 0, ',', ' ')}} CFA</td>
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                    <td></td>
                                                    @endif
                                                    <td></td>
                                                                                               
                                                </tr>
                                        </tbody>
                                    </table>
    
                                </div>
                            </div>
                        </div> <!-- end col -->
                    <div>
                    </div> <!-- end row -->
                    
                    </div>
            <!-- End Page-content -->

@endsection

@section('title', 'Encours Global S.I')

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
                $sum_capital = 0;
                $solde = 0;
                foreach($credits as $credit){
                    $sum_montant = $credit->totalRecouv() + $sum_montant ;
                    $sum_interet = $credit->totalIntreret() + $sum_interet ;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    $sum_capital = $credit->montant + $sum_capital;
                    $solde = $credit->solde($credit->montant) + $solde;
                }
            @endphp
                   
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Encours &nbsp; Sans &nbsp; Intérêt &nbsp; : &nbsp; {{number_format($solde, 0, ',', ' ')}} CFA </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">État Encours Global S.I</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2" id="web">
                           <a href="{{route('etat_actualise.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class="ri-pushpin-fill  align-middle mr-2"></i>ENCOURS GLOBAL</a> 
                           
                        
                        </div>
                        <div class="col-xl-4" id="web">
                           
                        </div>
                        <div class="col-xl-2" id="web">
                           
                        </div>
                        <div class="col-xl-2" id="web">
                           
                        </div>
                        <div class="col-xl-2"><a href="{{route('journalier.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class="ri-funds-box-fill  align-middle mr-2"></i>DÛS JOURNALIERS</a></div>
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
                                            <th>Marché</th>
                                            <th>Prêt</th>
                                            <th>Capital recouvré</th>
                                            <th>Encours</th>
                                            <th>Délai</th>
                                            <th>Jours de retard</th>
                                           
                                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                            <th>Agent</th>
                                            <th>Agent</th>
                                            @endif

                                        </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                        @if($item->marche == '')
                                                         <td>  </td>
                                                        @else
                                                         <td>{{$item->Marche['libelle']}}</td>
                                                        @endif
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    @if(($item->solde($item->montant)) < 0)
                                                    <td>{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA <div class="badge badge-soft-danger font-size-14">(Erreur)</div> </td>
                                                   
                                                    @else
                                                    <td>{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    @if ((\Carbon\Carbon::now() < $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0))
                                                        <td><div class="badge badge-soft-success font-size-14">Dans {{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jrs</div></td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin) == 0)
                                                        <td><div class="badge badge-soft-primary font-size-14">Aujourd'hui</div></td>
                                                    @else
                                                        <td><div class="badge badge-soft-danger font-size-14">Expiré</div> </td>
                                                    @endif

                                                    @if ((\Carbon\Carbon::now() > $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0) && ($item->solde($item->montant)) != 0)
                                                     <td><div class="badge badge-soft-danger font-size-14">{{\Carbon\Carbon::createMidnightDate($item->date_fin)->diffInDays(\Carbon\Carbon::now())}} jours</div> </td>
                                                    
                                                    @else
                                                     <td><div class="badge badge-soft-success font-size-14">Pas de retard</div> </td>
                                                    @endif


                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->User['nom']}}</td>
                                                    @endif
                                                </tr>
                                             @endforeach
                                             
                                                <tr style="background-color: #1cbb8c; color: white " >
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{number_format($sum_capital, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($sum_montant, 0, ',', ' ')}} CFA</td>


                                                    <td >{{number_format($solde, 0, ',', ' ')}} CFA</td>
                                                    <td></td>
                                                    <td></td>
                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                    <td></td>
                                                    <td></td>
                                                     @endif
                                                                                                        
                                                </tr>
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

@section('title', 'Perte')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @php
                $sum_capital_interet = 0;
                $sum_recouvrement = 0;
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
                    $sum_recouvrement = $credit->totalRecouv() + $sum_recouvrement;
                    $sum_interet = $credit->totalIntreret() + $sum_interet;
                    $sum_epargne = $credit->totalEpargne() + $sum_epargne;
                    $sum_assurance = $credit->totalAssurance() + $sum_assurance;
                    $sum_retrait = $credit->totalRetrait() + $sum_retrait;
                    $sum_capital = $credit->montant + $sum_capital ;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    
                }

                $capital_encours = $sum_capital - $sum_recouvrement;

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
                                        <li class="breadcrumb-item active">Capital en perte</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                        
                        
                         <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>N* Compte</th>
                                                <th>Client</th>
                                                <th>Marché</th>
                                                <th>Sponsor</th>
                                                <th>Date de début</th>
                                                <th>Date de fin</th>
                                                <th >Capital Initial</th>
                                                <th >Capital encours</th>
                                                <th >Épargne recouvrée</th>
                                                
                                                <th >Encours global</th>
                                                <th >Total recouvré</th>

                                                <th >Jours restant</th>
                                                
                                                
                                               
                                                
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td>{{$item->sponsor}}</td>
                                                    <td >{{(new DateTime($item->date_deblocage))->format('d-m-Y')}}</td>
                                                    @if($item->date_fin_r == NULL)
                                                    <td>{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                                    @else
                                                    <td>{{(new DateTime($item->date_fin_r))->format('d-m-Y')}} </td>
                                                    @endif
                                                    <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->montant - $item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->totalEpargne() - $item->totalRetrait()), 0, ',', ' ')}} CFA</td>
                                                    
                                                   
                                                    
                                                    @if(($item->encours($item->montant_interet)) < 0 )
                                                    
                                                    <td>{{number_format(($item->encours($item->montant_interet)), 0, ',', ' ')}} CFA <div class="badge badge-soft-danger font-size-14">(Erreur)</div> </td>
                                                    
                                                    @else
                                                    
                                                    <td>{{number_format($item->encours(($item->montant_interet)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    <td >{{number_format(($item->totalRecouv()+$item->totalIntreret()+ ($item->totalEpargne() - $item->totalRetrait())), 0, ',', ' ')}} CFA</td>
                                                    
                                                    
                                                        @if($item->date_fin_r == NULL)

                                                    @if ((\Carbon\Carbon::now()->addDays(8) < $item->date_fin) &&
                                                    (\Carbon\Carbon::now()->subDays(8)->diffInDays($item->date_fin) != 0))

                                                    <td>
                                                        <div class="badge badge-soft-success font-size-14">
                                                            {{\Carbon\Carbon::now()->subDays(8)->diffInDays($item->date_fin)}} jours
                                                        </div>
                                                    </td>

                                                    @elseif(\Carbon\Carbon::now()->subDays(8)->diffInDays($item->date_fin) == 0)
                                                    <td>
                                                        <div class="badge badge-soft-primary font-size-14">Aujourd'hui</div>
                                                    </td>
                                                    @else

                                                    <td>
                                                        <div class="badge badge-soft-danger font-size-14">Délai expiré</div>
                                                    </td>
                                                    @endif

                                            @else
                                                    @if ((\Carbon\Carbon::now()->subDays(8) < $item->date_fin_r) &&
                                                    (\Carbon\Carbon::now()->diffInDays($item->date_fin_r) != 0))
                                                    <td>
                                                        <div class="badge badge-soft-success font-size-14">
                                                            {{\Carbon\Carbon::now()->subDays(8)->diffInDays($item->date_fin_r)}}
                                                            jours</div>
                                                    </td>
                                                    @elseif(\Carbon\Carbon::now()->subDays(8)->diffInDays($item->date_fin_r) == 0)
                                                    <td>
                                                        <div class="badge badge-soft-primary font-size-14">Aujourd'hui
                                                        </div>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <div class="badge badge-soft-danger font-size-14">Délai expiré
                                                        </div>
                                                    </td>
                                                    @endif
                                            @endif


                                                    
                                                   
                                                    
                                                    

                                                </tr>
                                            @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td >{{number_format($sum_capital, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($capital_encours, 0, ',', ' ')}} CFA</td>
                                                    
                                                    <td >{{number_format(($sum_epargne - $sum_retrait), 0, ',', ' ')}} CFA</td>
                                                    
                                                    <td >{{number_format($encours, 0, ',', ' ')}} CFA</td>
                                                    <td></td>
                                                    <td></td>
                                                                                                        
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

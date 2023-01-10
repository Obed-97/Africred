@section('title', 'Encours Global')

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
                                <h4 class="mb-0 text-success">Encours Global </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Encours Global</li>
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
                                    
                                    <div class="row">
                                        <div class="mb-4 col-xl-8">
                                            <h4 class="text-success mb-2"> Total = {{number_format(($credits->sum('montant_interet') - ($total->sum('recouvrement_jrs') + $total->sum('interet_jrs'))), 0, ',', ' ')}} CFA </h4>
                                            
                                        </div>
                                    </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <td>Marché</td>
                                                <th>Capital & Intérêt</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Encours global</th>
                                                <th>Date limite</th>
                                                <th>Jours restant</th>
                                                <th>Retard</th>
                                                <th>Statut de payement</th>
                                                @if(auth()->user()->role_id == 1)
                                                <th>Agent</th>
                                                @endif
                                                
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ($recouvrements as $item)
                                                <tr>
                                                    <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Credit->Marche['libelle']}}</td>
                                                    <td>{{number_format($item->Credit['montant_interet'], 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    
                                                    @if (intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)) == 0 )
                                                    
                                                    <td class="text-success">{{number_format(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',', ' ')}} CFA -- Terminé</td>
                                                    
                                                    @elseif(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)) < 0 )
                                                    
                                                    <td class="text-danger">{{number_format(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',', ' ')}} CFA (Erreur)</td>
                                                    
                                                    @else
                                                    
                                                    <td >{{number_format(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    
                                                    <td>{{(new DateTime($item->Credit['date_fin']))->format('d-m-Y')}} </td>
                                                    
                                                    @if ((\Carbon\Carbon::now() < $item->Credit['date_fin']) && (\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) != 0))
                                                        <td class="text-success font-size-15">{{\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin'])}} jours</td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) == 0)
                                                        <td class="text-primary font-size-15">Aujourd'hui </td>
                                                    @else
                                                        <td class="text-danger font-size-15">Délai expiré </td>
                                                    @endif

                                                    @if ((\Carbon\Carbon::now() > $item->Credit['date_fin']) && (\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) != 0) && (intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs))) != 0)
                                                        <td class="text-danger font-size-15">{{\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin'])}} jours</td>
                                                    @else
                                                        <td class="text-success font-size-15">Pas de retard </td>
                                                    @endif
                                                    
                                                    @if ((intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs))) == 0 || (intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs))) < 0)
                                                        <td>
                                                            <div class="badge badge-soft-success font-size-12">Terminé</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-warning font-size-12">Encours</div>
                                                        </td>
                                                    @endif
                                                    
                                                    @if(auth()->user()->role_id == 1)
                                                    <td>{{$item->Credit->User['nom']}}</td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                      <!-- start page title -->
                      <div id="web">
                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">STATISTIQUES  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                      
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>Désignations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr  class="text-white bg-success">
                                                <td>Capital recouvré</td>
                                                <td >{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr  class="text-white bg-success">
                                                <td>Intérêt recouvré</td>
                                                <td >{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr class="text-white bg-danger">
                                                <td>Capital restant</td>
                                                <td >{{number_format(($credits->sum('montant')) - ($total->sum('recouvrement_jrs')), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                           
                                            <tr class="text-white bg-danger">
                                                <td>Intérêt restant</td>
                                                <td >{{number_format(($credits->sum('interet')) - ($total->sum('interet_jrs')) , 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

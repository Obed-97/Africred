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
                                <h4 class="mb-0 text-success">Recouvrement du jour </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement du jour</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        
                                    </h4>
                                       
                                 
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Marché</th>
                                                <th>Encours actualisé</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                                <th>Statut de payement</th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($recouvrements as $item)
                                                <tr>
                                                    <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                    <td>{{number_format(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    @if ((intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs))) == 0)
                                                        <td>
                                                            <div class="badge badge-soft-success font-size-12">Terminé</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-warning font-size-12">Encours</div>
                                                        </td>
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
                                            <tr>
                                                <td>Capital recouvré</td>
                                                <td class="text-success">{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Intérêt net</td>
                                                <td class="text-success">{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Épargne</td>
                                                <td class="text-success">{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-success">{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
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

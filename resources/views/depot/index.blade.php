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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Liste des dépôts </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Liste des dépôts</li>
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
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-success  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Dépôt</button>
                                            <button type="button" class="btn btn-danger  waves-effect waves-light" data-toggle="modal" data-target="#static">Retrait</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('depot.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Dépôt</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Type dépôt</label>
                                                            <select class="form-control " name="type_depot_id" required>
                                                                @foreach ($types as $item)
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Client</label>
                                                            <select class="form-control " name="client_id" required>
                                                                @foreach ($clients as $item)
                                                                    <option value="{{$item->id}}">{{$item->nom_prenom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Dépot</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="depot"  id="depot" required >
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-success waves-effect waves-light" type="submit">Déposer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 

                                        <div class="modal fade" id="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('depot.retrait')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Retrait</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Type retrait</label>
                                                            <select class="form-control " name="type_depot_id" required>
                                                                @foreach ($types as $item)
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Client</label>
                                                            <select class="form-control " name="client_id" required>
                                                                @foreach ($clients as $item)
                                                                    <option value="{{$item->id}}">{{$item->nom_prenom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Retrait</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="retrait"  id="retrait" required >
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-danger waves-effect waves-light" type="submit">Retirer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <a href="{{route('depot.tontine')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class=" ri-hand-coin-line"></i> Tontine</a>
                                                <a href="{{route('depot.epargne')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Épargne</a>  
                                               
                                            </div>
                                        </div>
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Nom complet</th>
                                            <th>Dépôt</th>
                                            <th>Rétrait</th>
                                            <th>Solde</th>
                                            <th>Statut</th>
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                       @foreach ($depots as $item)
                                        <tr>
                                            <td>{{$item->Client['nom_prenom']}}</td>
                                            <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format(intval($item->depot) - intval($item->retrait), 0, ',', ' ')}} CFA</td>
                                            @if ((intval($item->depot) - intval($item->retrait)) > 0)
                                                <td>
                                                    <div class="badge badge-soft-success font-size-12">Solde positif</div>
                                                </td>  
                                            @else
                                                <td>
                                                    <div class="badge badge-soft-danger font-size-12">Solde nul</div>
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


                    
                    <div class="row">
                        <div class="col-4">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">TONTINE  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        
                                    </ol>
                                </div>

                            </div>
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
                                                <td>Dépôt</td>
                                                <td class="text-success">{{number_format($tontine->sum('depot'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Retrait</td>
                                                <td class="text-success">{{number_format($tontine->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Solde</td>
                                                <td class="text-success">{{number_format(($tontine->sum('depot')) - ($tontine->sum('retrait')), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-4">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">ÉPARGNE  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        
                                    </ol>
                                </div>

                            </div>
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
                                                <td>Dépôt</td>
                                                <td class="text-success">{{number_format($epargne->sum('depot'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Retrait</td>
                                                <td class="text-success">{{number_format($epargne->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Solde</td>
                                                <td class="text-success">{{number_format(($epargne->sum('depot')) - ($epargne->sum('retrait')), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

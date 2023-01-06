@section('title', 'Crédit')

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
                                <h4 class="mb-0 text-success">Liste d'attente</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Liste d'attente</li>
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
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Demande de pr&ecirc;t</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('credit.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Demande de pr&ecirc;t</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label">B&eacute;n&eacute;ficiare</label>
                                                            <select class="form-control select2" name="client_id" required>
                                                               @foreach ($clients as $item)
                                                                <option value="{{$item->id}}">{{$item->nom_prenom}}</option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">March&eacute;</label>
                                                            <select class="form-control select2" name="marche_id" required>
                                                               @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Taux d'int&eacute;r&ecirc;t</label>
                                                            <select class="form-control " name="taux">
                                                                <option value="0.2">20%</option>
                                                                <option value="0.15">15%</option>
                                                                <option value="0.1">10%</option>
                                                                <option value="0.05">5%</option>
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de d&eacute;blocage</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_deblocage"  id="date_deblocage" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de fin</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_fin"  id="date_fin" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Frais de carte</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="frais_carte"  id="frais_carte" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                       
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>No Compte</th>
                                                <th>B&eacute;n&eacute;ficiaire</th>
                                                <th>Montant</th>
                                                
                                                <th>Nombre de jours</th>
                                              
                                                <th>Statut</th>
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                        <th>Agent </th>
                                                    @endif
                                                   
                                                <th>Action</th>
                                                    
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->created_at))->format('d-m-Y')}} </td>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    
                                                    @if(($item->date_deblocage) < ($item->date_fin))
                                                     <td >{{\Carbon\Carbon::createMidnightDate($item->date_deblocage)->diffInDays($item->date_fin)}} jours</td>
                                                    @else
                                                     <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                                                    @endif
                                                   
                                                    
                                                    
                                                    @if ($item->statut == "R&eacute;j&eacute;t&eacute;")
                                                    <td>
                                                        <div class="badge badge-soft-danger font-size-12">{{$item->statut}}</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-warning font-size-12">{{$item->statut}}</div>
                                                        </td>
                                                    @endif
                                                    
                                                    @if (auth()->user()->role_id == 1)
                                                        <td>{{$item->User['nom']}}</td>
                                                    @endif

                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                       
                                                        <form method="POST" action="{{route('attente.update', $item->id)}}" enctype="multipart/form-data" class="mr-2">
                                                            @csrf
                                                          {{method_field('PUT')}}
                                                        <button type="submit" class="btn btn-success btn-sm waves-effect waves-light mr-2">
                                                            <i class="ri-check-line align-middle mr-2"></i> Accord&eacute;
                                                        </button>
                                                        </form>
                                                        @endif
                                                       
                                                        <form method="POST" action="{{route('credit.destroy', $item->id)}}">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                        <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        </form>
                                                       
                                                    </td>

                                                </tr>
                                             @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-4" id="web">
                            <div class="card">
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>D&eacute;signations</b> </th>
                                                <th><b>Total</b> </th>

                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Montant</td>
                                                <td class="text-success">{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</td>
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

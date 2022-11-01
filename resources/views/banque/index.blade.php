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
                                <h4 class="mb-0 text-success">Banque </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Banque</li>
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
                                        <button type="button" class="btn btn-success  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="  ri-arrow-down-line"></i><i class="  ri-arrow-up-line"></i> Transaction</button>
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('banque.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Transaction bancaire</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Micro-finance</label>
                                                            <select class="form-control " name="micro_finance_id" required>
                                                               @foreach ($micros as $item)
                                                                 <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Type de transaction</label>
                                                            <select class="form-control " name="type" required>
                                                                    <option value="Dépôt">Dépôt</option>
                                                                    <option value="Rétrait">Rétrait</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Banque</label>
                                                            <select class="form-control " name="nom_banque" required>
                                                                    <option value="BDM">BDM</option>
                                                                    <option value="UBA">UBA</option>
                                                                    <option value="BCIM">BCIM</option>
                                                                    <option value="BNDA">BNDA</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date"  id="date" required >
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant" required >
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-success waves-effect waves-light" type="submit"> Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 

                                    <div class="row">
                                        <div class="mb-4 col-xl-4">
                                            <h4 class="text-success mb-2"><img src="{{asset('assets/images/banque.png')}}" height="45" width="45" class="mr-2"> Solde : {{number_format(($depots->sum('montant') - $retraits->sum('montant')), 0, ',', ' ')}} CFA </h4>
                                            
                                        </div>
                                    </div>
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Banque</th>
                                            <th>Montant</th>
                                            <th>Type de transaction</th>
                                            <th>Micro-finance</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                            @foreach ($banques as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                                    <td>{{$item->nom_banque}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>

                                                    @if ($item->type == 'Dépôt')
                                                        <td>
                                                            <div class="badge badge-soft-success font-size-12">{{$item->type}}</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-danger font-size-12">{{$item->type}}</div>
                                                        </td>
                                                    @endif

                                                    <td>{{$item->Micro_finance['libelle']}}</td>
                                                    <td class="d-flex">
                                                        <a href="{{route('banque.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir plus"><i class="mdi mdi-eye font-size-20"></i></a>
                                                        <form method="POST" action="{{route('banque.destroy', $item->id)}}">
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
                    </div> <!-- end row -->

                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

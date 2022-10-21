@section('title', 'Bienvenue à AFRICRED')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                   
                    <div class="row">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8">
                            <form  method="POST" action="{{route('etat_caisse.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('depot_caisse.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"> ÉTAT GLOBAL</a></div>
                    </div>
                     <!-- start page title -->
                     <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">
                                    Aujourd'hui,&nbsp; le &nbsp;
                                    <?php
                                    echo date('d-m-Y');
                                    ?> 
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Encaissement du jour</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
    
                    <div class="row">
                        
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 4)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Encaissement</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('depot_caisse.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Encaissement</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Nom & prénom</label>
                                                            <select class="form-control " name="user_id">
                                                                @foreach ($users as $item)
                                                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Caisse</label>
                                                            <select class="form-control " name="caisse_id">
                                                                @foreach ($caisses as $item)
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
                                               
                                                <th>Caisse</th>
                                                
                                                <th>Montant</th>
                                               
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($depots as $item)
                                            <tr >
                                                
                                                <td>N°{{$item->caisse_id}}</td>
                                               
                                                <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                
                                                
                                            </tr>
                                        @endforeach
                                            <tr >
                                                <td class="text-success">TOTAL</td>
                                            
                                                <td class="text-success">{{number_format($total->sum('montant'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                  
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th>Agent</th>
                                                
                                                <th>Montant</th>
                                               
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($depots_agents as $item)
                                            <tr >
                                                
                                                <td>{{$item->user_id}}</td>
                                               
                                                <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                
                                                
                                            </tr>

                                        @endforeach
                                            <tr >
                                                <td class="text-success">TOTAL</td>
                                            
                                                <td class="text-success">{{number_format($total->sum('montant'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->



@endsection
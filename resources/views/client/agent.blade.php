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
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Clientèle globale</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Clientèle</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8">
                            <form  method="POST" action="{{route('etat_client.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('etat_client.index')}}" class="btn btn-success btn-block  waves-effect waves-light">NOUVEAUX CLIENTS</a></div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouveau client</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouveau client</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group ">
                                                            <label>N° Carte</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="carte_id"  id="carte_id" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Nom & Prénom</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="nom_prenom"  id="nom_prenom" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Activité</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="activite"  id="activite" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="input-ip">Téléphone</label>
                                                            <input id="telephone" class="form-control input-mask" name="telephone"  data-inputmask="'alias': 'ip'">
                                                            <span class="text-muted">ex: "00.00.00.00"</span>
    
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Marché</label>
                                                            <select class="form-control " name="marche_id">
                                                                @foreach ($marches as $item)
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
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
                                         
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <label for="">Afficher par :</label>
                                                @if (auth()->user()->role_id == 2)
                                                <a href="{{route('client.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('client.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                                @else
                                                <a href="{{route('client.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('client.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                <a href="{{route('client.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                                @endif
                                            </div>
                                        </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Agent</th>
                                                <th>Nombre client</th>
                                              
                                                
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>{{$item->User['nom']}}</td>
                                                <td>{{$item->id}} clients</td>
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
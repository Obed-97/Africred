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
                                <h4 class="mb-0">Clientèle </h4>

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
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4"><button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouveau client</button></h4>
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
                                                            <label>Nom & Prénom</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="nom_prenom"  id="nom_prenom">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Activité</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="activite"  id="activite">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Téléphone</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="telephone"  id="telephone">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Marché</label>
                                                            <select class="form-control " name="marche_id">
                                                                @foreach ($marches as $item)
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" name>Agent</label>
                                                            <select class="form-control " name="user_id">
                                                                @foreach ($users as $item)
                                                                    <option value="{{$item->id}}">{{$item->nom}}</option>
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
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nom & Prénom</th>
                                                <th>Activité</th>
                                                <th>Téléphone</th>
                                                <th>Marché</th>
                                                <th>Agent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>{{$item->nom_prenom}}</td>
                                                <td>{{$item->activite}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td>{{$item->Marche['libelle']}}</td>
                                                <td>{{$item->User['nom']}}</td>

                                                <td class="d-flex">
                                                    <a href="{{route('client.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <form method="POST" action="{{route('client.destroy', $item->id)}}">
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
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
                                <h4 class="mb-0 text-success">
                                    Aujourd'hui,&nbsp; le &nbsp;
                                    <?php
                                    echo date('d-m-Y');
                                    ?> 
                                </h4>

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
                        <div class="col-xl-2"><a href="{{route('client.index')}}" class="btn btn-primary btn-block  waves-effect waves-light">TOUS LES CLIENTS</a></div>
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
                                                            <label>N° Carte NINA</label>
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
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>N° Carte NINA</th>
                                                <th>Nom & Prénom</th>
                                                <th>Activité</th>
                                                <th>Téléphone</th>
                                                <th>Marché</th>
                                                @if (auth()->user()->role_id == 1)
                                                <th>Agent</th>
                                                @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>{{$item->carte_id}}</td>
                                                <td>{{$item->nom_prenom}}</td>
                                                <td>{{$item->activite}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td>{{$item->Marche['libelle']}}</td>
                                                @if (auth()->user()->role_id == 1)
                                                <td>{{$item->User['nom']}}</td>
                                                @endif
                                                <td class="d-flex">
                                                    <a href="{{route('client.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    @if (auth()->user()->role_id == 1)
                                                    <form method="POST" action="{{route('client.destroy', $item->id)}}">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                    <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                    </form>
                                                    @endif
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
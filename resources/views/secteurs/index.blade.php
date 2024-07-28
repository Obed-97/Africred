@section('title', 'Secteur')

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
                                <h4 class="mb-0 text-success">Secteurs </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Secteurs</li>
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
                                    <h4 class="card-title text-right mb-4"><button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouvelle filière</button></h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('secteurs.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouveau secteur</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group ">
                                                            <label>Libelle</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="libelle"  id="libelle">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">March&eacute;</label>
                                                            <select class="form-control select2" name="marche_id" required>
                                                                @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Fili&egrave;re</label>
                                                            <select class="form-control select2" name="filiere_id" required>
                                                                @foreach ($filieres as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}} | {{$item->Marche['libelle']}}</option>
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
                                            <th>Code Secteur</th>
                                            <th>Secteur</th>
                                            <th>Filière</th>
                                            <th>Marche</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($secteurs as $item)
                                            <tr>
                                                <td style = "text-transform:uppercase;">S-00-{{$item->id}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->libelle}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->Filiere['libelle']}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->Marche['libelle']}}</td>
                                                <td class="d-flex">
                                                    <a href="{{route('secteurs.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    
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

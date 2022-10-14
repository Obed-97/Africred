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
                                <h4 class="mb-0">Recouvrement </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement</li>
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
                                    <h4 class="card-title text-right mb-4"><button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Recouvrement</button></h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('recouvrement.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Recouvrement journalier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label" name>Client</label>
                                                            <select class="form-control " name="credit_id">
                                                               @foreach ($credits as $item)
                                                                <option value="{{$item->id}}">{{$item->Client['nom_prenom']}} -- {{$item->Client->Marche['libelle']}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Encours actualisé</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="encours_actualise"  id="encours_actualise" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group ">
                                                            <label>Intérêt</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="interet_jrs"  id="interet_jrs" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group ">
                                                            <label>Capital</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="recouvrement_jrs"  id="recouvrement_jrs" required>
                                                            </div>
                                                         </div>
                                                        <div class="form-group ">
                                                            <label>Epargne</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="epargne_jrs"  id="epargne_jrs" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Assurance</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="assurance"  id="assurance" required>
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
                                                <th>Client</th>
                                                <th>Marché</th>
                                                <th>Encours actualisé</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Capital à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
    
    
                                        <tbody>

                                            @foreach ($recouvrements as $item)
                                                <tr>
                                                    <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                    <td>{{$item->encours_actualise}} CFA</td>
                                                    <td>{{$item->interet_jrs}} CFA</td>
                                                    <td>{{$item->recouvrement_jrs}} CFA</td>
                                                    <td>{{$item->epargne_jrs}} CFA</td>
                                                    <td>{{$item->assurance}} CFA</td>

                                                    <td class="d-flex">
                                                        <a href="" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <form method="POST" action="">
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
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
                                <h4 class="mb-0 text-success">Encaissement </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Encaissement</li>
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
                                        @if (auth()->user()->role_id == 5)
                                            <button type="button" class="btn btn-success  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="  ri-arrow-down-line"></i> Encaissement</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="#" method="POST" enctype="multipart/form-data">
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
                                                            <label class="control-label">Micro-finance</label>
                                                            <select class="form-control " name="micro-finance" required>
                                                               @foreach ($micros as $item)
                                                                 <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date"  id="date" required >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Nature</label>
                                                            <select class="form-control " name="nature" required>
                                                                    <option value="Recouvrement journalier">Recouvrement journalier</option>
                                                                    <option value="Autres">Autres</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant" required >
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Observation (Facultatif)</label>
                                                            <div>
                                                                <textarea name="observation" id="" cols="30" rows="5" class="form-control" placeholder="Donner plus de déatils sur l'encaissement"></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-success waves-effect waves-light" type="submit"><i class="  ri-arrow-down-line"></i> Encaisser</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nature</th>
                                            <th>Montant</th>
                                            <th>Micro-finance</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                            <tr>
                                                <td>10-10-2022</td>
                                                <td>Recouvrement journalier</td>
                                                <td>1000 CFA</td>
                                                <td>AB-FINANCE</td>
                                                <td class="d-flex">
                                                    <a href="#" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="#" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir plus"><i class="mdi mdi-eye font-size-18"></i></a>
                                                </td>
                                                
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

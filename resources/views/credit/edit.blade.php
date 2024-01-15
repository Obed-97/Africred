@section('title', 'Crédit')

@extends('master')

@section('content')
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                   

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                            <li class="breadcrumb-item active">Editer le déblocage</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                  
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                      
                                       
                                        <form class="custom-validation" action="{{route('credit.update', $credit->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                             
                                             <div class="modal-body">
                                                        
                                                <div class="form-group">
                                                    <label class="control-label">B&eacute;n&eacute;ficiare</label>
                                                    <select class="form-control select2" name="client_id" required>
                                                        <option value="{{$credit->client_id}}|{{$credit->sexe}}">{{$credit->Client['nom_prenom']}}</option>
                                                       @foreach ($clients as $item)
                                                        <option value="{{$item->id}}|{{$item->type_compte_id}}|{{$item->sexe}}">{{$item->nom_prenom}}</option>
                                                       @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Marché</label>
                                                    <select class="form-control select2" name="marche_id" required>
                                                       <option value="{{$credit->marche_id}}">{{$credit->Marche['libelle']}} </option>
                                                       @foreach ($marches as $item)
                                                        <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                       @endforeach
                                                    </select>
                                                 
                                                </div>
                                                
                                                
                                                <div class="form-group ">
                                                    <label>Montant</label>
                                                    <div>
                                                        <input class="form-control" min="50000" type="number" name="montant" value="{{$credit->montant}}"  id="montant" required>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Intérêt</label>
                                                    <div>
                                                        <input class="form-control" min="0" type="number" name="interet" value="{{$credit->interet}}"  id="interet" required>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label>Frais de carte</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="frais_carte"  min="0" value="{{$credit->frais_carte}}"   id="frais_carte" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{URL::previous()}}" type="reset" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</a>
                                                <button  class="btn btn-primary waves-effect waves-light" type="submit">Mettre à jour</button>
                                            </div>
                                           
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                           
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

 @endsection

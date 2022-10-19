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
                                   

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                            <li class="breadcrumb-item active">Editer le crédit</li>
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
                                         
                                                <div class="form-group">
                                                    <label class="control-label" name>Bénéficiaire</label>
                                                    <select class="form-control " name="client_id">
                                                        <option value="{{$credit->client_id}}">{{$credit->Client['nom_prenom']}} -- {{$credit->Client->Marche['libelle']}}</option>
                                                    @foreach ($clients as $item)
                                                        <option value="{{$item->id}}">{{$item->nom_prenom}} -- {{$item->Marche['libelle']}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group ">
                                                    <label>Montant</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="montant" value="{{$credit->montant}}"  id="montant" required>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Date de déblocage</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="date_deblocage" value="{{$credit->date_deblocage}}"  id="date_deblocage" required>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Date de fin</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="date_fin" value="{{$credit->date_fin}}"  id="date_fin" required>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group ">
                                                    <label>Frais de carte</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="frais_carte" value="{{$credit->frais_carte}}" id="frais_carte" required>
                                                    </div>
                                                </div>
                                            
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Enregistrer
                                                    </button>
                                                    <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                        Annuler
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                           
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

               
            <!-- end main content-->

@endsection

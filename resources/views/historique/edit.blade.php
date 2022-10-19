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
                                            <li class="breadcrumb-item active">Recouvrement de {{$historique->Credit->Client['nom_prenom']}} </li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('historique.update', $historique->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                         
                                             <div class="form-group">
                                                <label class="control-label" name>Client</label>
                                                <select class="form-control " name="credit_id">
                                                    <option value="{{$historique->credit_id}}">{{$historique->Credit->Client['nom_prenom']}} </option>
                                                   @foreach ($credits as $item)
                                                    <option value="{{$item->id}}">{{$item->Client['nom_prenom']}} </option>
                                                   @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" name>Client</label>
                                                <select class="form-control " name="marche_id">
                                                    <option value="{{$historique->Marche['id']}}">{{$historique->Marche['libelle']}} </option>
                                                   @foreach ($marches as $item)
                                                    <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                   @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label>Intérêt</label>
                                                <div>
                                                    <input class="form-control" type="number" name="interet_jrs" value="{{$historique->interet_jrs}}"  id="interet_jrs" required>
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label>Capital</label>
                                                <div>
                                                    <input class="form-control" type="number" name="recouvrement_jrs" value="{{$historique->recouvrement_jrs}}"  id="recouvrement_jrs" required>
                                                </div>
                                             </div>
                                            <div class="form-group ">
                                                <label>Epargne</label>
                                                <div>
                                                    <input class="form-control" type="number" name="epargne_jrs"  id="epargne_jrs"  value="{{$historique->epargne_jrs}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label>Assurance</label>
                                                <div>
                                                    <input class="form-control" type="number" name="assurance"  id="assurance"  value="{{$historique->assurance}}" required>
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

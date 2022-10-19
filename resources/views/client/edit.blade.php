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
                                            <li class="breadcrumb-item active">Editer le client</li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('client.update', $client->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                         
                                             <div class="form-group ">
                                                <label>Nom & Prénom</label>
                                                <div>
                                                    <input class="form-control" type="text" name="nom_prenom" value="{{$client->nom_prenom}}"  id="nom_prenom">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label>Activité</label>
                                                <div>
                                                    <input class="form-control" type="text" name="activite" value="{{$client->activite}}"  id="activite">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label>Téléphone</label>
                                                <div>
                                                    <input class="form-control" type="text" name="telephone" value="{{$client->telephone}}"  id="telephone">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Marché</label>
                                                <select class="form-control " name="marche_id">
                                                    <option value="{{$client->marche_id}}">{{$client->Marche['libelle']}}</option>
                                                    @foreach ($marches as $item)
                                                        <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" name>Transférer vers :</label>
                                                <select class="form-control " name="user_id">
                                                    <option value="{{$client->user_id}}">{{$client->User['nom']}}</option>
                                                    @foreach ($users as $item)
                                                        <option value="{{$item->id}}">{{$item->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Enregistrer
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                        Annuler
                                                    </button>
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

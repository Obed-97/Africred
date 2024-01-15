@section('title', 'Compte')

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
                                        <li class="breadcrumb-item active">Editer le compte</li>
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
                                  
                                  @if($client->type_compte_id == 1)
                                   
                                    <form class="custom-validation" action="{{route('client.update', $client->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                         {{method_field('PUT')}}
                                         
                                     <div class="modal-body">
                                         
                                               <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="imageUpload" name="image"  accept=".png, .jpg, .jpeg" />
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="imagePreview" style="background-image: url(/assets/images/users/{{$client->image}});">
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-xl-8">
                                                        <div class="form-group ">
                                                            <label>Nom & Prénom <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="nom_prenom" value="{{$client->nom_prenom}}" id="nom_prenom"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group ">
                                                            <label>Sexe <b class="text-danger">*</b></label>
                                                            <select class="form-control " name="sexe" required>
                                                                 <option value="{{$client->sexe}}" selected>{{$client->sexe}} </option>
                                                                <option value="Masculin">Masculin </option>
                                                                <option value="Féminin">Féminin </option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Activité <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="activite" value="{{$client->activite}}"  id="activite"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label for="input-ip">Téléphone</label>
                                                            <input id="telephone" class="form-control input-mask" name="telephone" value="{{$client->telephone}}" data-inputmask="'alias': 'ip'">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Marché</label>
                                                            <select class="form-control select2" name="marche_id">
                                                               @if($client->marche_id == NULL)
                                                                    @foreach ($marches as $item)
                                                                        <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                                    @endforeach
                                                               @else
                                                                <option value="{{$client->marche_id}}" selected>{{$client->Marche['libelle']}}</option>
                                                                    @foreach ($marches as $item)
                                                                        <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                                    @endforeach
                                                               @endif
                                                                
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Ville <b class="text-danger">*</b></label>
                                                            <select class="form-control select2" name="ville" required>
                                                                <option value="Bamako" selected>Bamako </option>
                                                                <option value="Sikasso">Sikasso </option>
                                                                <option value="Mopti">Mopti </option>
                                                                <option value="Koutiala">Koutiala </option>
                                                                <option value="Kayes">Kayes </option>
                                                                <option value="Ségou">Ségou </option>
                                                                <option value="Kati">Kati </option>
                                                                <option value="Gao">Gao </option>
                                                                <option value="Kolokani">Kolokani </option>
                                                                <option value="Bougouni">Bougouni </option>
                                                                <option value="San">San </option>
                                                               
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Date de naissance <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_n" value="{{$client->date_n}}"  id="date_n" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Lieu de naissance <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="lieu_n" value="{{$client->lieu_n}}" id="lieu_n" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Adresse <b class="text-danger">*</b></label>
                                                    <div>
                                                        <input class="form-control" type="text" name="adresse" value="{{$client->adresse}}"   id="adresse" required >
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        
                                        <div class="modal-footer">
                                               
                                                <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                    Annuler
                                                </a>
                                                 <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                  <i class="ri-bank-card-fill align-middle mr-2"></i>  Mettre à jour
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form class="custom-validation" action="{{route('entreprise.update', $client->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                         {{method_field('PUT')}}
                                         
                                     <div class="modal-body">
                                         
                                               <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        @if($client->image == 'avatar.png')
                                                        <div id="imagePreview" style="background-image: url(/assets/images/default-logo.png);">
                                                        </div>
                                                        @else
                                                        <div id="imagePreview" style="background-image: url(/assets/images/{{$client->image}});">
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <input class="form-control" type="hidden" value="2" name="type_compte_id"  id="type_compte_id"  >
                                                </div>
                                                 <div class="row">
                                                    <div class="col-xl-7">
                                                        <div class="form-group ">
                                                            <label>Raison sociale <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="nom_prenom" value="{{$client->nom_prenom}}" id="nom_prenom"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5">
                                                        <div class="form-group ">
                                                            <label>Forme juridique <b class="text-danger">*</b></label>
                                                            <select class="form-control " name="forme_juridique" required>
                                                                 <option value="{{$client->forme_juridique}}" selected>{{$client->forme_juridique}} </option>
                                                                 <option value="SARL" selected> SARL </option>
                                                                <option value="SA">SA </option>
                                                                <option value="SCS">SCS </option>
                                                                <option value="SAS">SAS </option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Activité <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="activite" value="{{$client->activite}}"  id="activite"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label for="input-ip">Téléphone <b class="text-danger">*</b></label>
                                                            <input id="telephone" class="form-control input-mask" name="telephone" value="{{$client->telephone}}" data-inputmask="'alias': 'ip'">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Numéro NIF <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" value="{{$client->nif}}" type="text" name="nif"  id="nif"  required>
                                                            </div>
                                                                                    
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Ville <b class="text-danger">*</b></label>
                                                            <select class="form-control select2" name="ville" required>
                                                                <option value="Bamako" selected>Bamako </option>
                                                                <option value="Sikasso">Sikasso </option>
                                                                <option value="Mopti">Mopti </option>
                                                                <option value="Koutiala">Koutiala </option>
                                                                <option value="Kayes">Kayes </option>
                                                                <option value="Ségou">Ségou </option>
                                                                <option value="Kati">Kati </option>
                                                                <option value="Gao">Gao </option>
                                                                <option value="Kolokani">Kolokani </option>
                                                                <option value="Bougouni">Bougouni </option>
                                                                <option value="San">San </option>
                                                               
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Date de création <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_n" value="{{$client->date_n}}"  id="date_n" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Siège <b class="text-danger">*</b></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="lieu_n" value="{{$client->lieu_n}}" id="lieu_n" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Adresse <b class="text-danger">*</b></label>
                                                    <div>
                                                        <input class="form-control" type="text" name="adresse" value="{{$client->adresse}}"   id="adresse" required >
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        
                                        <div class="modal-footer">
                                               
                                                <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                    Annuler
                                                </a>
                                                 <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                  <i class="ri-bank-card-fill align-middle mr-2"></i>  Mettre à jour
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                    
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                       
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           
        <!-- end main content-->
            
            

@endsection

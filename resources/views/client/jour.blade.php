@section('title', 'Compte')

@extends('master')

@section('content')
    
   

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-bank-card-fill align-middle mr-2"></i> Nouveau compte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <div class="avatar-upload mb-3">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url(/assets/images/users/avatar.png);">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="form-group ">
                                        <label>Nom & Prénom <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="text" name="nom_prenom"  id="nom_prenom"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group ">
                                        <label>Sexe <b class="text-danger">*</b></label>
                                        <select class="form-control " name="sexe" required>
                                            <option value="" selected> </option>
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
                                            <select class="form-control select2" name="activite" required>
                                                <option value="Commerce" selected>Commerce </option>
                                                <option value="Prestation de service">Prestation de service </option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label for="input-ip">Téléphone </label>
                                        <input id="telephone" class="form-control input-mask" name="telephone"  data-inputmask="'alias': 'ip'">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Marché</label>
                                    <select class="form-control select2" name="marche_id">
                                        <option value="" selected>Selectionner un marché </option>
                                        @foreach ($marches as $item)
                                        <option value="{{$item->id}}">{{$item->libelle}} </option>
                                       @endforeach
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
                                            <input class="form-control" type="date" name="date_n"  id="date_n" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label>Lieu de naissance <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="text" name="lieu_n"  id="lieu_n" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label>Filière d'activité <b class="text-danger">*</b></label>
                                        <div>
                                            <select class="form-control select2" name="filiere_id" required>
                                                @foreach ($filieres as $item)
                                                    <option value="{{ $item->id }}">{{ $item->libelle }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label>Secteur d'activité <b class="text-danger">*</b></label>
                                        <div>
                                            <select class="form-control select2" name="secteur_id" required>
                                                @foreach ($secteurs as $item)
                                                    <option value="{{ $item->id }}">{{ $item->libelle }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Adresse <b class="text-danger">*</b></label>
                                <div>
                                    <input class="form-control" type="text" name="adresse"  id="adresse" required>
                                </div>
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-bank-card-fill align-middle mr-2"></i> Créer le compte</button>
                        </div>
                    </div>
                </form>
                </div>
            </div> 
            <div class="modal fade" id="client"  tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="delete_modal" action="{{route('supprimer.client')}}" method="POST"  enctype="multipart/form-data" class="mr-2">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Êtes-vous sûr(e) ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="client" class="form-control" id="client_id" >
                                </div>
                                <h6>Rassurez-vous avant d'effectuer cette action car elle conduira à une perte de données!</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Non</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                    <i class="ri-close-line align-middle mr-2"></i> Oui, Supprimer
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-content">
               
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">NOUVEAUX COMPTES</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Compte</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                       <div class="col-xl-6" id="web">
                            <form  method="POST" action="{{route('demande.adhesion')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-7">
                                    <select class="form-control select2" name="client_id" required>
                                        @foreach ($clients as $item)
                                            <option value="{{$item->id}}"> {{$item->nom_prenom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="col-xl-5"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class="ri-file-text-line font-size-16 align-middle mr-2"></i> DEMANDE D'ADHÉSION</div>
                            </form>
                        </div>
                       <div class="col-xl-4" id="web">
                            <form  method="POST" action="{{route('etat_client.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-5"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-5"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i></div>
                            </form>
                        </div>
                        <div class="col-xl-2"><a href="{{route('client.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class="ri-bank-card-fill align-middle mr-2"></i>LES COMPTES</a></div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="ri-bank-card-fill align-middle mr-2"></i> Nouveau compte</button>
                                        @endif
                                    </h4>
                                        

                                        
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <label for="">Afficher par :</label>
                                                @if (auth()->user()->role_id == 2)
                                                <a href="{{route('client.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Compte</a>
                                                <a href="{{route('client.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                                @else
                                                <a href="{{route('client.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Compte</a>
                                                <a href="{{route('client.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                <a href="{{route('client.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                                @endif
                                            </div>
                                        </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th></th>
                                                <th>N° Compte</th>
                                                <th>Nom & Prénom</th>
                                                <th>Activité</th>
                                                <th>Téléphone</th>
                                                <th>Marché</th>
                                                <th>Adresse</th>
                                                @if (auth()->user()->role_id == 1)
                                                <th>Agent</th>
                                                @endif
                                                
                                                <th>Créer le :</th>
                                                @if (auth()->user()->role_id == 2)
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                               
                                                <td><img src="/assets/images/users/{{$item->image}}" alt="" class="rounded-circle avatar-sm"></td>
                                                <td>ABF-{{$item->id}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->nom_prenom}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->activite}}</td>
                                                <td>{{$item->telephone}}</td>
                                                @if($item->marche_id == NULL)
                                                <td></td>
                                                @else
                                                <td>{{$item->Marche['libelle']}}</td>
                                                @endif
                                                <td>{{$item->adresse}}</td>
                                                @if (auth()->user()->role_id == 1)
                                                <td>{{$item->User['nom']}}</td>
                                                @endif
                                                
                                                <td>{{(new DateTime($item->created_at))->format('d-m-Y')}}</td>
                                                @if (auth()->user()->role_id == 2)
                                                <td class="d-flex">
                                                    <a href="{{route('client.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <button  class="text-white btn-danger btn-rounded clientBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#client"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                </td>
                                                @endif
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

@section('credit_scripts')
    <script>
        $(document).ready(function () {
            $('#datatable-buttons').on('click', '.clientBtn', function () {
                var data = $(this).val();
                console.log(data);
                $('#client_id').val(data);
                $('#credit').modal('show');

            });
            
        });
    </script>
    
@endsection


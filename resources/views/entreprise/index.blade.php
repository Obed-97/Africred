@section('title', 'Compte Entreprise')

@extends('master')

@section('content')
    
   

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <form action="{{route('entreprise.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <div id="imagePreview" style="background-image: url(/assets/images/default-logo.png);">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                               
                                <div>
                                    <input class="form-control" type="hidden" value="2" name="type_compte_id"  id="type_compte_id"  >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="form-group ">
                                        <label>Raison sociale <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="text" name="nom_prenom"  id="nom_prenom"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group ">
                                        <label>Forme juridique <b class="text-danger">*</b></label>
                                        <select class="form-control " name="forme_juridique" required>
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
                                        <label>Activit&eacute; <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="text" name="activite"  id="activite"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label for="input-ip">T&eacute;l&eacute;phone <b class="text-danger">*</b> </label>
                                        <input id="telephone" class="form-control input-mask" name="telephone"  data-inputmask="'alias': 'ip'" required>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Numéro NIF <b class="text-danger">*</b></label>
                                    <div>
                                        <input class="form-control" type="text" name="nif"  id="nif"  required>
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
                                            <option value="Sï¿½gou">Sï¿½gou </option>
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
                                        <label>Date de cr&eacute;ation <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="date" name="date_n"  id="date_n" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group ">
                                        <label>Si&egrave;ge <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="text" name="lieu_n"  id="lieu_n" required >
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
                            <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-bank-card-fill align-middle mr-2"></i> Cr&eacute;er le compte</button>
                        </div>
                    </div>
                </form>
                </div>
            </div> 
            <div class="modal fade" id="client"  tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="delete_modal" action="{{route('delete.client')}}" method="POST"  enctype="multipart/form-data" class="mr-2">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">&Ecirc;tes-vous s&ucirc;r(e) ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="client" class="form-control" id="client_id" >
                                </div>
                                <h6>Rassurez-vous avant d'effectuer cette supression de donn&eacute;es!</h6>
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
                                <h4 class="mb-0 text-success">COMPTES ENTREPRISES</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Compte entreprise</li>
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
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="ri-bank-card-fill align-middle mr-2"></i> Nouveau compte</button>
                                        @endif
                                    </h4>
                                  
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th></th>
                                                <th>No Compte</th>
                                                <th>Entreprise</th>
                                                <th>Forme Juridique</th>
                                                <th>Numéro NIF</th>
                                                <th>Activit&eacute;</th>
                                                <th>T&eacute;l&eacute;phone</th>
                                                
                                                <th>Adresse</th>
                                                @if (auth()->user()->role_id == 1)
                                                <th>Agent</th>
                                                @endif
                                                
                                                <th>Cr&eacute;er le :</th>
                                               
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($entreprises as $item)
                                            <tr>
                                                @if($item->image == 'avatar.png')
                                                <td><img src="/assets/images/default-logo.png" alt="" class="rounded-circle avatar-sm"></td>
                                                @else
                                                <td><img src="/assets/images/{{$item->image}}" alt="" class="rounded-circle avatar-sm"></td>
                                                @endif
                                                <td>ABF-{{$item->id}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->nom_prenom}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->forme_juridique}}</td>
                                                <td>{{$item->nif}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->activite}}</td>
                                                <td>{{$item->telephone}}</td>
                                                
                                                <td>{{$item->adresse}}</td>
                                                @if (auth()->user()->role_id == 1)
                                                <td>{{$item->User['nom']}}</td>
                                                @endif
                                                
                                                <td>{{(new DateTime($item->created_at))->format('d-m-Y')}}</td>
                                                
                                                <td class="d-flex">
                                                    <a href="{{route('client.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fiche client"><i class="mdi mdi-eye font-size-18"></i></a>
                                                    <a href="{{route('client.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    
                                                    @if (auth()->user()->role_id == 2)
                                                    <button  class="text-white btn-danger btn-rounded clientBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#client"><i class="mdi mdi-trash-can font-size-18"></i></button>
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


@section('title', 'Compte')

@extends('master')

@section('content')
        
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">TOUS LES COMPTES</h4>

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
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8" id="web">
                            <form  method="POST" action="{{route('etat_client.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('etat_client.index')}}" class="btn btn-success btn-block  waves-effect waves-light">NOUVEAUX COMPTES</a></div>
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
                                                                            <input class="form-control" type="text" name="activite"  id="activite"  required>
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
                                                <th>Marché</th>
                                                <th>Nombre de comptes</th>
                                                
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                                @if($item->marche_id == NULL)
                                                    <td></td>
                                                @else
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                @endif
                                                
                                                <td>{{$item->id}} </td>
                                                
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
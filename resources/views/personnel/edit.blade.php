@section('title', 'Personnel')

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
                                            <li class="breadcrumb-item active">Editer le personnel</li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('personnel.update', $personnel->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                            <div class="form-group">
                                                <label>Poste</label>
                                                <div>
                                                    <select class="form-control" name="role" >
                                                        <option value="{{$personnel->role['id']}}">{{$personnel->role['libelle']}}</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nom complet</label>
                                                <input type="text" class="form-control" name="nom" required value="{{$personnel->nom}}"/>
                                            </div>
                                          
        
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <div>
                                                    <input type="email" class="form-control" name="email" required
                                                            parsley-type="email" value="{{$personnel->email}}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Téléphone</label>
                                                <div>
                                                    <input type="text" class="form-control" name="telephone"
                                                    value="{{$personnel->telephone}}"/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div class="modal-footer">
                                                   
                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                        Annuler
                                                    </button>
                                                     <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Enregistrer
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

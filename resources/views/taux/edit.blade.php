@section('title', 'Taux')

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
                                            <li class="breadcrumb-item active">Editer le taux</li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('taux.update', $taux->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                         
                                            <div class="form-group">
                                                <label>Libelle</label>
                                                <input type="text" class="form-control" name="libelle" required value="{{$taux->libelle}}"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Taux</label>
                                                <input type="text" class="form-control" name="valeur" required value="{{$taux->valeur}}"/>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div class="modal-footer">
                                                    <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                        Annuler
                                                    </a>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Mettre &agrave; jour
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

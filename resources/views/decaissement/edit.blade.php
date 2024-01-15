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
                                            <li class="breadcrumb-item active">Editer le décaissement</li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('decaissement.update', $decaissement->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                         
                                             <div class="form-group">
                                                <label class="control-label">Micro-finance</label>
                                                <select class="form-control " name="micro_finance_id" required>
                                                    <option value="{{$decaissement->micro_finance_id}}">{{$decaissement->Micro_finance['libelle']}}</option>
                                                   @foreach ($micros as $item)
                                                     <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Date</label>
                                                <div>
                                                    <input class="form-control" value="{{$decaissement->date}}" type="date" name="date"  id="date" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Motif</label>
                                                <select class="form-control " name="motif" required>
                                                        <option value="{{$decaissement->motif}}">{{$decaissement->motif}}</option>
                                                        <option value="Déblocage">Déblocage</option>
                                                        <option value="Frais financier">Frais financier</option>
                                                        <option value="Frais déplacement">Frais déplacement</option>
                                                        <option value="Frais personnel">Frais personnel</option>
                                                        <option value="Retraits clients">Retraits clients</option>
                                                        <option value="Autres charges">Autres charges externes</option>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Montant</label>
                                                <div>
                                                    <input class="form-control" type="number" value="{{$decaissement->montant}}" name="montant"  id="montant" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label>Observation (Facultatif)</label>
                                                <div>
                                                    <textarea name="observation" id="" value="{{$decaissement->observation}}" cols="30" rows="5" class="form-control" placeholder="Donner plus de déatils sur le décaissement"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Enregistrer
                                                    </button>
                                                    <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                        Retour
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

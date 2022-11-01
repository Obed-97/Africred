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
                                            <li class="breadcrumb-item active">Editer la transaction</li>
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
                                      
                                       
                                        <form class="custom-validation" action="{{route('banque.update', $banque->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                         
                                             <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label">Micro-finance</label>
                                                    <select class="form-control " name="micro_finance_id" required>
                                                        <option value="{{$banque->micro_finance_id}}">{{$banque->Micro_finance['libelle']}}</option>
                                                       @foreach ($micros as $item)
                                                        <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Type de transaction</label>
                                                    <select class="form-control " name="type" required>
                                                        <option value="{{$banque->type}}">{{$banque->type}}</option>
                                                        <option value="Dépôt">Dépôt</option>
                                                        <option value="Rétrait">Rétrait</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Banque</label>
                                                    <select class="form-control " name="nom_banque" required>
                                                        <option value="{{$banque->nom_banque}}">{{$banque->nom_banque}}</option>
                                                        <option value="BDM">BDM</option>
                                                        <option value="UBA">UBA</option>
                                                        <option value="BCIM">BCIM</option>
                                                        <option value="BNDA">BNDA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Date</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="date" value="{{$banque->date}}"  id="date" required >
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group ">
                                                    <label>Montant</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="montant" value="{{$banque->montant}}"  id="montant" required >
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{URL::previous()}}" type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</a>
                                                <button class="btn btn-success waves-effect waves-light" type="submit"> Enregistrer</button>
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

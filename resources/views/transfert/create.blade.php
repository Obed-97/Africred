@section('title', 'Transfert')

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
                                <h4 class="mb-0 text-success">Transfert </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Transfert</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div class="col-xl-2"><a href="{{URL::previous()}}" class="btn  btn-primary waves-effect waves-light"><i class="ri-arrow-go-back-fill"></i></a></div>
            
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                       
                                    </ol>
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">D&eacute;tails du transfert</h4>

                                        <div id="progrss-wizard" class="twitter-bs-wizard">
                                            <ul class="twitter-bs-wizard-nav nav-justified">
                                                <li class="nav-item">
                                                    <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">01</span>
                                                        <span class="step-title">Exp&eacute;diteur</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">02</span>
                                                        <span class="step-title">Destinataire</span>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">03</span>
                                                        <span class="step-title">Montant du transfert</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">04</span>
                                                        <span class="step-title">Confimation</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div id="bar" class="progress mt-4">
                                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                            </div>
                                            <form action="{{route('transfert.store')}}" method="POST" enctype="multipart/form-data">
                                                 @csrf
                                            <div class="tab-content twitter-bs-wizard-tab-content">
                                                <div class="tab-pane" id="progress-seller-details">
                                                    
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-firstname-input">Nom</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-firstname-input" name="nom_e" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-lastname-input">Pr&eacute;nom</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-lastname-input" name="prenom_e" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-phoneno-input">T&eacute;l&eacute;phone</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-phoneno-input" name="tel_e" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-email-input">Email</label>
                                                                    <input type="email" class="form-control" id="progress-basicpill-email-input" name="email_e" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                               
                                                                <label for="pays">Pays</label>
                                                                <div>
                                                                    <select class="form-control " name="pays_e"  required>
                                                                        
                                                                        @foreach ($pays_e as $item)
                                                                       
                                                                            <option value="{{$item->libelle}}">{{$item->libelle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   
                                                </div>
                                                <div class="tab-pane" id="progress-company-document">
                                                  <div>
                                                   
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-firstname-input">Nom</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-firstname-input" name="nom_d" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-lastname-input">Pr&eacute;nom</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-lastname-input" name="prenom_d" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-phoneno-input">T&eacute;l&eacute;phone</label>
                                                                    <input type="text" class="form-control" id="progress-basicpill-phoneno-input" name="tel_d" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="progress-basicpill-email-input">Email</label>
                                                                    <input type="email" class="form-control" id="progress-basicpill-email-input" name="email_d" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                               
                                                                <label for="pays">Pays</label>
                                                                <div>
                                                                    <select class="form-control select2" name="pays_d"  required>
                                                                        <option>Choisir un pays</option>
                                                                        @foreach ($pays_d as $item)
                                                                        <i class="ri-user-3-line auti-custom-input-icon"></i>
                                                                            <option value="{{$item->libelle}}">{{$item->libelle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                  </div>
                                                </div>
                                                <div class="tab-pane" id="progress-bank-detail">
                                                    
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-5">
                                                            <div class="text-center">
                                                                <div class="mb-4">
                                                                    <i class=" ri-bank-line text-primary display-4"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                      <label for="progress-basicpill-expiration-input">MONTANT DU TRANSFERT</label>
                                                                      <input type="hidden" class="form-control" name="frais" value="{{$frais->valeur}}" placeholder="{{$frais->valeur}}" style="text-align:center; font-size:25px" required>
                                                                      <input type="hidden" class="form-control" name="taf" value="{{$taf->valeur}}" placeholder="{{$taf->valeur}}" style="text-align:center; font-size:25px" required>
                                                                      <input type="number" class="form-control" name="montant" style="text-align:center; font-size:25px" required>
                                                                 </div>
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                     
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="progress-confirm-detail">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="text-center">
                                                                <div class="mb-4">
                                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                                </div>
                                                                <div>
                                                                    <h5><button type="submit" class="btn btn-success waves-effect waves-light">Confirmer le transfert</button></h5>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous"><a href="#">P&eacute;c&eacute;dent</a></li>
                                                <li class="next"><a href="#">Suivant</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- end row -->

                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

@section('title', 'Transfert')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Bordereau </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Bordereau</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="text-right font-size-15">Transfert #AFD{{$transfert->id}} 
                                        @if($transfert->statut == 'En cours..')
                                        <span class="badge badge-soft-warning font-size-14">{{$transfert->statut}}</span>
                                        @elseif($transfert->statut == 'Terminé')
                                        <span class="badge badge-soft-success font-size-14">{{$transfert->statut}}</span>
                                        @endif
                                        </h4>
                                        <div class="mb-4">
                                           <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="60">
                                        </div>
                                        <div class="text-muted">
                                            <p class="mb-1">Agréée suivant Décision No0100075 MEF-SG du 20 Juillet 2001</p>
                                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> Bamako - Mali</p>
                                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> Adresse : Kanadjiguila</p>
                                            <p><i class="uil uil-phone me-1"></i> Tél : 20 20 05 66 / 83 88 88 04 / 61 53 53 56</p>
                                        </div>
                                    </div>
                
                                    <hr class="my-4">
                
                                    <div class="row mb-4">
                                        <div class="col-sm-9">
                                            <div class="text-muted">
                                                <h5 class="font-size-16 mb-4">EXP&Eacute;DITEUR :</h5>
                                                <h5 class="font-size-15 mb-2" style = "text-transform:uppercase;">{{$transfert->nom_e}} {{$transfert->prenom_e}}</h5>
                                                <p class="mb-1">{{$transfert->email_e}}</p>
                                                <p class="mb-1">{{$transfert->tel_e}}</p>
                                                @if($transfert->pays_e == 'Mali')
                                                <p><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$transfert->pays_e}}</p>
                                                @elseif($transfert->pays_e == 'Côte d\'ivoire')
                                                <p><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$transfert->pays_e}}</p>
                                                @elseif($transfert->pays_e == 'Nigeria')
                                                <p><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$transfert->pays_e}}</p>
                                                @elseif($transfert->pays_e == 'Niger')
                                                <p><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$transfert->pays_e}}</p>
                                                @elseif($transfert->pays_e == 'Togo')
                                                <p><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_e}}</p>
                                                @endif
                                                <h5 class="font-size-14 mt-4" style = "text-transform:uppercase;">AGENT : {{$transfert->User['nom']}}</h5>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-sm-3">
                                            <div class="text-muted">
                                                <h5 class="font-size-16 mb-4">DESTINATAIRE :</h5>
                                                <h5 class="font-size-15 mb-2" style = "text-transform:uppercase;">{{$transfert->nom_d}} {{$transfert->prenom_d}}</h5>
                                                <p class="mb-1">{{$transfert->email_d}}</p>
                                                <p class="mb-1">{{$transfert->tel_d}}</p>
                                                @if($transfert->pays_d == 'Mali')
                                                <p><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$transfert->pays_d}}</p>
                                                @elseif($transfert->pays_d == 'Côte d\'ivoire')
                                                <p><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$transfert->pays_d}}</p>
                                                @elseif($transfert->pays_d == 'Nigeria')
                                                <p><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$transfert->pays_d}}</p>
                                                @elseif($transfert->pays_d == 'Niger')
                                                <p><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$transfert->pays_d}}</p>
                                                @elseif($transfert->pays_d == 'Togo')
                                                <p><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_d}}</p>
                                                @endif
                                                @if($transfert->statut == "Terminé")
                                                <h5 class="font-size-14 mt-4" style = "text-transform:uppercase;">AGENT : {{$transfert->recepteur}}</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                    
                                    <div class="py-2">
                                        <h5 class="font-size-15">D&eacute;tails du transfert</h5>
                
                                        <div class="table-responsive mb-4">
                                            <table class="table align-middle table-nowrap table-centered table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <th>Montant envoy&eacute;</th>
                                                        <th>Frais ({{$frais->valeur}}%)</th>
                                                        <th>Taxes ({{$taf->valeur}}%)</th>
                                                        
                                                        <th class="text-right">Montant &agrave; percevoir</th>
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                                    <tr>
                                                        <td><div class="badge badge-soft-primary font-size-16">{{number_format($transfert->montant, 0, ',', ' ')}} CFA</div></td>
                                                        <td><div class="badge badge-soft-secondary font-size-16">{{number_format($transfert->frais, 0, ',', ' ')}} CFA</div></td>
                                                        <td><div class="badge badge-soft-secondary font-size-16">{{number_format($transfert->taf, 0, ',', ' ')}} CFA</div></td>
                                                        
                                                        <td class="text-right"><div class="badge badge-soft-success font-size-16 ">{{number_format($transfert->montant_p, 0, ',', ' ')}} CFA</div></td>
                                                    </tr>
                                                    <!-- end tr -->
                           
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div><!-- end table responsive -->
                                        <div class="row">
                                            <div class="col-md-10"></div>
                                            <div class="col-md-2">
                                                <div class="d-print-none mt-4">
                                                    <div >
                                                        <div class="d-flex">
                                                           <a href="javascript:window.print()" class="btn btn-primary me-1 mr-2 text-right"><i class="fa fa-print"></i></a>
                                                            @if($transfert->statut == "En cours..")
                                                                <form class="custom-validation text-right" action="{{route('transfert.update', $transfert->id)}}" method="POST" enctype="multipart/form-data">
                                                                 @csrf
                                                                 {{method_field('PUT')}}
                                                                <button  class="btn btn-success w-md" type="submit">Terminer</button>
                                                                </form>
                                                           @endif
                                                        </div>
                                                        
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>

                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

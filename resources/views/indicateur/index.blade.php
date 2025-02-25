@section('title', 'Indicateurs')

@extends('master')

@section('content')

@php
    use App\Services\Tool;
    $tool = new Tool();
@endphp

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        
        <div class="page-content">
            <div class="container-fluid">
                
                    <!-- Modal1 
                <div class="modal fade" id="Backdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{route('indicateur.store')}}" enctype="multipart/form-data" class="mr-2">
                            @csrf
                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">FILTRER PAR DATE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    
                                    <div class="form-group">
                                        <input type="date" name="date" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                
                <!-- Modal2 -->
                <div class="modal fade" id="Backdrop1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{route('indicateur.date')}}" enctype="multipart/form-data" class="mr-2">
                            @csrf
                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">ENTRE DEUX DATES</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Début</label>
                                            <input type="date" name="date1" class="form-control"  required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Fin</label>
                                            <input type="date" name="date2" class="form-control"  required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 



                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 text-success">
                                Aujourd'hui,&nbsp; le &nbsp;
                                <?php
                                echo date('d-m-Y');
                                ?> 
                            </h4>
                            <div class="page-title-right" id="web">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">AFRICRED</a></li>
                                    <li class="breadcrumb-item active">Indicateurs</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row" >
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <div class="col-xl-4">
                                <a href="{{URL::previous()}}" class="btn  btn-primary waves-effect waves-light"><i class="ri-arrow-go-back-fill"></i></a>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        LES IMPAYÉS <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                        <a class="dropdown-item" href="#" >TOUS LES IMPAYÉS</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Backdrop1">ENTRE DEUX DATES</a>
                                    </div>
                                    
                                </div>
                            </div>
                            
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
                            <div class="badge badge-soft-success font-size-18">STATUT PAYÉ &nbsp; : &nbsp; {{$recouvrements->count()}} &nbsp; CLIENTS &nbsp; || &nbsp; TAUX &nbsp; :  &nbsp; {{number_format(($recouvrements->count()/count($clients)) * 100, 2, ',', ' ')}} %  </div> 
                            
                            <div class="card-body">
                                
                                
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th>N* Compte</th>
                                                <th>N* Prêt</th>
                                                <th>Client</th>
                                                <th>March&eacute;</th>
                                                <th>Capital</th>
                                                <th>T&eacute;l&eacute;phone</th>
                                                <th>Montant à recouvir</th>
                                                <th>Recouv. avant-hier</th>
                                                <th>Recouv. hier</th>
                                                <th>Recouv. aujourd'hui</th>
                                                <th>Encours Global</th>
                                                
                                                
                                                
                                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                
                                                <th>Agent</th>
                                                @endif
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>P-{{$item->id}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td >{{number_format(($item->montant) , 0, ',', ' ')}} CFA</td>
                                                    <td>{{$item->Client['telephone']}}</td>
                                                    <td >{{number_format(($item->capital_par_jour + $item->interet_par_jour + $item->epargne_par_jour) , 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->Recouv_av_hier() + $item->Intreret_av_hier() + $item->Epargne_av_hier()) , 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->Recouv_hier() + $item->Intreret_hier() + $item->Epargne_hier()) , 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->Recouv() + $item->Intreret() + $item->Epargne()) , 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->encours(($item->montant_interet)), 0, ',', ' ')}} CFA</td>
                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        
                                                    @endif
                                                    <td>
                                                        <form action="{{route('indicateur.show', $item->id)}}" method="GET" enctype="multipart/form-data">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary btn-sm waves-effect waves-light mr-2 " >
                                                                <i class="mdi mdi-eye font-size-18"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="badge badge-soft-danger font-size-18">STATUT IMPAYÉ &nbsp; : &nbsp; {{count($clients) - $recouvrements->count()}} &nbsp; CLIENTS  &nbsp; || &nbsp; TAUX &nbsp; :  &nbsp; {{number_format(((count($clients) - $recouvrements->count())/count($clients)) * 100, 2, ',', ' ')}} %  </div> 
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@endsection

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
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(auth()->user()->role_id == 7)
                                    <h4 class="card-title text-right mb-4"><a type="button" href="{{route('transfert.create')}}" class="btn btn-primary waves-effect waves-light">Nouveau transfert</a></h4>
                                    @endif   
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Exp&eacutediteur</th>
                                            <th>Destinataire</th>
                                            <th>Montant envoyé</th>
                                            <th>Frais {{$frais->valeur}}%</th>
                                            <th>Montant à percevoir</th>
                                            @if(auth()->user()->role_id == 1)
                                                <th>Pays expéditeur</th>
                                                <th>Pays destinataire</th>
                                            @else
                                            <th>Pays expéditeur</th>
                                            @endif
                                            <th>Statut</th>
                                            <th>Actions</th>
                                           
                                            
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach($transferts as $item)
                                           <tr>
                                                <td>{{(new DateTime($item->created_at))->format('d-m-Y')}}</td>
                                                <td>{{$item->nom_e}} {{$item->prenom_e}}</td>
                                                <td>{{$item->nom_d}} {{$item->prenom_d}}</td>
                                                <td><div class="badge badge-soft-primary font-size-15">{{number_format($item->montant, 0, ',', ' ')}} CFA</div></td>
                                                <td><div class="badge badge-soft-secondary font-size-15">{{number_format($item->frais, 0, ',', ' ')}} CFA</div></td>
                                                <td><div class="badge badge-soft-success font-size-15">{{number_format($item->montant_p, 0, ',', ' ')}} CFA</div></td>
                                                
                                                @if(auth()->user()->role_id == 1)
                                                
                                                    @if($item->pays_e == 'Mali')
                                                    <td><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Côte d\'ivoire')
                                                    <td><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Nigeria')
                                                    <td><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Niger')
                                                    <td><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Togo')
                                                    <td><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @endif
                                                    
                                                    @if($item->pays_d  == 'Mali')
                                                    <td><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$item->pays_d }}</td>
                                                    @elseif($item->pays_d  == 'Côte d\'ivoire')
                                                    <td><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$item->pays_d }}</td>
                                                    @elseif($item->pays_d  == 'Nigeria')
                                                    <td><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$item->pays_d}}</td>
                                                    @elseif($item->pays_d  == 'Niger')
                                                    <td><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$item->pays_d }}</td>
                                                    @elseif($item->pays_d == 'Togo')
                                                    <td><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_d }}</td>
                                                    @endif
                                                    
                                                @else
                                                
                                                    @if($item->pays_e == 'Mali')
                                                    <td><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Côte d\'ivoire')
                                                    <td><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Nigeria')
                                                    <td><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Niger')
                                                    <td><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @elseif($item->pays_e == 'Togo')
                                                    <td><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->pays_e}}</td>
                                                    @endif
                                                    
                                                @endif
                                                
                                                @if($item->statut == 'En cours..')
                                                <td><div class="badge badge-soft-warning font-size-15">{{$item->statut}}</div></td>
                                                @elseif($item->statut == 'Terminé')
                                                <td><div class="badge badge-soft-success font-size-15">{{$item->statut}}</div></td>
                                                @endif
                                                <td class="d-flex">
                                                    <a href="{{route('transfert.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Fiche client"><i class="mdi mdi-eye font-size-18"></i></a>
                                                   
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

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
                                <h4 class="mb-0 text-success">Historique des dépôts </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Historique des dépôts</li>
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
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Nom complet</th>
                                            <th>Dépôt</th>
                                            <th>Rétrait</th>
                                            <th>Solde</th>
                                            <th>Statut</th>
                                            @if (auth()->user()->role_id == 1)
                                                <th>Opérateur</th>
                                            @endif
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                       @foreach ($depots as $item)
                                        <tr>
                                            <td>{{(new DateTime($item->created_at))->format('d-m-Y')}} </td>
                                            <td>{{(new DateTime($item->created_at))->format('H:i')}} </td>
                                            <td>{{$item->Client['nom_prenom']}}</td>
                                            <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->solde, 0, ',', ' ')}} CFA</td>
                                            @if ((intval($item->depot) - intval($item->retrait)) > 0)
                                                <td>
                                                    <div class="badge badge-soft-success font-size-12">Solde positif</div>
                                                </td>  
                                            @else
                                                <td>
                                                    <div class="badge badge-soft-danger font-size-12">Solde nul</div>
                                                </td>
                                            @endif
                                            @if (auth()->user()->role_id == 1)
                                                <td>{{$item->User['nom']}}</td>  
                                            @endif
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

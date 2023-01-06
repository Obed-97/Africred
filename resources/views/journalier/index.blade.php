@section('title', 'Dus Journaliers')

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
                                <h4 class="mb-0 text-success">D&#219;s Journaliers </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">D&#251;s Journaliers</li>
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
                                            <th>No Compte</th>
                                            <th>Client</th>
                                            <th>Montant & Int&eacute;r&egrave;t</th>
                                            <th>Nombre de jours</th>
                                            <th>D&#251; Journalier</th>
                                            @if(auth()->user()->role_id == 1)
                                            <th>Agent</th>
                                            @endif
                                            
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                            @foreach ($liste as $item)
                                                <tr>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{number_format(($item->montant_interet), 0, ',', ' ')}} CFA</td>
                                                    @if(($item->date_deblocage) < ($item->date_fin))
                                                     <td >{{\Carbon\Carbon::createMidnightDate($item->date_deblocage)->diffInDays($item->date_fin)}} jours</td>
                                                    @else
                                                     <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                                                    @endif
                                                    @if(($item->montant_par_jour) == NULL)
                                                    <td class="text-info">Mettre a jour</td>
                                                    @else
                                                    <td>{{number_format(($item->montant_par_jour), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    @if(auth()->user()->role_id == 1)
                                                    <td>{{$item->User['nom']}} </td>
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

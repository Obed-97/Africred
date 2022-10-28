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
                                <h4 class="mb-0 text-success">État Encours Global S.I </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">État Encours Global S.I</li>
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
                                            <th>Nom complet</th>
                                            <th>Capital encours</th>
                                            <th>Capital recouvré</th>
                                            <th>Solde</th><i class="fas fa-engine-warning"></i>
                                            <th>Statut</th>

                                        </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA</td>
                                                    @if (($item->solde($item->montant)) == 0)
                                                    <td>
                                                        <div class="badge badge-soft-success font-size-12">Capital soldé</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-danger font-size-12">Non soldé</div>
                                                        </td>
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

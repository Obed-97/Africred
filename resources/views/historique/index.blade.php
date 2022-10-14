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
                                <h4 class="mb-0">Historique </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Historique</li>
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
                                                <th>Client</th>
                                                <th>Encours actualisé</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Capital à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
    
    
                                        <tbody>

                                            @foreach ($historiques as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->created_at))->format('d-m-Y')}} </td>
                                                    <td>{{(new DateTime($item->created_at))->format('H:i')}} </td>
                                                    <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{$item->encours_actualise}} CFA</td>
                                                    <td>{{$item->interet_jrs}} CFA</td>
                                                    <td>{{$item->recouvrement_jrs}} CFA</td>
                                                    <td>{{$item->epargne_jrs}} CFA</td>
                                                    <td>{{$item->assurance}} CFA</td>

                                                    <td class="d-flex">
                                                        <a href="" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        
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
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
                                    <ol class="breadcrumb m-0">
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
                                            <th>Action</th>

                                        </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format(($item->solde($item->montant)), 0, ',', ' ')}}CFA</td>
                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 2)
                                                        <a href="{{route('credit.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        @endif
                                                        @if (auth()->user()->role_id == 1)
                                                            <form method="POST" action="{{route('credit.destroy', $item->id)}}">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                            <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                            </form>
                                                        @endif

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

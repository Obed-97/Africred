@section('title', 'Dépôt')

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

                        <div class="col-xl-7" id="web">
                            <form  method="POST" action="{{route('histo.epargne.plus.filtre')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-3"></div>
                       <div class="col-xl-7" id="web">
                        </div>
                        <div class="col-xl-2"><a href="{{route('depot.index')}}" class="btn btn-primary btn-block  waves-effect waves-light mb-2"><i class="  ri-file-list-3-line align-middle mr-2"></i> LISTE DES DÉPÔTS</a></div>

                    </div>


                    <div class="row">
                        <div class="col-12">
                            @isset($date1)
                        <h5 class=" text-success">Filtre entre le {{ $date1 ?? '' }} et le {{ $date2 ?? '' }} </h5>
                        @endisset
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th></th>
                                            <th>Nom complet</th>
                                            <th>Dépôt</th>
                                            <th>Rétrait</th>


                                            @if (auth()->user()->role_id == 1 )
                                                <th>Opérateur</th>
                                            @endif
                                            @if (auth()->user()->role_id == 8)
                                            <th>Opérateur</th>
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                        </thead>


                                        <tbody>
                                       @foreach ($depots as $item)
                                        <tr>
                                            <td>{{(new DateTime($item->date))->format('d-m-Y')}} </td>
                                            <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                            <td>{{$item->Client['nom_prenom']}}</td>
                                            <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>


                                            @if (auth()->user()->role_id == 1 )
                                                <td>{{$item->User['nom']}}</td>
                                            @endif
                                            @if (auth()->user()->role_id == 8)
                                                <td>{{$item->User['nom']}}</td>
                                                <td class="d-flex">
                                                    <a href="{{route('historique_depot.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <button  class="text-white btn-danger btn-rounded deleteBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#delete"><i class="mdi mdi-trash-can font-size-18"></i></button>
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

                    <!-- Modal -->
                    <div class="modal fade" id="delete"  tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="delete_modal" action="{{route('supprimer.depot')}}" method="POST"  enctype="multipart/form-data" class="mr-2">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Êtes-vous sûr(e) ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="depot" class="form-control" id="depot_id" >
                                        </div>
                                        <h6>Rassurez-vous avant d'effectuer la suppression de cette donnée!</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Non</button>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                            <i class="ri-close-line align-middle mr-2"></i> Oui, Supprimer
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#datatable-buttons').on('click', '.deleteBtn', function () {
                var data = $(this).val();
                console.log(data);
                $('#depot_id').val(data);
                $('#delete').modal('show');

            });
        });
    </script>
@endsection

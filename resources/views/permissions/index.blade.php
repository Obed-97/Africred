@section('title', 'Permissions')

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
                                <h4 class="mb-0 text-success">Permission </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Permission</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-5 mb-2">

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        <button type="button" class="btn btn-success  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouvelle permission</button>
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{ route('store.permission')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouvel abilitation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Utilisateurs</label>
                                                            <select class="form-control " name="user_id" required>
                                                               @foreach ($personnels as $item)
                                                                 <option value="{{$item->id}}">{{$item->nom}} / {{$item->email}} </option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Permission</label>
                                                                    <select class="form-control " name="perm" required multiple>
                                                                            <option value="delete">Suppression</option>
                                                                            <option value="withdrawal">Retrait</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-success waves-effect waves-light" type="submit"> Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Suppression</th>
                                            <th>Retrait</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($personnels as $item)
                                                <tr>
                                                    <td>{{$item->nom}}</td>
                                                    <td>
                                                        @if ($item->can('delete'))
                                                            <span class="badge badge-soft-success">OUI</span>
                                                        @else
                                                            <span class="badge badge-soft-warning">NON</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->can('withdrawal'))
                                                            <span class="badge badge-soft-success">OUI</span>
                                                        @else
                                                            <span class="badge badge-soft-warning">NON</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        @if ($item->can('delete'))
                                                        <form method="POST" action="{{route('revok.permission')}}">
                                                            @csrf
                                                            <input type="hidden"  name="user_id"  value="{{ $item->id }}">
                                                            <input type="hidden" name="delete" value="delete" id="">
                                                        <button  class="text-white btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Revoquer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i> Revoquer Suppression</button>
                                                        </form>
                                                    @else
                                                    @endif


                                                    @if ($item->can('withdrawal'))
                                                    <form method="POST" action="{{route('revok.permission')}}">
                                                        @csrf
                                                        <input type="hidden"  name="user_id"  value="{{ $item->id }}">
                                                        <input type="hidden" name="withdrawal" value="withdrawal" id="">
                                                    <button  class="text-white btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Revoquer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i> Revoquer Retrait</button>
                                                    </form>
                                                @else
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

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
                        <h4 class="mb-0 text-success">{{$client->nom_prenom}} dépôts détails</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">{{$client->nom_prenom}} dépôts détails</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <form method="POST" action="{{route('frais.retro')}}" class="d-flex mb-4">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <div class="col-xl-3"><input type="number" name="montant" placeholder="montant du frais de compte" class="form-control"></div>
                        <div class="col-xl-2"><button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                    class="ri-add-fill"></i>Appliquer le frais</button></div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-4 col-xl-4">
                                    <a href="{{ route('depot.index') }}"
                                        class="btn btn-success btn-sm waves-effect waves-light mr-2"><i
                                            class=""></i> Retour</a>
                                </div>
                            </div>

                            <table id="datatable-buttons" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Frais de compte</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fds as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->montant}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>
                                            <form action="{{route('frais.destroy', $item->id)}}" method="POST" onsubmit="return confirmDeletion()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
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
    <script>
        function confirmDeletion() {
            return confirm('Êtes-vous sûr de vouloir supprimer ce dépôt ?');
        }
    </script>
    <!-- End Page-content -->


    @endsection

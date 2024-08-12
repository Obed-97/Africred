@section('title', 'Dépôt')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    @if (auth()->user()->role_id == 2)
    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('depot.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Dépôt épargne plus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="type_depot_id" value="2">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Client</label>
                            <select class="form-control select2" name="client_id" required>
                                @foreach ($clients as $item)
                                <option value="{{$item->id}}|{{$item->type_compte_id}}|{{$item->sexe}}">
                                    {{$item->nom_prenom}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group ">
                            <label>Montant</label>
                            <div>
                                <input class="form-control" type="number" name="depot" id="depot" required>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-success waves-effect waves-light" type="submit"><i
                                class="  ri-arrow-up-line align-middle mr-2"></i> Déposer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
    <div class="modal fade" id="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('depot.retrait')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"> Retrait épargne plus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="type_depot_id" value="2">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Client</label>
                            <select class="form-control select2" name="client_id" required>
                                @foreach ($clients as $item)
                                <option value="{{$item->id}}|{{$item->type_compte_id}}|{{$item->sexe}}">
                                    {{$item->nom_prenom}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group ">
                            <label>Montant</label>
                            <div>
                                <input class="form-control" type="number" name="retrait" id="retrait" required>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-danger waves-effect waves-light" type="submit"><i
                                class="  ri-arrow-up-line align-middle mr-2"></i> Retirer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">Épargne plus </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">Épargne plus</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row mb-4">
                <div class="col-xl-3"></div>
                <div class="col-xl-7" id="web">
                    <form method="POST" action="{{route('depot.livret')}}" class="d-flex mb-4">
                        @csrf
                        <div class="col-xl-6">
                            <select class="form-control select2" name="client_id" required>
                                @foreach ($clients as $item)
                                <option value="{{$item->id}}">ABF-{{$item->id}} -- {{$item->nom_prenom}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4"><button type="submit" class="btn btn-primary  waves-effect waves-light"><i
                                    class="ri-file-text-line font-size-16 align-middle mr-2"></i> ATTESTATION DE SOLDE
                        </div>
                    </form>
                </div>
                <div class="col-xl-2"><a href="{{route('historique_depot.index')}}"
                        class="btn btn-primary btn-block  waves-effect waves-light mb-2"><i
                            class="  ri-file-list-3-line align-middle mr-2"></i> HISTORIQUE</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-right mb-4">
                                @if (auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-success  waves-effect waves-light"
                                    data-toggle="modal" data-target="#staticBackdrop"><i
                                        class="  ri-arrow-down-line align-middle mr-2"></i> Dépôt</button>
                                @endif
                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                <button type="button" class="btn btn-danger  waves-effect waves-light"
                                    data-toggle="modal" data-target="#static"><i
                                        class="  ri-arrow-up-line align-middle mr-2"></i> Retrait</button>
                                @endif
                            </h4>

                            <div class="row">
                                <div class="mb-4 col-xl-4">
                                    <a href="{{route('depot.tontine')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light mr-2"><i
                                            class="ri-recycle-line"></i> Tontine</a>
                                    <a href="{{route('depot.epargne')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light"><i
                                            class="ri-store-2-line "></i> Épargne</a>
                                </div>
                            </div>

                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>N° Compte</th>
                                        <th>Nom complet</th>
                                        <th>Marché</th>
                                        <th>Téléphone</th>
                                        <th>Dépôt</th>
                                        <th>Rétrait</th>
                                        <th>Solde</th>

                                        <th>Statut</th>
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                        <th>Opérateur</th>
                                        @endif
                                        <th></th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($depots as $item)
                                    <tr>
                                        <td><img src="/assets/images/users/{{$item->Client['image']}}" alt=""
                                                class="rounded-circle avatar-sm"></td>
                                        <td>ABE-{{$item->Client['id']}}</td>
                                        <td>{{$item->Client['nom_prenom']}}</td>
                                        <td>{{$item->Client->Marche['libelle'] ?? '-'}}</td>
                                        <td>
                                            {{$item->Client['telephone']}}
                                        </td>
                                        <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format(intval($item->depot) - intval($item->retrait), 0, ',', '
                                            ')}} CFA</td>
                                        @if ((intval($item->depot) - intval($item->retrait)) > 0)
                                        <td>
                                            <div class="badge badge-soft-success font-size-14">Solde positif</div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="badge badge-soft-danger font-size-14">Solde nul</div>
                                        </td>
                                        @endif
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                        <td>{{$item->Client->User['nom']}}</td>
                                        @endif

                                        <td>
                                            <a href="{{ route('depot.show', $item->client_id)}}"
                                                class="btn btn-info">voir</a>

                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



            <div class="row " id="web">
                <div class="col-4">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">AUJOURD'HUI </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr style="font-size: 16px">
                                        <th><b>Désignations</b> </th>
                                        <th><b>Total</b> </th>

                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>Dépôt</td>
                                        <td class="text-success">{{number_format($depot_jour->sum('depot'), 0, ',', '
                                            ')}} CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Retrait</td>
                                        <td class="text-success">{{number_format($depot_jour->sum('retrait'), 0, ',', '
                                            ')}} CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Solde</td>
                                        <td class="text-success">{{number_format(($depot_jour->sum('depot')) -
                                            ($depot_jour->sum('retrait')), 0, ',', ' ')}} CFA</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-4 ">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">SOLDE </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>

                    </div>

                    <div class="card bg-primary text-white">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="text-white" style="font-size: 16px">
                                        <th><b>Désignations</b> </th>
                                        <th><b>Total</b> </th>

                                    </tr>
                                </thead>


                                <tbody class="text-white">
                                    <tr>
                                        <td>Dépôt</td>
                                        <td>{{number_format($epargne->sum('depot'), 0, ',', ' ')}} CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Retrait</td>
                                        <td>{{number_format($epargne->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Solde</td>
                                        <td>{{number_format(($epargne->sum('depot')) - ($epargne->sum('retrait')), 0,
                                            ',', ' ')}} CFA</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
                {{-- <div class="col-4">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">TONTINE </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr style="font-size: 16px">
                                        <th><b>Désignations</b> </th>
                                        <th><b>Total</b> </th>

                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>Dépôt</td>
                                        <td class="text-success">{{number_format($tontine->sum('depot'), 0, ',', ' ')}}
                                            CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Retrait</td>
                                        <td class="text-success">{{number_format($tontine->sum('retrait'), 0, ',', '
                                            ')}} CFA</td>
                                    </tr>
                                    <tr>
                                        <td>Solde</td>
                                        <td class="text-success">{{number_format(($tontine->sum('depot')) -
                                            ($tontine->sum('retrait')), 0, ',', ' ')}} CFA</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col --> --}}

            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @endsection

@section('title', 'Historique')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- Modal for Historique Global -->
            <div class="modal fade" id="historique" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('hist')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-survey-line align-middle mr-2"></i>Historique Global</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Client et prêt acquis</label>
                                    <select class="form-control select2" name="credit_id" required>
                                        @foreach ($credits as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->Client['nom_prenom']}} : {{number_format($item->montant, 0, ',', ' ')}} CFA
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-survey-line align-middle mr-2"></i> Historique</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">
                            Aujourd'hui, le
                            <?php echo date('d-m-Y'); ?>
                        </h4>
                        <div class="page-title-right" id="web">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">Historique</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row mb-4">
                <div class="col-xl-2"><a href="{{route('etat_recouvrement.index')}}" class="btn btn-primary btn-block waves-effect waves-light">RECOUVREMENT</a></div>
                <div class="col-xl-2"></div>
                <div class="col-xl-6" id="web">
                    <form method="POST" action="{{route('historique.store')}}" class="d-flex mb-4">
                        @csrf
                        <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                        <div class="col-xl-2"><button type="submit" class="btn btn-primary waves-effect waves-light"><i class="ri-search-2-line"></i></button></div>
                    </form>
                </div>
                <div class="col-xl-2"><a href="" class="btn btn-primary btn-block waves-effect waves-light" data-toggle="modal" data-target="#historique">HISTORIQUE GLOBAL</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th></th>
                                        <th>N° Compte</th>
                                        <th>Client</th>
                                        <th>Marché</th>
                                        <th>Capital à ce jour</th>
                                        <th>Intérêt à ce jour</th>
                                        <th>Capital + Intérêt</th>
                                        <th>Epargne à ce jour</th>
                                        <th>Assurance</th>
                                        <th>Retrait</th>
                                        <th>Total</th>
                                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                            <th>Agent</th>
                                            <th></th>
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historiques as $item)
                                        <tr>
                                            <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                            <td><img src="/assets/images/users/{{$item->Credit->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                            <td>ABF-{{$item->Credit->Client['id']}}</td>
                                            <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                            <td>{{$item->Credit->Marche['libelle']}}</td>
                                            <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->recouvrement_jrs + $item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                <td>{{$item->user['nom']}}</td>
                                            @endif
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                <td class="d-flex">
                                                    {{-- <a href="{{route('historique.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a> --}}
                                                    <button class="text-white btn-danger btn-rounded histBtn" value="{{$item->id}}" data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#supprimer"><i class="mdi mdi-trash-can font-size-18"></i></button>
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

            <!-- Modal for Deletion Confirmation -->
            <div class="modal fade" id="supprimer" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="delete_modal" action="{{route('supprimer')}}" method="POST" enctype="multipart/form-data" class="mr-2">
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
                                    <input type="hidden" name="historique" class="form-control" id="historique_id">
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

        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->

@endsection

@section('historique_scripts')
<script>
    $(document).ready(function () {
        $('#datatable-buttons').on('click', '.histBtn', function () {
            var data = $(this).val();
            console.log(data);
            $('#historique_id').val(data);
            $('#supprimer').modal('show');
        });
    });
</script>
@endsection

@section('title', 'Marchés')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

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
                                <li class="breadcrumb-item active">Détails marché</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End page title -->

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-12">
                    <form method="POST" action="{{route('marche.histo')}}" class="d-flex mb-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $marche->id }}">
                        <div class="col-xl-5"><input type="date" name="date" class="form-control"></div>
                        <div class="col-xl-2"><button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                    class="ri-search-2-line"></i></button></div>
                    </form>
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Recouvrements</p>
                                            <h4 class="mb-0">{{ number_format($historiques->sum('recouvrement_jrs'), 0,
                                                ',', ' ')}} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Interet</p>
                                            <h4 class="mb-0">{{ number_format($historiques->sum('interet_jrs'), 0, ',',
                                                ' ')}} CFA </h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Epargne</p>
                                            <h4 class="mb-0">{{ number_format($historiques->sum('epargne_jrs'), 0, ',',
                                                ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Assurance</p>
                                            <h4 class="mb-0">{{
                                                number_format($historiques->sum('assurance'), 0, ',', ' ')
                                                }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Retrait</p>
                                            <h4 class="mb-0">{{
                                                number_format($historiques->sum('retrait'), 0, ',', ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Debloquée</p>
                                            <h4 class="mb-0">{{
                                                number_format($deblocages->sum('montant'), 0, ',', ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Debloquée</p>
                                            <h4 class="mb-0">{{
                                                number_format($deblocages->sum('montant'), 0, ',', ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total Frais Debloqués</p>
                                            <h4 class="mb-0">{{
                                                number_format($deblocages->sum('frais_deblocage'), 0, ',', ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Sommes Total des Frais de cartes</p>
                                            <h4 class="mb-0">{{
                                                number_format($deblocages->sum('frais_carte'), 0, ',', ' ') }} CFA</h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input readonly type="text" class="form-control" name="nom" required
                                        value="{{$marche->libelle}}" />
                                </div>
                                <div class="form-group">
                                    <label>Clients</label>
                                    <div>
                                        <input readonly type="text" class="form-control" name="telephone"
                                            value=" {{$marche->tous_clients($marche->id)}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-xl-4 mb-4"><a href="#" class="btn btn-primary btn-block waves-effect waves-light">Liste
                            des
                            recouvrements du marché {{$marche->nom}}</a></div>
                    <br>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable-buttons" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>N° Compte</th>
                                            <th>Client</th>
                                            <th>Marché</th>
                                            <th>Capital</th>
                                            <th>Intérêt</th>
                                            <th>Epargne</th>
                                            <th>Assurance</th>
                                            <th>Retrait</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($historiques as $item)
                                        <tr>
                                            <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                            <td>ABF-{{$item->Credit->Client['id'] ?? '-'}}</td>
                                            <td>{{$item->Credit->Client['nom_prenom'] ?? '-'}}</td>
                                            <td>{{$item->Credit->Marche['libelle'] ?? '-'}}</td>
                                            <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($item->recouvrement_jrs + $item->interet_jrs +
                                                $item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    {{ $historiques->links('pagination::bootstrap-5') }}

                </div> <!-- end row -->

                <div class="row">
                    <div class="col-xl-4 mb-4"><a href="#" class="btn btn-primary btn-block waves-effect waves-light">Liste
                            des
                            deblocages du marché {{$marche->nom}}</a></div>
                    <br>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-right mb-4">
                                    @if (auth()->user()->role_id == 2)
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#Backdrop">
                                            <i class="ri-hand-coin-line align-middle mr-2"></i> Demande de pr&ecirc;t
                                        </button>
                                    @endif
                                </h4>


                                <table id="datatable-buttons-2" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>


                                            <th>B&eacute;n&eacute;ficiaire</th>
                                            <th>Sponsor</th>
                                            <th>March&eacute;</th>
                                            <th>Montant</th>
                                            <th>Frais déblocage</th>
                                            <th>Renouvellement</th>
                                            <th>Date déblocage</th>
                                            <th>Nbre jours</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($deblocages as $item)
                                            <tr>
                                                <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>

                                                <td style = "text-transform:uppercase;">{{$item->Client['nom_prenom']}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->sponsor}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->Marche['libelle']}}</td>
                                                <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                @if ($item->statut == "Accordé")
                                                <td ><div class="badge badge-soft-success font-size-13">{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</div></td>
                                                @else
                                                <td ><div class="badge badge-soft-warning font-size-13">{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</div></td>
                                                @endif
                                                <td class="text-center">{{$item->renouvellement($item->client_id)}} fois </td>
                                                @if(($item->date_deblocage) == NULL)
                                                <td class="text-primary">À DÉFINIR </td>
                                                @else
                                                <td>{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                @endif

                                                @if(($item->date_deblocage) < ($item->date_fin))
                                                 <td >{{$item->nbre_jrs}} jours</td>
                                                @else
                                                 <td class="text-primary"> À DÉFINIR</td>
                                                @endif



                                                @if ($item->statut == "Accordé")
                                                <td>
                                                    <div class="badge badge-soft-success font-size-12">{{$item->statut}}</div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="badge badge-soft-warning font-size-12">{{$item->statut}}</div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    {{ $deblocages->links('pagination::bootstrap-5') }}

                </div> <!-- end row -->
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
      <script>
        $(document).ready(function () {
        $('#datatable-buttons-2').on('click', '.histBtn', function () {
            var data = $(this).val();
            console.log(data);
            $('#historique_id').val(data);
            $('#supprimer').modal('show');
        });
    });
    </script>
    @endsection

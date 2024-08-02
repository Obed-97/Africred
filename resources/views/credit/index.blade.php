@section('title', 'ABEYAN FOU')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @php
                $sum_montant = 0;
                $sum_interet = 0;
                $sum_frais_deblocage = 0;
                $sum_frais_carte = 0;
                $sum_montant_interet = 0;
                foreach($credits as $credit){
                    $sum_montant = $credit->montant + $sum_montant ;
                    $sum_interet = $credit->interet + $sum_interet ;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    $sum_montant_interet = $credit->montant_interet + $sum_montant_interet;
                }
            @endphp

            <div class="page-content">

                <div class="container-fluid">
                    <div class="modal fade" id="credit"  tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="delete_modal" action="{{route('supprimer.pret')}}" method="POST"  enctype="multipart/form-data" class="mr-2">
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
                                            <input type="hidden" name="credit" class="form-control" id="credit_id" >
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

                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Crédits &nbsp; encours &nbsp; : &nbsp; {{number_format($sum_montant, 0, ',', ' ')}} CFA</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Crédits encours</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-3 mb-2">
                             <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ABEYAN FOU <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                    <a class="dropdown-item" href="{{route('nano.index')}}">ABEYAN SUGU</a>

                                </div>
                            </div>
                        </div>
                       <div class="col-xl-7" id="web">
                            <form  method="POST" action="{{route('etat_credit.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div>
                        <div class="col-xl-2"><a href="{{route('etat_credit.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> DÉBLOCAGE DU JOUR</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">
                                        <div class="mb-4 col-xl-4">
                                            <label for="">Afficher par :</label>
                                            @if (auth()->user()->role_id == 2)
                                            <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                            <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                            @else
                                            <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                            <a href="{{route('credit.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                            <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                            @endif
                                        </div>
                                    </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>N° Compte</th>
                                                <th>Bénéficiaire</th>
                                                <th>Marché</th>
                                                <th>Date déblocage</th>
                                                <th>Date échéance</th>
                                                <th>Renouvellement</th>
                                                <th>Nbre jours</th>
                                                <th>Capital</th>
                                                <th>Intérêt</th>
                                                <th>Frais déblocage</th>
                                                <th>Frais carte</th>


                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                    <th>Agent </th>
                                                @endif

                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td style = "text-transform:uppercase;">{{$item->Client['nom_prenom']}}</td>
                                                    <td style = "text-transform:uppercase;">{{$item->Marche['libelle']}}</td>
                                                    <td >{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                    <td >{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                                    <td class="text-center">{{$item->renouvellement($item->client_id)}} fois</td>
                                                    @if(($item->date_deblocage) < ($item->date_fin))
                                                     <td >{{$item->nbre_jrs}} jours</td>
                                                    @else
                                                     <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                                                    @endif

                                                    <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>


                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                         <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    @endif

                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 2)
                                                        <form action="{{route('credit.edit', $item->id)}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary btn-sm waves-effect waves-light mr-2 " >
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </button>
                                                        </form>
                                                        @endif
                                                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                                        <form action="{{route('credit.edit', $item->id)}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary btn-sm waves-effect waves-light mr-2 " >
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </button>
                                                        </form>
                                                        <form action="{{route('credit.show', $item->id)}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light mr-2 " >
                                                            <i class="mdi mdi-eye font-size-18"></i>
                                                        </button>
                                                        </form>
                                                        <form action="{{route('etat_credit.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                        {{method_field('PUT')}}
                                                        <button type="submit" class="btn btn-warning btn-sm waves-effect waves-light mr-2 " >
                                                            <i class="mdi mdi-arrow-down font-size-18"></i>
                                                        </button>
                                                        </form>
                                                        @endif
                                                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                        <button  class="text-white btn btn-danger btn-sm waves-effect waves-light creditBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#credit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        @endif


                                                    </td>

                                                </tr>
                                             @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td >{{number_format($sum_montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_carte, 0, ',', ' ')}} CFA</td>
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                                    <td></td>
                                                    @endif
                                                    <td></td>

                                                </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    <div>
                </div> <!-- end row -->

            </div>
            <!-- End Page-content -->

@endsection

@section('credit_scripts')
    <script>
        $(document).ready(function () {
            $('#datatable-buttons').on('click', '.creditBtn', function () {
                var data = $(this).val();
                console.log(data);
                $('#credit_id').val(data);
                $('#credit').modal('show');

            });

        });
    </script>


@endsection

@section('title', 'Crédit')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="modal fade" id="Backdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" >


                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-hand-coin-line  align-middle mr-2"></i> Demande de pr&ecirc;t</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Type de prêt</label>
                                <select class="form-control select2" name="type" required  onchange="showMe(this.value);">
                                    <option value="">Choisir un type de prêt</option>
                                     @foreach ($types as $item)
                                        <option value="{{$item->id}}">{{$item->libelle}}</option>
                                     @endforeach
                                </select>

                            </div>
                            <div id="x" style="display:none;">
                            <form action="{{route('credit.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div>
                                        <input class="form-control" type="hidden" name="type" value="1">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">B&eacute;n&eacute;ficiaire</label>
                                    <select class="form-control select2" name="client_id" required>
                                       @foreach ($clients as $item)
                                        <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->type_compte_id}}|{{$item->sexe}}">{{$item->nom_prenom}}</option>
                                       @endforeach
                                    </select>

                                </div>
                               <div class="row">
                                   <div class="col-xl-8">
                                       <div class="form-group ">
                                            <label>Montant</label>
                                            <div>
                                                <input class="form-control" min="25000" type="number" name="montant"  id="montant" required>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-xl-4">
                                       <div class="form-group">
                                            <label class="control-label">Taux d'int&eacute;r&ecirc;t</label>
                                            <select class="form-control " name="taux">
                                                <option value="0.2">20 %</option>
                                                <option value="0.19">19 %</option>
                                                <option value="0.18">18 %</option>
                                                <option value="0.17">17 %</option>
                                                <option value="0.16">16 %</option>
                                                <option value="0.15">15 %</option>
                                                <option value="0.1">10 %</option>
                                                <option value="0.05">05 %</option>

                                            </select>

                                        </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-xl-6">
                                       <div class="form-group">
                                            <label class="control-label">Frais de d&eacute;blocage</label>
                                            <select class="form-control " name="frais_deblocage">
                                                <option value="0.07">7 %</option>
                                                <option value="0.1">10 %</option>
                                                <option value="0.05">5 %</option>

                                            </select>

                                        </div>
                                   </div>
                                   <div class="col-xl-6">
                                       <div class="form-group ">
                                            <label>Frais de carte</label>
                                            <div>
                                                <input class="form-control" type="number" name="frais_carte"  id="frais_carte" required>
                                            </div>
                                        </div>
                                   </div>

                               </div>



                                <div class="form-group mb-4 ">
                                    <label>Motif du prêt</label>
                                    <div>
                                        <textarea class="form-control" name="motif" id="" cols="5" rows="2" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit"><i class="ri-send-plane-fill align-middle mr-2"></i> Envoyer</button>
                                </div>
                            </form>

                            </div>


                            <div id="y" style="display:none;">
                            <form action="{{route('nano.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                 <div class="form-group">
                                    <div>
                                        <input class="form-control" type="hidden" name="type" value="2">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">B&eacute;n&eacute;ficiaire</label>
                                    <select class="form-control select2" name="client_id" required>
                                       @foreach ($clients as $item)
                                        <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->type_compte_id}}|{{$item->sexe}}">{{$item->nom_prenom}}</option>
                                       @endforeach
                                    </select>

                                </div>

                               <div class="row">
                                   <div class="col-xl-4">
                                       <div class="form-group ">
                                            <label>Montant</label>
                                            <div>
                                                <input class="form-control" min="0" type="number" name="montant"  id="montant" placeholder="Montant" required>
                                            </div>
                                        </div>
                                   </div>

                                   <div class="col-xl-4">
                                        <div class="form-group ">
                                            <label>Nombre de jours</label>
                                            <div>
                                                <input class="form-control" type="number" max="40" min="0" name="nbre_jrs"  id="nbre_jrs" placeholder="max 40 jours" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                             <label class="control-label">Taux d'int&eacute;r&ecirc;t</label>
                                             <input class="form-control" type="float"  name="taux"  id="taux" placeholder="Taux" required>

                                         </div>
                                    </div>
                               </div>

                               <div class="form-group mb-4 ">
                                    <label>Motif du prêt</label>
                                    <div>
                                        <textarea class="form-control" name="motif" id="" cols="5" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group  ">

                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit"><i class="ri-send-plane-fill align-middle mr-2"></i> Envoyer</button>
                                </div>
                            </form>
                            </div>


                        </div>

                    </div>
                </form>
                </div>
            </div>

            <div class="modal fade" id="credit"  tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="delete_modal" action="{{route('supprimer.credit')}}" method="POST"  enctype="multipart/form-data" class="mr-2">
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
            <div class="page-content">

                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Liste &nbsp; d'attente &nbsp; : &nbsp; {{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Liste d'attente</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                    <div class="col-xl-2" id="web">
                         <a href="{{route('attente.create')}}" class="btn btn-primary btn-block text-white  waves-effect waves-light" >ROTATIONS</a>
                     </div>
                     <div class="col-xl-2" id="web"></div>
                       <div class="col-xl-7" id="web">
                            <form  method="POST" action="{{route('attente.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-6">
                                    <select class="form-control select2" name="client_id" required>
                                        @foreach ($clients as $item)
                                            <option value="{{$item->id}}">ABF-{{$item->id}} -- {{$item->nom_prenom}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class="ri-file-text-line font-size-16 align-middle mr-2"></i>DOSSIER DE CRÉDIT</div>
                            </form>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <div class="row">
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


                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>


                                                <th>B&eacute;n&eacute;ficiaire</th>
                                                <th>March&eacute;</th>
                                                <th>Montant</th>
                                                <th>Frais déblocage</th>
                                                <th>Renouvellement</th>
                                                <th>Date déblocage</th>
                                                <th>Nbre jours</th>

                                                <th>Statut</th>
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)


                                                        <th>Agent </th>
                                                    @endif

                                                <th>Action</th>

                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>

                                                    <td style = "text-transform:uppercase;">{{$item->Client['nom_prenom']}}</td>
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

                                                    @if(($item->date_deblocage) < ($item->date_fin) && ($item->date_deblocage) != NULL && ($item->date_fin) != NULL)
                                                     <td >{{\Carbon\Carbon::createMidnightDate($item->date_deblocage)->diffInDays($item->date_fin)}} jours</td>
                                                    @else
                                                     <td>{{$item->nbre_jrs}} jours</td>
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

                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)

                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>

                                                    @endif

                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 1 )

                                                            @if($item->statut == 'Accordé')
                                                                 <button type="button" class="btn btn-sm btn-warning waves-effect waves-light mr-3">
                                                                    <i class="ri-error-warning-line align-middle mr-2"></i> Annuler
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success btn-sm waves-effect waves-light mr-2 deblocageBtn" value="{{$item->id}}"  data-toggle="modal" data-target="#date_deblocage">
                                                                    <i class="ri-check-line align-middle mr-2"></i> Débloquer
                                                                </button>

                                                            @endif
                                                                <button  class="text-white btn-danger btn-rounded creditBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#credit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        @elseif (auth()->user()->role_id == 2 )
                                                                <button  class="text-white btn-danger btn-rounded creditBtn" value="{{$item->id}}"  data-original-title="Supprimer" type="button" data-toggle="modal" data-target="#credit"><i class="mdi mdi-trash-can font-size-18"></i></button>
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
                    <div class="col-sm-6 col-md-4 col-xl-3">


                        <!-- Modal -->
                        <div class="modal fade" id="date_deblocage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="{{route('attente.update', $item->id)}}" enctype="multipart/form-data" class="mr-2">
                                    @csrf
                                  {{method_field('PUT')}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Date de déblocage</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="deblocage" class="form-control" id="deblocage_id" >
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="date_deblocage" class="form-control"  required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success waves-effect waves-light"><i class="ri-check-line align-middle mr-2"></i> OK</button>
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

    <script>
        $(document).ready(function () {
            $('#datatable-buttons').on('click', '.deblocageBtn', function () {
                var data = $(this).val();
                console.log(data);
                $('#deblocage_id').val(data);
                $('#deblocage').modal('show');

            });

        });
    </script>



@endsection



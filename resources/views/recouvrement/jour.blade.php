@section('title', 'Recouvrement')

@extends('master')

@section('content')

@php

    $encours = 0;
    foreach($credits as $credit){

            $encours = $credit->encours($credit->montant_interet) + $encours;
        }
    @endphp

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
    <div class="main-content">
        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <form action="{{route('recouvrement.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-calendar-check-line  align-middle mr-2"></i> Recouvrement journalier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label">Client</label>
                            <select class="form-control select2" name="credit_id" required>
                                @foreach ($credits as $item)
                                <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->type_id}}" >
                                    {{$item->Client['nom_prenom']}} ; C = {{ number_format($item->montant - $item->recouvCap(), 0, ',', ' ') }} F;  I = {{ number_format($item->interet - $item->recouvInte(), 0, ',', ' ') }} F
                                </option>
                               @endforeach
                            </select>

                        </div>


                        <div class="row">
                            <div class="col-6 form-group ">
                            <label>Capital</label>
                            <div>
                                <input class="form-control" type="number" name="recouvrement_jrs" min="0" id="recouvrement_jrs" required>
                            </div>
                         </div>
                        <div class="col-6 form-group ">
                            <label>Intérêt</label>
                            <div>
                                <input class="form-control" type="number" name="interet_jrs" min="0"  id="interet_jrs" required>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-4 form-group ">
                                <label>Epargne</label>
                                <div>
                                    <input class="form-control" type="number" name="epargne_jrs" min="0"  id="epargne_jrs" required>
                                </div>
                            </div>
                            <div class="col-4 form-group ">
                                <label>Assurance</label>
                                <div>
                                    <input class="form-control" type="number" name="assurance" min="0" id="assurance" required>
                                </div>
                            </div>
                            <div class="col-4 form-group ">
                                <label>Pénalité </label>
                                <div>
                                    <input class="form-control" type="number" name="penalite" min="0" id="penalite" >
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-calendar-check-line  align-middle mr-2"></i> Recouvrir</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

         <div class="modal fade" id="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <form action="{{route('retrait.epargne')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Retrait Épargne</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group ">
                            <label>Date</label>
                            <div>
                                <input class="form-control" type="date" name="date"  id="date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Client</label>
                            <select class="form-control select2" name="credit_id" required>
                                @foreach ($epargnes as $item)
                                <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->type_id}}">
                                    {{$item->Client['nom_prenom']}} : {{number_format($item->getEpargne($item->id), 0, ',', ' ')}} CFA
                                </option>
                               @endforeach
                            </select>

                        </div>


                        <div class="form-group ">
                            <label>Montant du retrait</label>
                            <div>
                                <input class="form-control" type="number" name="retrait" min="0" id="retrait" required >
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-danger waves-effect waves-light" type="submit"><i class="  ri-arrow-up-line"></i> Retirer</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="page-content">

            <div class="container-fluid">
                @php
                    $sum_frais_deblocage = 0;
                    $sum_frais_carte = 0;
                    $sum_caiptal_interet = 0;
                    foreach($credits as $credit){
                        $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                        $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                        $sum_caiptal_interet = $credit->montant_interet + $sum_caiptal_interet;
                    }
                @endphp
                <!-- start page title -->
                <div class="row" >
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 text-success">
                                    Le &nbsp;
                                <?php
                                echo date('d-m-Y');
                                ?>  &nbsp; :  &nbsp; {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $credit_j->sum('frais_deblocage') + $credit_j->sum('frais_carte')), 0, ',', ' ')}} CFA
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0" id="web">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                    <li class="breadcrumb-item active">Recouvrement du jour</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row mb-4">
                    <div class="col-xl-2" id="web">
                        <div class="btn-group" role="group">
                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ÉTATS D'ARRÊTÉ <i class="mdi mdi-chevron-down"></i>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" >
                                    <a class="dropdown-item" data-toggle="modal" data-target="#arrete">ABEYAN FOU</a>
                                    <a class="dropdown-item" href="{{route('ab_sugu')}}">ABEYAN SUGU</a>

                                </div>


                            </div>


                    </div>



                    <div class="col-xl-4" id="web">
                       <form  method="POST" action="{{route('date.store')}}" class="d-flex mb-4">
                           @csrf
                           <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                           <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                       </form>
                    </div>
                    <div class="col-xl-2" id="web">



                    </div>

                    <div class="col-xl-2"><a href="{{route('historique.index')}}" class="btn btn-primary btn-block  waves-effect waves-light mb-2"><i class="ri-file-list-3-line  align-middle mr-2"></i> HISTORIQUE</a></div>
                    <div class="col-xl-2"><a href="{{route('recouvrement.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class=" ri-bank-line  align-middle mr-2"></i> ÉTAT GLOBAL</a></div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-right mb-4">
                                    @if(auth()->user()->role_id == 2)
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#staticBackdrop">

                                            <i class="ri-calendar-check-line  align-middle mr-2"></i> Recouvrement
                                        </button>
                                        <button type="button" class="btn btn-danger  waves-effect waves-light mb-3" data-toggle="modal" data-target="#static"><i class="ri-arrow-up-fill  align-middle mr-1"></i> Retrait Épargne</button>
                                    @endif


                                </h4>

                                <div class="modal fade" id="arrete" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                        <form action="{{route('etat_recouvrement.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-survey-line  align-middle mr-2"></i> États d'arrêté</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                @if(auth()->user()->role_id == 1)
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                                <div class="form-group">
                                                                <label>Marché</label>
                                                                <select class="form-control select2" name="marche_id" required>
                                                                    @foreach ($marches as $item)
                                                                    <option value="{{$item->id}}|{{$item->libelle}}">
                                                                        {{$item->libelle}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                                <div class="form-group ">
                                                                <label>Agent</label>
                                                                <select class="form-control select2" name="user_id" required>
                                                                    @foreach ($agents as $item)
                                                                    <option value="{{$item->id}}|{{$item->nom}}">
                                                                        {{$item->nom}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label>Marché</label>
                                                        <select class="form-control select2" name="marche_id" required>
                                                            @foreach ($marches as $item)
                                                            <option value="{{$item->id}}|{{$item->libelle}}">
                                                                {{$item->libelle}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-survey-line  align-middle mr-2"></i> Arrêter</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-xl-4">
                                        <label for="">Afficher par :</label>
                                        @if (auth()->user()->role_id == 2)
                                        <a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                        <a href="{{route('etat_recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                        @else
                                        <a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>

                                        <a href="{{route('etat_recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                        @endif
                                    </div>
                                </div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        @if (auth()->user()->role_id == 2)
                                            <tr>
                                                <th></th>
                                                <th>N* Compte</th>
                                                <th>Client</th>
                                                <th>Marché</th>

                                                <th>Capital</th>
                                                <th>Intérêt</th>
                                                <th>Epargne</th>
                                                <th>Assurance</th>
                                                <th>Rétrait Ép.</th>
                                                <th>Pénalité</th>
                                                <th>Total</th>
                                                <th>Jours restant</th>




                                            </tr>
                                        @else
                                        <tr>
                                            <th>Agent</th>
                                            <th></th>
                                            <th>Date</th>
                                            <th>Capital</th>
                                            <th>Intérêt</th>
                                            <th>&Eacute;pargne</th>
                                            <th>Assurance</th>
                                            <th>Retrait &Eacute;pargne</th>
                                            <th>P&eacute;nalit&eacute;</th>
                                            <th style="background-color: #569ad2; color:white">Frais déblocage</th>
                                            <th style="background-color: #569ad2; color:white">Frais carte</th>
                                            <th style="background-color: #1cbb8c;; color: white ">Total</th>


                                        </tr>
                                        @endif

                                    </thead>


                                    <tbody>
                                        @if (auth()->user()->role_id == 2)
                                            @foreach ($recouvrements as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Credit->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td style = "text-transform:uppercase;">ABF-{{$item->Credit->Client['id']}}</td>
                                                    <td style = "text-transform:uppercase;">{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Credit->Client->Marche['libelle']}}</td>

                                                    <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>

                                                    <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->penalite, 0, ',', ' ')}} CFA</td>
                                                    @if ((\Carbon\Carbon::now() < $item->Credit['date_fin']) && (\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) != 0))
                                                        <td><div class="badge badge-soft-success font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin'])}} jours</div> </td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) == 0)
                                                        <td><div class="badge badge-soft-primary font-size-14">Aujourd'hui</div> </td>
                                                    @else
                                                        <td><div class="badge badge-soft-danger font-size-14">Délai expiré</div> </td>
                                                    @endif



                                                </tr>
                                            @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $total->sum('penalite') + $credit_j->sum('frais_deblocage') + $credit_j->sum('frais_carte')), 0, ',', ' ')}} CFA</td>
                                                    <td></td>

                                                </tr>
                                        @else
                                            @forelse ($recouvrements as $item)
                                                <tr style="background-color: #1cbb8c;; color: white ">
                                                    <td style = "text-transform:uppercase;">{{$item->User['nom']}} </td>
                                                    <td></td>
                                                    <td>{{\Carbon\Carbon::now()->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->getFraisDeblocageDay($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->getFraisCarteDay($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->penalite + $item->getFraisDeblocageDay($item->user_id) + $item->getFraisCarteDay($item->user_id)) , 0, ',', ' ')}} CFA</td>


                                                </tr>

                                            @empty
                                                <tr style="background-color: #1cbb8c;; color: white ">
                                                    <td style = "text-transform:uppercase;">Soumaïla Cissé</td>
                                                    <td></td>
                                                    <td>{{\Carbon\Carbon::now()->format('d-m-Y')}}</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>



                                                </tr>
                                                <tr style="background-color: #1cbb8c;; color: white ">
                                                    <td style = "text-transform:uppercase;">Awa Diallo</td>
                                                    <td></td>
                                                    <td>{{\Carbon\Carbon::now()->format('d-m-Y')}}</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>



                                                </tr>
                                                <tr style="background-color: #1cbb8c;; color: white ">
                                                    <td style = "text-transform:uppercase;">Awa Tounkara</td>
                                                    <td></td>
                                                    <td>{{\Carbon\Carbon::now()->format('d-m-Y')}}</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td>0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>
                                                    <td >0 CFA</td>



                                                </tr>
                                            @endforelse
                                            @foreach ($hier as $item)
                                                <tr>
                                                    <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-1</div></td>
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{\Carbon\Carbon::now()->subDays(1)->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->DeblocageHier($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->CarteHier($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageHier($item->user_id) + $item->CarteHier($item->user_id)) , 0, ',', ' ')}} CFA</td>


                                                </tr>
                                            @endforeach
                                            @foreach ($avant_hier as $item)
                                                <tr>
                                                    <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-2</div></td>
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{\Carbon\Carbon::now()->subDays(2)->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->DeblocageJ_2($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->CarteJ_2($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageJ_2($item->user_id) + $item->CarteJ_2($item->user_id) ) , 0, ',', ' ')}} CFA</td>


                                                </tr>
                                            @endforeach
                                            @foreach ($j_3 as $item)
                                                <tr>
                                                    <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-3</div></td>
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{\Carbon\Carbon::now()->subDays(3)->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->DeblocageJ_3($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->CarteJ_3($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageJ_3($item->user_id) + $item->CarteJ_3($item->user_id) ) , 0, ',', ' ')}} CFA</td>


                                                </tr>
                                            @endforeach

                                                @foreach ($j_4 as $item)
                                                <tr>
                                                    <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-4</div></td>
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{\Carbon\Carbon::now()->subDays(4)->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->DeblocageJ_4($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->CarteJ_4($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageJ_4($item->user_id) + $item->CarteJ_4($item->user_id) ) , 0, ',', ' ')}} CFA</td>


                                                </tr>
                                            @endforeach

                                            @foreach ($j_5 as $item)
                                                <tr>
                                                    <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-5</div></td>
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{\Carbon\Carbon::now()->subDays(5)->format('d-m-Y')}}</td>
                                                    <td >{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->penalite, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->DeblocageJ_5($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->CarteJ_5($item->user_id), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageJ_5($item->user_id) + $item->CarteJ_5($item->user_id) ) , 0, ',', ' ')}} CFA</td>


                                                </tr>
                                            @endforeach


                                        @endif
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div> <!-- end col -->


                </div> <!-- end row -->
                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6 ||  auth()->user()->role_id == 8)
                    <!-- start page title -->
                    <div class="row" id="web">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 text-success">STATISTIQUES  </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row" id="web">

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $total->sum('penalite') + $sum_frais_deblocage + $sum_frais_carte), 0, ',', ' ')}} CFA </button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;">{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>

                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($sum_frais_deblocage, 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($sum_frais_carte, 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white; text-align:right;">{{number_format($total->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->subDays(1)->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total_hier->sum('recouvrement_jrs') + $total_hier->sum('interet_jrs') + $total_hier->sum('epargne_jrs') + $total_hier->sum('assurance') + $total_hier->sum('penalite') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte') ), 0, ',', ' ')}} CFA</button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;" >{{number_format($total_hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total_hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total_hier->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total_hier->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total_hier->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($credits_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                            <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($credits_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white;text-align:right;">{{number_format($total_hier->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->subDays(2)->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total_j_2->sum('recouvrement_jrs') + $total_j_2->sum('interet_jrs')  + $total_j_2->sum('epargne_jrs') + $total_j_2->sum('assurance') + $total_j_2->sum('penalite') + $credits_j_2->sum('frais_deblocage') + $credits_j_2->sum('frais_carte')), 0, ',', ' ')}} CFA</button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;">{{number_format($total_j_2->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total_j_2->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total_j_2->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total_j_2->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total_j_2->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($credits_j_2->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($credits_j_2->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white;text-align:right;">{{number_format($total_j_2->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->subDays(3)->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total_j_3->sum('recouvrement_jrs') + $total_j_3->sum('interet_jrs') + $total_j_3->sum('epargne_jrs') + $total_j_3->sum('assurance') + $total_j_3->sum('penalite') + $credits_j_3->sum('frais_deblocage') + $credits_j_3->sum('frais_carte')), 0, ',', ' ')}} CFA</button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;">{{number_format($total_j_3->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total_j_3->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total_j_3->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total_j_3->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total_j_3->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($credits_j_3->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($credits_j_3->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white; text-align:right;">{{number_format($total_j_3->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->subDays(4)->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total_j_4->sum('recouvrement_jrs') + $total_j_4->sum('interet_jrs') + $total_j_4->sum('epargne_jrs') + $total_j_4->sum('assurance') + $total_j_4->sum('penalite') + $credits_j_4->sum('frais_deblocage') + $credits_j_4->sum('frais_carte')), 0, ',', ' ')}} CFA </button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;">{{number_format($total_j_4->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total_j_4->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total_j_4->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total_j_4->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total_j_4->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($credits_j_4->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($credits_j_4->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white; text-align:right;">{{number_format($total_j_4->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="font-size-18 mb-4">{{\Carbon\Carbon::now()->subDays(5)->format('d-m-Y')}} <button class="btn btn-success btn-block btn-xl">Total : {{number_format(($total_j_5->sum('recouvrement_jrs') + $total_j_5->sum('interet_jrs') + $total_j_5->sum('epargne_jrs') + $total_j_5->sum('assurance') + $total_j_5->sum('penalite') + $credits_j_5->sum('frais_deblocage') + $credits_j_5->sum('frais_carte')), 0, ',', ' ')}} CFA </button></div>
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="font-size: 16px">
                                            <th><b>Désignations</b> </th>
                                            <th style="text-align:right;"><b>Total</b> </th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Capital recouvré</td>
                                            <td style="text-align:right;">{{number_format($total_j_5->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Intérêt net</td>
                                            <td style="text-align:right;">{{number_format($total_j_5->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Épargne</td>
                                            <td style="text-align:right;">{{number_format($total_j_5->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Assurance</td>
                                            <td style="text-align:right;">{{number_format($total_j_5->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Pénalité</td>
                                            <td style="text-align:right;">{{number_format($total_j_5->sum('penalite'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais déblocage</td>
                                            <td style="text-align:right;">{{number_format($credits_j_5->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td>Frais carte</td>
                                            <td style="text-align:right;">{{number_format($credits_j_5->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #569ad2; color: white">Retrait Épargne</td>
                                            <td style="background-color: #569ad2; color: white;text-align:right;">{{number_format($total_j_5->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->


                    @endif
                </div>
            </div> <!-- container-fluid -->




        </div>
            <!-- End Page-content -->
    </div>

@endsection

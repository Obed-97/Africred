@section('title', 'Encours Global')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @php
                $sum_montant = 0;
                $sum_interet = 0;
                $sum_epargne = 0;
                $sum_retrait = 0;
                $sum_frais_deblocage = 0;
                $sum_frais_carte = 0;
                $sum_montant_interet = 0;
                $encours = 0;
                foreach($credits as $credit){
                    $sum_montant = $credit->totalRecouv() + $sum_montant ;
                    $sum_interet = $credit->totalIntreret() + $sum_interet ;
                    $sum_epargne = $credit->totalEpargne() + $sum_epargne ;
                    $sum_retrait = $credit->totalRetrait() + $sum_retrait;
                    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                    $sum_montant_interet = $credit->montant_interet + $sum_montant_interet;
                    $encours = $credit->encours($credit->montant_interet) + $encours;
                }
            @endphp
            <div class="page-content">
               
                <div class="container-fluid">
                    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" >
                            <form action="{{route('etat_actualise.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-map-pin-time-line  align-middle mr-2"></i> Rééchelonnement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
            
                                <div class="modal-body">
                                    
                                    <div class="form-group">
                                        <label class="control-label">Client <b class="text-danger">*</b></label>
                                        <select class="form-control select2" name="credit_id" required>
                                            @foreach ($credits as $item)
                                            <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->encours($item->montant_interet)}}" >
                                                {{$item->Client['nom_prenom']}} : {{number_format(($item->encours($item->montant_interet)), 0, ',', ' ')}} CFA  //
                                                
                                                @if($item->date_fin_r == NULL)

                                                    @if ((\Carbon\Carbon::now() > $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0) && (intval(($item->encours(($item->montant_interet))))) != 0)
                                                       Retard : {{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jours
                                                    @else
                                                       Pas de retard
                                                    @endif
                                                
                                                @else
                                                    @if ((\Carbon\Carbon::now() > $item->date_fin_r) && (\Carbon\Carbon::now()->diffInDays($item->date_fin_r) != 0) && (intval(($item->encours(($item->montant_interet))))) != 0)
                                                       Retard : {{\Carbon\Carbon::now()->diffInDays($item->date_fin_r)}} jours
                                                    @else
                                                        Pas de retard
                                                    @endif
                                                @endif
                                                
                                                
                                            </option>
                                           @endforeach
                                        </select>
                                        
                                    </div>
                                    
                                   
                                    <div class="row">
                                        <div class="col-7 form-group ">
                                        <label>Date rééchelonnement <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="date" name="date_r"  id="date_r" required>
                                        </div>
                                     </div>
                                    <div class="col-5 form-group ">
                                        <label>Délai (max 40 jours) <b class="text-danger">*</b></label>
                                        <div>
                                            <input class="form-control" type="number" name="n_delai" min="0" max="40" id="n_delai" required>
                                        </div>
                                    </div>
                                    </div>
                                  <div class="form-group mb-4 ">
                                    <label>Motif du rééchelonnement <b class="text-danger">*</b></label>
                                    <div>
                                        <textarea class="form-control" name="motif_r" id="" cols="5" rows="2" required></textarea>
                                    </div>
                                </div>
                          
            
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                    <button class="btn btn-info waves-effect waves-light" type="submit"><i class="ri-map-pin-time-line  align-middle mr-2"></i> Rééchelonner</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
 
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Encours &nbsp; Global &nbsp; : &nbsp; {{number_format($encours, 0, ',', ' ')}} CFA</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Encours Global</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2" id="web">
                           <a href="{{route('etat_encours_global.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class="ri-pushpin-fill  align-middle mr-2"></i>ENCOURS S.I</a> 
                           
                        
                        </div>
                        <div class="col-xl-2" id="web">
                             <a href="{{route('etat_actualise.create')}}" class="btn btn-danger btn-block  waves-effect waves-light"><i class="ri-pushpin-fill  align-middle mr-2"></i>CR&Eacute;DITS IMPAY&Eacute;S</a> 
                        </div>
                        <div class="col-xl-4" id="web">
                           
                        </div>
                        <div class="col-xl-2" id="web">
                           
                        </div>
                        <div class="col-xl-2"><a href="{{route('journalier.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class="ri-funds-box-fill  align-middle mr-2"></i>DÛS JOURNALIERS</a></div>
                    </div>
            
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                       
                                            <button type="button" class="btn btn-info waves-effect waves-light mb-3" data-toggle="modal" data-target="#staticBackdrop">
                                        
                                                <i class="ri-map-pin-time-line  align-middle mr-2"></i> Rééchelonnement
                                            </button>
                                     
                                    </h4>
                                   
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Client</th>
                                                <td>Marché</td>
                                                <td>Téléphone</td>
                                                <th>Prêt + Intérêt</th>
                                                <th>Capital recouvré</th>
                                                <th>Intérêt recouvré</th>
                                                <th>&Eacute;pargne recouvrée </th>
                                                <th>Encours global</th>
                                                <th>Date limite</th>
                                                <th>Jours restant</th>
                                                <th>Retard</th>
                                                
                                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                <th>Agent</th>
                                                <th>Agent</th>
                                                @endif
                                                
                                            </tr>

                                        </thead>


                                        <tbody>
                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td style = "text-transform:uppercase;">
                                                        {{$item->Client['nom_prenom']}}
                                                        @if($item->reecheloner == 'oui')
                                                        
                                                        <div class="badge badge-soft-danger font-size-12">R</div>
                                                        
                                                        @endif
                                                    </td>
                                                        @if($item->marche == '')
                                                         <td>  </td>
                                                        @else
                                                         <td>{{$item->Marche['libelle']}}</td>
                                                        @endif
                                                    <td>{{$item->Client['telephone']}}</td>
                                                    <td>
                                                        
                                                        @if($item->n_montant == 0)
                                                         {{number_format(($item->montant_interet), 0, ',', ' ')}} CFA 
                                                        @else
                                                        <div class="badge badge-soft-danger font-size-14"> {{number_format(($item->montant_interet), 0, ',', ' ')}} CFA </div><br>
                                                        <div class="badge badge-soft-success font-size-14"> {{number_format(($item->n_montant), 0, ',', ' ')}} CFA </div>
                                                        @endif
                                                    </td>
                                                    <td >{{number_format($item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                  
                                                    <td >{{number_format($item->totalIntreret(), 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format(($item->totalEpargne() - $item->totalRetrait()), 0, ',', ' ')}} CFA</td>
                                                    @if(($item->encours($item->montant_interet)) < 0 )
                                                    
                                                    <td  class="text-danger">{{number_format(($item->encours($item->montant_interet)), 0, ',', ' ')}} CFA  <div class="badge badge-soft-danger font-size-14">(Erreur)</div></td>
                                                    
                                                    @else
                                                    
                                                    
                                                    <td >{{number_format($item->encours(($item->montant_interet)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    @if($item->date_fin_r == NULL)
                                                    <td >{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                                    @else
                                                    <td >{{(new DateTime($item->date_fin_r))->format('d-m-Y')}} </td>
                                                    @endif
                                                    
                                                    @if($item->date_fin_r == NULL)
                                                    
                                                        @if ((\Carbon\Carbon::now() < $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0))
                                                            <td><div class="badge badge-soft-success font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jours</div></td>
                                                        @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin) == 0)
                                                            <td><div class="badge badge-soft-primary font-size-14">Aujourd'hui</div> </td>
                                                        @else
                                                            <td><div class="badge badge-soft-danger font-size-14">Délai expiré</div> </td>
                                                        @endif
                                                    @else
                                                        @if ((\Carbon\Carbon::now() < $item->date_fin_r) && (\Carbon\Carbon::now()->diffInDays($item->date_fin_r) != 0))
                                                            <td><div class="badge badge-soft-success font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->date_fin_r)}} jours</div></td>
                                                        @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin_r) == 0)
                                                            <td><div class="badge badge-soft-primary font-size-14">Aujourd'hui</div> </td>
                                                        @else
                                                            <td><div class="badge badge-soft-danger font-size-14">Délai expiré</div> </td>
                                                        @endif
                                                    @endif
                                                    
                                                    @if($item->date_fin_r == NULL)

                                                        @if ((\Carbon\Carbon::now() > $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0) && (intval(($item->encours(($item->montant_interet))))) != 0)
                                                            <td><div class="badge badge-soft-danger font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jours</div></td>
                                                        @else
                                                            <td><div class="badge badge-soft-success font-size-14">Pas de retard</div></td>
                                                        @endif
                                                    
                                                    @else
                                                        @if ((\Carbon\Carbon::now() > $item->date_fin_r) && (\Carbon\Carbon::now()->diffInDays($item->date_fin_r) != 0) && (intval(($item->encours(($item->montant_interet))))) != 0)
                                                            <td><div class="badge badge-soft-danger font-size-14">{{\Carbon\Carbon::now()->diffInDays($item->date_fin_r)}} jours</div></td>
                                                        @else
                                                            <td><div class="badge badge-soft-success font-size-14">Pas de retard</div></td>
                                                        @endif
                                                    @endif
                                                    
                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                    <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{$item->User['nom']}}</td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td >{{number_format($sum_montant_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_montant , 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_epargne - $sum_retrait, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($encours, 0, ',', ' ')}} CFA</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                        <td></td>
                                                        <td></td>
                                                    @endif                                                   
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                      <!-- start page title -->
                      
                 
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection

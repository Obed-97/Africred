@section('title', 'Recouvrement')

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
                                <h4 class="mb-0 text-success">Le &nbsp; {{(new DateTime($date))->format('d-M-Y')}} &nbsp;: &nbsp;{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance')), 0, ',', ' ')}} CFA </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement Global</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2" id="web">
                            
                            <button type="button" class="btn btn-primary btn-block waves-effect waves-light" data-toggle="modal" data-target="#arrete">
                                <i class="ri-survey-line  align-middle mr-2"></i> ÉTATS D'ARRÊTÉ
                            </button>
                        
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
                        <div class="col-xl-2"><a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-block  waves-effect waves-light"><i class=" ri-bank-line  align-middle mr-2"></i> ÉTAT DU JOUR</a></div>
                    </div>
            
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="ri-calendar-check-line align-middle mr-2"></i> Recouvrement
                                            </button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('recouvrement.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-calendar-check-line align-middle mr-2"></i> Recouvrement journalier</h5>
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
                                                                @foreach ($credits as $item)
                                                                <option value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->type_id}}">
                                                                    {{$item->Client['nom_prenom']}} -- {{number_format($item->montant_interet, 0, ',', ' ')}} CFA 
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
                                                            <div class="col-6 form-group ">
                                                                <label>Epargne</label>
                                                                <div>
                                                                    <input class="form-control" type="number" name="epargne_jrs" min="0"  id="epargne_jrs" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 form-group ">
                                                                <label>Assurance</label>
                                                                <div>
                                                                    <input class="form-control" type="number" name="assurance" min="0" id="assurance" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="ri-calendar-check-line align-middle mr-2"></i> Recouvrir</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
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
                                                
                                                @if (auth()->user()->role_id == 2)
                                                <label for="">Afficher par :</label>
                                                <a href="#" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                @else
                                                <label for="">Afficher par :</label>
                                                <a href="#" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                @endif
                                            </div>
                                        </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if (auth()->user()->role_id == 2)
                                                <tr>
                                                    <th></th>
                                                    <th>Client</th>
                                                    <th>Marché</th>
                                                  
                                                    <th>Capital du jour</th>
                                                    <th>Intérêt du jour</th>
                                                    <th>Epargne du jour</th>
                                                    <th>Assurance</th>
                                                    <th>Retrait Ép.</th>
                                                    <th>Total</th>
                                                    <th>Jours restants</th>
                                                    
                                                </tr>
                                            @else
                                            <tr>
                                                <th>Agent</th>
                                                <th></th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                               
                                                <th>Total</th>
                                               
                                            </tr>
                                            @endif

                                        </thead>


                                        <tbody>
                                            @if (auth()->user()->role_id == 2)
                                                @foreach ($recouvrements as $item)
                                                   <tr>
                                                       <td><img src="/assets/images/users/{{$item->Credit->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                        <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                        
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                                        
                                                        <td>{{number_format($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance, 0, ',', ' ')}} CFA</td> 
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
                                                        <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('retrait'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance')), 0, ',', ' ')}} CFA</td>
                                                        <td></td>
                                                                                                            
                                                    </tr>
                                            @else
                                               @foreach ($recouvrements as $item)
                                                    <tr style="background-color: #1cbb8c;; color: white ">
                                                        <td>{{$item->User['nom']}}</td>
                                                        <td></td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                       
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                
                                                @endforeach
                                                
                                                @foreach ($hier as $item)
                                                    <tr>
                                                        <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-1</div></td>
                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                                @foreach ($avant_hier as $item)
                                                    <tr>
                                                        <td>{{$item->User['nom']}}  <div class="badge badge-soft-success font-size-12">J-2</div></td>
                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                         
                    </div> <!-- end row -->
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-4 col-xl-4">
                                            <label for="">Afficher par :</label>
                                            <a href="#" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                        </div>
                                    </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if (auth()->user()->role_id == 2)
                                                <th>Marché</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                                
                                                <th>Total</th>
                                            @else
                                            <tr>
                                                <th>Marché</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                               <th class="text-success">Total</th>
                                            </tr>
                                            @endif

                                        </thead>

                                        <tbody>
                                            @if (auth()->user()->role_id == 2)
                                                @foreach ($par_marche as $item)
                                                   <tr>
                                                       
                                                        <td>{{$item->Marche['libelle']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        
                                                        <td>{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                                    <tr style="background-color: #1cbb8c; color: white ">
                                                        <td></td>
                                                        
                                                        <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                        
                                                        <td>{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') ), 0, ',', ' ')}} CFA</td>
                                                       
                                                                                                            
                                                    </tr>
                                            @else
                                            @foreach ($par_marche as $item)
                                                <tr>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                    

                                                </tr>
                                            @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    
                                                    <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                    
                                                    <td>{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') ), 0, ',', ' ')}} CFA</td>
                                                   
                                                                                                        
                                                </tr>
                                            @endif
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

@section('title', 'Recouvrement')

@extends('master')

@section('content')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                   
                    
                    
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">
                                     Le &nbsp;
                                    <?php
                                    echo date('d-m-Y');
                                    ?>  &nbsp; :  &nbsp; {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte') ), 0, ',', ' ')}} CFA
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
                        <div class="col-xl-4" id="web">
                           <form  method="POST" action="{{route('date.store')}}" class="d-flex mb-4">
                               @csrf
                               <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                               <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                           </form>
                        </div>
                          <div class="col-xl-6" id="web">
                               
                           </div> 
                           <div class="col-xl-2"><a href="{{route('recouvrement.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"><i class=" ri-bank-line align-middle mr-2"></i> ÉTAT GLOBAL</a></div>
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
                                                   
                                                    <th>Marché</th>
                                                    <th>Capital à ce jour</th>
                                                    <th>Intérêt à ce jour</th>
                                                    <th>Epargne à ce jour</th>
                                                    <th>Assurance</th>
                                                    <th style="background-color: #569ad2; color:white">Frais déblocage</th>
                                                    <th style="background-color: #569ad2; color:white">Frais carte</th>
                                                    <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                                    
                                                </tr>
                                            @else
                                            <tr>
                                                <th>Marché</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                                <th style="background-color: #569ad2; color:white">Frais déblocage</th>
                                                <th style="background-color: #569ad2; color:white">Frais carte</th>
                                                <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                               
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
                                                        <td>{{number_format($item->getFraisDeblocageDayMarche($item->marche_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->getFraisDeblocageDayMarche($item->marche_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                                    <tr style="background-color: #1cbb8c; color: white ">
                                                        <td></td>
                                                        
                                                        <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
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
                                                        <td>{{number_format($item->getFraisDeblocageDayMarche($item->marche_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->getFraisDeblocageDayMarche($item->marche_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                                    <tr style="background-color: #1cbb8c; color: white ">
                                                        <td></td>
                                                        
                                                        <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte') ), 0, ',', ' ')}} CFA</td>
                                                       
                                                                                                            
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
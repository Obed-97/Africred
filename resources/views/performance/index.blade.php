@section('title', 'Recouvrement')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
        
            <div class="page-content">
                <div class="container-fluid">
                    <div class="modal fade" id="performance" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <form action="{{route('performance.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="ri-survey-line  align-middle mr-2"></i>Performance de recouvrement </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    
                        <div class="row">
                            
                            <div class="col-xl-6">
                                    <div class="form-group">
                                    <label>De</label>
                                    <input class="form-control" type="date" name="date_d">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                    <div class="form-group ">
                                    <label>&Agrave;</label>
                                    <input class="form-control" type="date" name="date_f">
                                </div>
                            </div>
                            
                             <div class="col-xl-12">
                                 <div class="form-group ">
                                    <label>Performance par :</label>
                                    <select class="form-control" name="id" required>
                                        
                                        <option value="agent">AGENT</option>
                                        <option value="marche">MARCH&Eacute;</option>
                                        <option value="credit">CLIENT</option>
                                        <option value="ab_sugu">ABEYAN SUGU</option>
                                        
                                    </select>
                                </div>
                             </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-info waves-effect waves-light" type="submit"><i class="ri-survey-line  align-middle mr-1"></i> Afficher</button>
                </div>
            </div>
        </form>
        </div>
    </div>
                   
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Recouvrement &nbsp; DU &nbsp; {{(new DateTime($date_d))->format('d-m-Y')}} ---> {{(new DateTime($date_f))->format('d-m-Y')}} </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    
            
                    <div class="row">
                        <div class="col-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                     <a href="#" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#performance" id="web">PERFORMANCE</a>
                                        
                                    
                                   </h4>
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if ($id == 'credit')
                                                <tr>
                                                    <th></th>
                                                    <th>Client</th>
                                                    <th>March&eacute;</th>
                                                    
                                                    <th>Capital</th>
                                                    <th style="background-color: #1cbb8c;; color: white ">Int&eacute;r&ecirc;t</th>
                                                    <th>Epargne</th>
                                                    <th>Assurance</th>
                                                    <th>Total</th>
                                                    
                                                </tr>
                                            @elseif($id == 'agent')
                                            <tr>
                                                <th></th>
                                                <th>Agent</th>
                                                <th>Capital </th>
                                                <th style="background-color: #1cbb8c;; color: white ">Int&eacute;r&ecirc;t</th>
                                                <th>Epargne </th>
                                                <th>Assurance</th>
                                                
                                                <th>Total</th>
                                               
                                            </tr>
                                            @elseif($id == 'marche')
                                            
                                            <tr>
                                                
                                                <th>March&eacute;</th>
                                                <th>Capital </th>
                                                <th style="background-color: #1cbb8c;; color: white ">Int&eacute;r&ecirc;t</th>
                                                <th>Epargne </th>
                                                <th>Assurance</th>
                                                
                                                <th>Total</th>
                                               
                                            </tr>
                                            @elseif($id == 'ab_sugu')
                                            <tr>
                                                <th></th>
                                                <th>Client</th>
                                                <th>March&eacute;</th>
                                                <th>Capital</th>
                                                <th style="background-color: #1cbb8c;; color: white ">Int&eacute;r&ecirc;t</th>
                                                <th>Epargne</th>
                                                <th>Assurance</th>
                                                <th>Total</th>
                                                
                                            </tr>
                                            @endif

                                        </thead>


                                        <tbody>
                                            @if ($id == 'credit')
                                                @foreach ($recouvrements as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->Credit->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                        <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                        
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td> 
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td> 
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance ) , 0, ',', ' ')}} CFA</td>
                                               
                                                    </tr>
                                                @endforeach
                                                    
                                            @elseif($id == 'agent')
                                               @foreach ($recouvrements as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->User['nom']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs , 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance ) , 0, ',', ' ')}} CFA</td>
                                                    </tr>
                                                @endforeach
                                            @elseif($id == 'marche')       
                                                @foreach ($recouvrements as $item)
                                                    <tr>
                                                        
                                                        <td>{{$item->Marche['libelle']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs , 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance ) , 0, ',', ' ')}} CFA</td>
                                                    </tr>
                                                @endforeach
                                            @elseif($id == 'ab_sugu')
                                                @foreach ($recouvrements as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->Credit->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                        <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                        
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td> 
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td> 
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance ) , 0, ',', ' ')}} CFA</td>
                                               
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if ($id == 'credit')
                                                <tr>
                                                    <th></th>
                                                    <th>Client</th>
                                                    <th>Frais d&eacute;blocage</th>
                                                    
                                                    <th>Frais carte</th>
                                                    
                                                    <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                                    
                                                    
                                                </tr>
                                            @elseif($id == 'agent')
                                            <tr>
                                                <th></th>
                                                <th>Agent</th>
                                                <th>Frais d&eacute;blocage</th>
                                                    
                                                <th>Frais carte</th>
                                                
                                                <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                               
                                            </tr>
                                            @elseif($id == 'marche')
                                            
                                            <tr>
                                                <th>March&eacute;</th>
                                                <th>Frais d&eacute;blocage</th>
                                                    
                                                <th>Frais carte</th>
                                                
                                                <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                               
                                            </tr>
                                            
                                            @endif

                                        </thead>


                                        <tbody>
                                            @if ($id == 'credit')
                                                @foreach ($credits as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->Client['nom_prenom']}}</td>
                                                        <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td> 
                                                       
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format(($item->frais_deblocage + $item->frais_carte ) , 0, ',', ' ')}} CFA</td>
                                               
                                                    </tr>
                                                @endforeach
                                                    
                                            @elseif($id == 'agent')
                                               @foreach ($credits as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->User['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->User['nom']}}</td>
                                                        <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td> 
                                                       
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format(($item->frais_deblocage + $item->frais_carte ) , 0, ',', ' ')}} CFA</td>
                                                    </tr>
                                                @endforeach
                                            @elseif($id == 'marche')       
                                                @foreach ($credits as $item)
                                                    <tr>
                                                        
                                                        <td>{{$item->Marche['libelle']}}</td>
                                                        <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td> 
                                                       
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format(($item->frais_deblocage + $item->frais_carte ) , 0, ',', ' ')}} CFA</td>
                                                    </tr>
                                                @endforeach
                                            @elseif($id == 'ab_sugu')
                                                @foreach ($credits as $item)
                                                    <tr>
                                                        <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                        <td>{{$item->Client['nom_prenom']}}</td>
                                                        <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td> 
                                                        <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td> 
                                                       
                                                        <td style="background-color: #1cbb8c;; color: white ">{{number_format(($item->frais_deblocage + $item->frais_carte ) , 0, ',', ' ')}} CFA</td>
                                               
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                         
                    </div> <!-- end row -->
                  

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection
@section('title', 'Dossier credit')

@extends('master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <div class="row" >
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="col-xl-2"><a href="{{URL::previous()}}" class="btn  btn-primary waves-effect waves-light"><i class="ri-arrow-go-back-fill"></i></a></div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0" id="web">
                           
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="container mt-4 mb-4" style=" border:1px solid white; background-color: white; color: black;">
            <div class="row mt-4 mb-4">
                <div class="col-1"></div>
                <div class="col-md-5 ">
                    <img src="{{asset('assets/images/AB-FINANCE.png')}}">
                </div>
                
            </div>
            <div class="text-center mt-4 ">
                <H4><b>CEC-BS-PRODUIT-ABEYAN-FINANCE </b> </H4>
                <p>Agr&eacute;&eacute;e suivant D&eacute;cision No0100075 MEF-SG du 20 Juillet 2001 <br>
                Bamako - Mali <br>
                Adresse : Kanadjiguila <br>
                T&eacute;l : 20 20 05 66 / 83 88 88 04 / 61 53 53 56</p>
            </div>
            <div class="text-center mt-2 mb-2">
                <H4><u><b>MEMORANDUM DE CRÉDIT </b></u> </H4>
            </div>

            <div class="row mt-4 mb-3" >
                <div class="col-1">
                   
                    
                </div>
               
                <div class="col-md-5" style="border:2px solid black; ">
                    <ul style="text-align: justify; font-size: 20px" class="mt-2">
                        <li style="list-style-type: none;">
                            <h6>CLIENT : <b style = "text-transform:uppercase;"> {{$client->nom_prenom}}</b></h6>
                        </li>
                        
                        <li style="list-style-type: none;">
                            <h6>ACTIVITÉ : <b style = "text-transform:uppercase;">{{$client->activite}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>DATE DE CRÉATION : <b style = "text-transform:uppercase;"></b></h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>DATE D'ENTRÉE EN RELATION : <b style = "text-transform:uppercase;">{{(new DateTime($client->created_at))->format('M-Y')}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>AGENT DE CRÉDIT : <b style = "text-transform:uppercase;"> {{$client->User['nom']}}</b> </h6>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-5" style="border:2px solid black; border-left: none;">
                    <ul style="text-align: justify; font-size: 20px" class="mt-2">
                        <li style="list-style-type: none;">
                            <h6>COMPTE COURANT : <b style = "text-transform:uppercase;"> ABF-{{$client->id}} </b></h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6>COTATION DU RISQUE : <b style = "text-transform:uppercase;"> </b> </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6>FORME JURIDIQUE : <b style = "text-transform:uppercase;">{{$client->forme_juridique}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>CAPITAL SOCIAL : <b style = "text-transform:uppercase;"></b></h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>RENOUVELLEMENT : <b style = "text-transform:uppercase;"><div class="badge badge-soft-success font-size-15">{{$renouvellement->count()}} &nbsp; fois </div></b></h6>
                        </li>
                        
                        
                        
                    </ul>
                </div>
                <div class="col-1">
                   
                    
                </div>
               
            </div>
            <div class="text-center mt-2 mb-4">
                <H5><u><b>SITUATION ACTUELLE </b></u></H5>
            </div>
            
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="table border dt-responsive nowrap table-bordered" style = "color: black;" >
                        <thead class="thead-light">
                            <tr>
                                <th>Nature du prêt</th>
                                <th>Déblocage</th>
                                <th>Échéance</th>
                                <th>Montant </th>
                                <th>Int&eacute;r&ecirc;t </th>
                                
                                <th>Frais carte</th>
                                <th>Frais d&eacute;blocage</th>
                                <th>Statut du prêt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($credits as $item)
                            <tr>
                                <td >{{$item->Type['libelle']}} </td>
                                <td >{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                @if(\Carbon\Carbon::now() < $item->date_fin)
                                <td class="text-success">{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                @else
                                <td class="text-danger">{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                @endif
                                <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                               
                               <td>{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                               
                               <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                               <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                               @if($item->encours(($item->montant_interet)) > 0)
                               <td> <b><i class="ri-spam-3-line font-size-15 text-danger"></i>  {{number_format($item->encours(($item->montant_interet)), 0, ',', ' ')}} CFA</b></td>
                               @else
                               <td><div class="badge badge-soft-success font-size-14"><i class="ri-check-line align-middle mr-2"></i> Soldé</div></td>
                               @endif
                               
                            </tr>
                            @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                               <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                                <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                                <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            @endforelse
                        </tbody>
                        
                        <thead class="thead-light text-success">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>TOTAUX</th>
                                <th>{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</th>
                                <th>{{number_format($credits->sum('interet'), 0, ',', ' ')}} CFA</th>
                                
                                <th>{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</th>
                                <th>{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="text-center mt-2 mb-2">
                <H5><u><b>CONCOURS SOLLICITES </b></u></H5>
            </div>
            <div class="row mt-4 mb-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="table border dt-responsive nowrap table-bordered" style = "color: black;" >
                        <thead class="thead-light">
                            <tr>
                                <th>Nature du prêt</th>
                                <th>Date de demande</th>
                                <th>Montant </th>
                                <th>Int&eacute;r&ecirc;t </th>
                                
                                <th>Frais carte</th>
                                <th>Frais d&eacute;blocage</th>
                                <th>Statut du prêt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($credits_attente as $item)
                            <tr>
                                <td >{{$item->Type['libelle']}} </td>
                                <td >{{(new DateTime($item->created_at))->format('d-m-Y')}} </td>
                                <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                               
                               <td>{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                               
                               <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                               <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                               <td><div class="badge badge-soft-warning font-size-14"><i class="ri-error-warning-line align-middle mr-2"></i> {{$item->statut}}</div></td>
                            </tr>
                            @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                               <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                                <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                                <td></td>
                               
                               <td></td>
                               <td></td>
                               <td></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        
        <div class="row ml-2 mt-4 mb-3">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u>AGENT DE CRÉDIT</u></b></h5>
           
            </div>
            
            <div class="col-md-3 mb-5">
                <h5> <b><u>RESPONSABLE</u></b></h5>
                <img src="{{asset('assets/images/siganture.png')}}" width="135" height="135">
            </div>
        </div>
       
       
        
        <div class="row ml-2 ">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u></u></b></h5> 
            </div>
            <div class=" col-md-2 mb-5">
                <h5> <b><u> </u></b></h5> 
            </div>
        </div>
        
        <div class="mt-2"></div>
        <div class="text-center mt-4 ">
           
            <p style="font-size: 12px; color: black">CECB NoA2/01.0459 <br>
            Adresse : Faladj&egrave; SEMA, AVENUE OUA Porte <br>
            Site web : finance.abeyan.com // 20 20 05 66 / 71 39 39 27 / 61 37 37 76</p>
        </div>
    </div>

</div>
</div>
</div>


@endsection
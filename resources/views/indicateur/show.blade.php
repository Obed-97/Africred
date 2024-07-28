@section('title', 'Recu de paiement')

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
                    <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="75">
                </div>
                
            </div>
            <div class="text-center mt-4 ">
                <H2><b>R&Eacute;&Ccedil;U DE PAIEMENT </b> </H2>
                <img src="/assets/images/users/{{$credit->Client['image']}}" alt="" class="rounded avatar-lg">
            </div>
            <div class="text-center mt-2 mb-2">
                <H3><b>{{$credit->Client['nom_prenom']}} </b></H3>
            </div>

            <div class="row mt-4 mb-3" >
                <div class="col-1">
                   
                    
                </div>
               
                <div class="col-md-5" style="border:2px solid black; ">
                    <ul style="text-align: justify; font-size: 20px" class="mt-2">
                        <li style="list-style-type: none;">
                            <h6>ACTIVIT&Eacute; : <b style = "text-transform:uppercase;">{{$credit->Client['activite']}}</b> </h6>
                        </li>
                        
                        <li style="list-style-type: none;" >
                            <h6>DATE CR&Eacute;ATION DE COMPTE : <b style = "text-transform:uppercase;">{{(new DateTime($credit->Client['created_at']))->format('d-M-Y')}}</b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6 >(Ca+In) RECOUVR&Eacute;S : <b style = "text-transform:uppercase;"> <div class="badge badge-soft-success font-size-15">{{number_format($credit->totalRecouv() + $credit->totalIntreret() , 0, ',', ' ')}} CFA </div></b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6 >ÉPARGNE RECOUVR&Eacute;E : <b style = "text-transform:uppercase;"> <div class="badge badge-soft-success font-size-15">{{number_format($credit->totalEpargne() , 0, ',', ' ')}} CFA </div></b> </h6>
                        </li>
                        <li style="list-style-type: none;" >
                            <h6>AGENT DE CR&Eacute;DIT : <b style = "text-transform:uppercase;"> {{$credit->Client->User['nom']}}</b> </h6>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-5" style="border:2px solid black; border-left: none;">
                    <ul style="text-align: justify; font-size: 20px" class="mt-2">
                        <li style="list-style-type: none;">
                            <h6>NUM&Eacute;RO DE COMPTE : <b style = "text-transform:uppercase;"> ABF-{{$credit->Client['id']}} </b></h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6>CAPITAL ENCOURS : <b style = "text-transform:uppercase;"> <div class="badge badge-soft-primary font-size-15">{{number_format($credit->montant, 0, ',', ' ')}} CFA </div></b> </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6 >ENCOURS S.I : <b style = "text-transform:uppercase;"><div class="badge badge-soft-danger font-size-15"> {{number_format($credit->solde(($credit->montant)), 0, ',', ' ')}} CFA </div></b> </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6 >ENCOURS GLOBAL : <b style = "text-transform:uppercase;"><div class="badge badge-soft-danger font-size-15"> {{number_format($credit->encours(($credit->montant_interet)), 0, ',', ' ')}} CFA </div></b> </h6>
                        </li>
                        <li style="list-style-type: none;">
                            <h6 >IMPAYES : <b style = "text-transform:uppercase;"><div class="badge badge-soft-danger font-size-15"> {{($credit->nbre_jrs - $credit->impaye($credit->date_deblocage, \Carbon\Carbon::now()))}} </div></b> </h6>
                        </li>
                        
                        <li style="list-style-type: none;" >
                            <h6>RENOUVELLEMENT : <b style = "text-transform:uppercase;"><div class="badge badge-soft-success font-size-15">{{$credits}} &nbsp; fois </div></b></h6>
                        </li>
                        
                        
                        
                    </ul>
                </div>
                <div class="col-1">
                   
                    
                </div>
               
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date de paiement</th>
                                            <th>Capital recouvr&eacute;</th>
                                            <th>Intérêt recouvr&eacute;</th>
                                            <th>Épargne recouvr&eacute;e</th>
                                            <th>Assurance recouvr&eacute;e</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recouvrements as $item)
                                            <tr>
                                                <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                                <td>{{number_format(($item->recouvrement_jrs) , 0, ',', ' ')}} CFA</td>
                                                <td>{{number_format(($item->interet_jrs) , 0, ',', ' ')}} CFA</td>
                                                <td>{{number_format(($item->epargne_jrs) , 0, ',', ' ')}} CFA</td>
                                                <td>{{number_format(($item->assurance) , 0, ',', ' ')}} CFA</td>
                                                <td>{{number_format(( $item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                
                                            </tr>
                                        @endforeach
                                        <tr style="background-color: #1cbb8c; color: white ">
                                            <td></td>
                                            <td>{{number_format($recouvrements->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($recouvrements->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($recouvrements->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($recouvrements->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            <td>{{number_format($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs')+ $recouvrements->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        </tr>

                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
           
          
        
        <div class="row ml-2 mt-4 mb-3">
            <div class="col-1"></div>
            <div class="col-md-8 mb-5">
            <h5><b><u>AGENT DE CR&Eacute;DIT</u></b></h5>
           
            </div>
            
            <div class="col-md-3 mb-5">
                <h5> <b><u>RESPONSABLE</u></b></h5>
                
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
        
    </div>

</div>
</div>
</div>


@endsection
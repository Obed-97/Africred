@section('title', 'Solde épargne')

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
        <div class="container mt-4 mb-4" style=" border:1px solid white; background-color:rgb(240, 128, 128); color:black">
            <div class="row mt-4 mb-4 text-center">
               
                <div class="col-md-5 ">
                    <h5 ><b> </b> </h5>
                     <p ><br>
                    
                    </p>
                   
                    <img src="{{asset('assets/images/AB-FINANCE.png')}}"><br>
                    <h5 ><b>CEC-BS-PRODUIT-ABEYAN-FINANCE </b> </h5>
                     <p >N° d'agrement : 2/1.01.0459<br>
                    
                    Tél : (+223) 83 88 88 04 / 61 53 53 56 / 20 20 05 66</p>
                </div>
                <div class="col-md-2 "></div>
                <div class="col-md-5 ">
                    <h5> </h5>
                    <p><br>
                    
                    </p>
                    <img src="{{asset('assets/images/users/avatar.png')}}" width="125" height="125"><br><br>
                    <p>À AB-FINANCE, le {{(new DateTime($info->Client['created_at']))->format('d-m-Y')}} <br>
                    COMPTE
                    N° ABF-{{$info->Client['id']}}<br>
                    </p>
                </div>
                
            </div>
            <div class=" ">
                
            </div>
            <div class="text-center mt-4 mb-2">
                <H3 ><b>ATTESTATION DE SOLDE</b></H3>
            </div>
            <div class="row mt-4">  
            <div class="col-4"></div>
                <div class="col-md-4">
                    <p class="text-center" style="font-size: 15px">
                      Nous membres du C.A <br>
                      Fonction: chargés de la gestion de la caisse <br>
                      Soussigné, certifions que:
                    </p>
                </div>
            </div>
            <div class="row mt-4">  
            <div class="col-3"></div>
                <div class="col-md-8">
                    <p style="font-size: 15px">
                      Togo & Jamu  : <b  style = "text-transform:uppercase;">{{$info->Client['nom_prenom']}}</b> <br>
                      Sigiyoro : @if(($info->Client['adresse']) == NULL)
                                 <b  style = "text-transform:uppercase;">{{$info->Client->Marche['libelle']}}</b> 
                                 @else
                                 <b  style = "text-transform:uppercase;">{{$info->Client['adresse']}}</b>
                                 @endif
                      <br>
                      Détient une part sociale de : <br><br>
                      En foi de quoi nous lui délivrons le présent livret d'épargne et de crédit qui vaut titre<br>
                      À Bamako, le <?php
                                    echo date('d-m-Y');
                                    ?>
                    </p>
                </div>
            </div>
            <div class="row mb-4 ">  
            <div class="col-4"></div>
                <div class="col-md-4">
                    <p class="text-center" style="font-size: 15px">
                      
                      Signature du Gérant <br>
                    <img src="{{asset('assets/images/siganture.png')}}" width="125" height="125">
                    </p>
                </div>
            </div>
            
            
             <div class="text-center mt-4 mb-2">
                <H4></H4>
            </div>
            <div class="text-center mt-4 mb-2">
                <H4><b>MARA / ÉPARGNE</b></H4>
            </div>
            <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="table border dt-responsive nowrap text-dark" >
                        <thead>
                            <tr>
                                <th>DON / DATE</th>
                                <th>MARALEN / VERSEMENT</th>
                                <th>BOLEN / RÉTRAIT</th>
                                <th>MUME / SOLDE</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livret as $item)
                            <tr>
                                <td>
                                    @if($item->date == NULL)
                                     {{(new DateTime($item->created_at))->format('d-m-Y')}}
                                    @else
                                     {{(new DateTime($item->date))->format('d-m-Y')}}
                                    @endif
                                </td>
                                <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                <td>{{number_format($item->solde , 0, ',', ' ')}} CFA</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row mt-4">  
                
                
            </div>
             <div class="row mt-4">  
                
                
            </div>
        
        
        
    </div>

        
</div>
</div>
</div>
@endsection
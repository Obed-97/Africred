@section('title', 'Credits')

@extends('master')

@section('content')


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @php
                        $sum_montant = 0;
                        $sum_interet = 0;
                        $sum_frais_deblocage = 0;
                        $sum_frais_carte = 0;
                        $sum_montant_interet = 0;
                        $encours = 0;
                        foreach($credits as $credit){
                            $sum_montant = $credit->montant + $sum_montant ;
                            $sum_interet = $credit->interet + $sum_interet ;
                            $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
                            $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
                            $sum_montant_interet = $credit->montant_interet + $sum_montant_interet;
                            $encours = $credit->encours($credit->montant_interet) + $encours;
                        }
                    @endphp

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">{{(new DateTime($date1))->format('d-M-Y')}} ---> {{(new DateTime($date2))->format('d-M-Y')}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">D&eacute;blocage</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8">
                            <form  method="POST" action="{{route('etat_credit.solde')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('credit.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"> &Eacute;TAT GLOBAL</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                   
                                        
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                               
                                                <th>Bénéficiaire</th>
                                                <th>Marché</th>
                                                <th>Date déblocage</th>
                                                <th>Date fin</th>
                                                
                                                <th>Renouvellement</th>

                                                <th>Capital</th>
                                                <th>Intérêt</th>
                                                <th>Frais déblocage</th>
                                                <th>Frais carte</th>
                                        
                                               
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
                                                    <td >{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                    <td >{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>

                                                    <td class="text-center">{{$item->renouvellement($item->client_id)}} fois</td>
                                                    <td >{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                                                    
                                                    
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                    <td>{{$item->User['nom']}}</td>
                                                    @endif

                                                    <td class="d-flex">
                                                       
                                                        <a href="{{route('credit.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contrat"><i class="mdi mdi-eye font-size-18"></i></a>
                                                     
                                                    </td>

                                                </tr>
                                             @endforeach
                                                <tr style="background-color: #1cbb8c; color: white ">
                                                    <td></td>
                                                    
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td ></td>
                                                    <td >{{number_format($sum_montant, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_interet, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td >{{number_format($sum_frais_carte, 0, ',', ' ')}} CFA</td>
                                                    
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                                                               
                                                </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                       
                    </div> <!-- end row -->


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <script>

            </script>


@endsection

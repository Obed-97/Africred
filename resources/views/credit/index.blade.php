@section('title', 'Crédit')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Déblocage Global</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Déblocage</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8" id="web">
                            <form  method="POST" action="{{route('etat_credit.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div>
                        <div class="col-xl-2"><a href="{{route('etat_credit.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> DÉBLOCAGE DU JOUR</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                        
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <label for="">Afficher par :</label>
                                                @if (auth()->user()->role_id == 2)
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                                @else
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                                @endif
                                            </div>
                                        </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>N° Compte</th>
                                                <th>Bénéficiaire</th>
                                                <th>Montant</th>
                                                <th>Date de déblocage</th>
                                                <th>Date de fin</th>
                                                <th>Nombre de jours</th>
                                                <th>Intérêt</th>
                                                <th>Frais de déblocage</th>
                                                <th>Frais de carte</th>
                                                <th>Montant & Intérêt</th>
                                        
                                                <th>Statut</th>
                                                    @if (auth()->user()->role_id == 1)
                                                        <th>Agent </th>
                                                    @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>ABF-{{$item->Client['id']}}</td>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                    <td>{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                                    @if(($item->date_deblocage) < ($item->date_fin))
                                                     <td >{{\Carbon\Carbon::createMidnightDate($item->date_deblocage)->diffInDays($item->date_fin)}} jours</td>
                                                    @else
                                                     <td class="text-danger"><i class="ri-error-warning-line"></i> Erreur date de fin</td>
                                                    @endif
                                                    <td>{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}}CFA</td>
                                                    <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->montant_interet, 0, ',', ' ')}} CFA</td>
                                                    
                                                    
                                                    @if (($item->encours($item->montant_interet)) == 0 || ($item->encours($item->montant_interet)) < 0)
                                                    <td>
                                                        <div class="badge badge-soft-success font-size-12">Payé</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-warning font-size-12">Encours</div>
                                                        </td>
                                                    @endif
                                                    
                                                    @if (auth()->user()->role_id == 1)
                                                        <td>{{$item->User['nom']}}</td>
                                                    @endif

                                                    <td class="d-flex">
                                                        @if (auth()->user()->role_id == 2)
                                                        <a href="{{route('credit.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <form method="POST" action="{{route('credit.destroy', $item->id)}}">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                        <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        </form>
                                                        @endif
                                                        @if (auth()->user()->role_id == 1)
                                                        <a href="{{route('credit.show', $item->id)}}" class="mr-3 text-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contrat"><i class="mdi mdi-eye font-size-18"></i></a>
                                                        @endif
                                                        
                                                       
                                                    </td>

                                                </tr>
                                             @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-4" id="web">
                            <div class="card">
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>Désignations</b> </th>
                                                <th><b>Total</b> </th>

                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Montant</td>
                                                <td class="text-success">{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Intérêt</td>
                                                <td class="text-success">{{number_format($credits->sum('interet'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais de déblocage</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais de carte</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Montant & intérêt</td>
                                                <td class="text-success">{{number_format($credits->sum('montant_interet'), 0, ',', ' ')}} CFA</td>
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

@endsection

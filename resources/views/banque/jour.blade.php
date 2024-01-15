@section('title', 'Operations Bancaires')

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
                                <h4 class="mb-0 text-success">Banque </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Banque</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                   
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-5 mb-2">
                             
                        </div>
                       <div class="col-xl-5" id="web">
                            <form  method="POST" action="{{route('banque.date')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-8"><input type="date" name="fdate" class="form-control"></div>
                                
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Recherche...</div>
                            </form>
                        </div>
                        <div class="col-xl-2"><a href="{{route('banque.index')}}" class="btn btn-success btn-block  waves-effect waves-light">TOUTES LES OP&Eacute;RATIONS</a></div>
                    </div>
    
                     <div class="row">
                        <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <div>
                                            <div class="text-center">
                                                <p class="mb-3"><img src="{{asset('assets/images/banque.png')}}" height="45" width="45" ></p>
                                                <h5 class="text-success mb-2"> Solde : {{number_format(($depots->sum('montant') - $retraits->sum('montant')), 0, ',', ' ')}} CFA </h5>
                                                
                                            </div>
                                            
                                            
                                                <div class="table-responsive mt-4">
                                                    <table class="table table-hover mb-0 table-centered table-nowrap">
                                                        <tbody>
                                                            
                                                        <tr>
                                                            <td>
                                                                <h5 class="font-size-14 mb-0"><img src="{{asset('assets/images/ECOBANK.png')}}" height="37" width="85" ></h5>
                                                            </td>
                                                            
                                                            <td class="font-size-16 text-right mb-0">{{number_format(($ecobank_d->sum('montant') - $ecobank_r->sum('montant')), 0, ',', ' ')}} CFA</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <h5 class="font-size-14 mb-0"><img src="{{asset('assets/images/BICIM.png')}}" height="37" width="85" ></h5>
                                                            </td>
                                                            
                                                            <td class="font-size-16 text-right  mb-0">{{number_format(($bicim_d->sum('montant') - $bicim_r->sum('montant')), 0, ',', ' ')}} CFA</td>
                                                        </tr> 
                                                      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-primary">
                                    <div class="card-body ">
                                       
                                        <div>
                                            <div class="text-center">
                                                
                                                <h5 class=" mb-2 text-white"> Aujourd'hui,&nbsp; le &nbsp;
                                                <?php
                                                echo date('d-m-Y');
                                                ?>  </h5>
                                                
                                            </div>
                                            
                                            
                                                <div class="table-responsive mt-4">
                                                    <table class="table  mb-0 table-centered table-nowrap text-white">
                                                        <tbody>
                                                            
                                                        <tr>
                                                            <td>
                                                                <h5 class="font-size-16 mb-0 text-white">Total des dépôts</h5>
                                                            </td>
                                                            
                                                            <td class="font-size-16 text-right mb-0 text-white">{{number_format(($depots_j->sum('montant') ), 0, ',', ' ')}} CFA</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <h5 class="font-size-16 mb-0 text-white">Total des rétraits</h5>
                                                            </td>
                                                            
                                                            <td class="font-size-16 text-right  mb-0 text-white">{{number_format(($retraits_j->sum('montant') ), 0, ',', ' ')}} CFA</td>
                                                        </tr> 
                                                      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Banque</th>
                                            <th>Montant</th>
                                            <th>Motif</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                            @foreach ($banques as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                                    @if ($item->type == 'Dépôt')
                                                        <td>
                                                            <div class="badge badge-soft-success font-size-12">{{$item->type}}</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-danger font-size-12">{{$item->type}}</div>
                                                        </td>
                                                    @endif
                                                    <td>{{$item->nom_banque}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>

                                                    <td>{{Str::words($item->motif, 7, ' ...')}}</td>

                                                    
                                                    <td class="d-flex">
                                                        <a href="{{route('banque.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Modifier"><i class="mdi mdi-pencil font-size-20"></i></a>
                                                        <form method="POST" action="{{route('banque.destroy', $item->id)}}">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                        <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                        </form>
                                                    </td>
                                                </tr> 
                                            @endforeach
                                            
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

@section('title', 'Crédit')

@extends('master')

@section('content')

@php
    use App\Services\Tool;
    $tool = new Tool();
@endphp

<div class="main-content">
      
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success"> Déblocage par Agent</h4>

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
                                                <a href="{{route('recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
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
                                                <th></th>
                                                <th>Agent</th>
                                                <th>Montant</th>
                                                <th>Intérêt</th>
                                                <th>Frais de déblocage</th>
                                                <th>Frais de carte</th>
                                                <th>Montant & Intérêt</th>
                                                
                                                
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$tool->getUser($item['user_id'])->image}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    <td>{{$tool->getUser($item['user_id'])->nom}}</td>
                                                    <td>{{number_format($item['montant'], 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item['interet'], 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item['frais_deblocage'], 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item['frais_carte'], 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item['montant_interet'], 0, ',', ' ')}} CFA</td>
                                                    
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

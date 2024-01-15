@section('title', 'Rotations')

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
                                <h4 class="mb-0 text-success">Les rotations</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Les rotations</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                    <div class="col-xl-2" id="web">
                         <a href="{{route('attente.index')}}" class="btn btn-primary btn-block text-white  waves-effect waves-light" >LISTE D'ATTENTE</a>
                     </div>
                     <div class="col-xl-2" id="web"></div>
                       <div class="col-xl-7" id="web">
                           
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                        
                                       
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Client</th>
                                                <th>Marché</th>
                                                <th>Rotations en {{date('Y')}}</th>
                                                
                                                <th>Rentabilité en {{date('Y')}}</th>
                                          
                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                
                                                    <th>Agent </th>
                                                @endif
                                                   
                                                
                                                    
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                                    
                                                    <td style = "text-transform:uppercase;">{{$item->Client['nom_prenom']}}</td>
                                                    <td style = "text-transform:uppercase;">{{$item->Client->Marche['libelle']}}</td>
                                                    <td>{{$item->rotation($item->client_id)}} fois / 7 </td>
                                                    <td >{{number_format($item->interet + $item->frais_deblocage + $item->frais_carte, 0, ',', ' ')}} CFA</td>
                                                    
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                                                        
                                                        <td style = "text-transform:uppercase;">{{$item->Client->User['nom']}}</td>
                                                        
                                                    @endif

                                                    
                                                       
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




@section('title', 'Bienvenue à AFRICRED')

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
                                <h4 class="mb-0 text-success">Historique </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Historique</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                        
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Client</th>
                                                <th>Encours actualisé</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Capital à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                               @if (auth()->user()->role_id ==2)
                                                 <th>Action</th>
                                               @else
                                                 <th>Agent</th>
                                                 <th>Action</th>
                                               @endif
                                              
                                            </tr>
                                        </thead>
    
    
                                        <tbody>

                                            @foreach ($historiques as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->date))->format('d-m-Y')}} </td>
                                                    <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                    <td>{{number_format($item->encours_actualise, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>

                                                    @if (auth()->user()->role_id ==2)
                                                        <td class="d-flex">
                                                            <a href="{{route('historique.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        </td>
                                                    @else
                                                       <td>{{$item->user['nom']}} </td>
                                                       
                                                       <td>
                                                            <form method="POST" action="{{route('historique.destroy', $item->id)}}">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                            <button  class="text-white btn-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer" type="submit"><i class="mdi mdi-trash-can font-size-18"></i></button>
                                                            </form>
                                                       </td>
                                                    @endif
                                                
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
@section('title', 'Personnel')

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
                                <h4 class="mb-0 text-success">Personnel </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Personnel</li>
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
                                            <th></th>
                                            <th>N° Matricule</th>
                                            <th>Pays</th>
                                            <th>Nom complet</th>
                                            <th>Poste</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td><img src="/assets/images/users/{{$item->image}}" alt="" class="rounded-circle avatar-sm"></td>
                                                <td>ABF-00{{$item->id}}-{{(new DateTime($item->created_at))->format('y')}}</td>
                                                @if($item->pays_id == 1)
                                                <td><img src="{{asset('assets/images/mali.png')}}" alt="" height="15"> {{$item->Pays['libelle']}}</td>
                                                @elseif($item->pays_id == 2)
                                                <td><img src="{{asset('assets/images/togo.png')}}" alt="" height="15"> {{$item->Pays['libelle']}}</td>
                                                @elseif($item->pays_id == 3)
                                                <td><img src="{{asset('assets/images/niger.png')}}" alt="" height="15"> {{$item->Pays['libelle']}}</td>
                                                @elseif($item->pays_id == 4)
                                                <td><img src="{{asset('assets/images/ci.png')}}" alt="" height="15"> {{$item->Pays['libelle']}}</td>
                                                @elseif($item->pays_id == 5)
                                                <td><img src="{{asset('assets/images/nigeria.png')}}" alt="" height="15"> {{$item->Pays['libelle']}}</td>
                                                @endif

                                                <td style = "text-transform:uppercase;">{{$item->nom}}</td>
                                                <td>{{$item->role['libelle']}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td class="d-flex">
                                                    <a href="{{route('personnel.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="{{route('personnel.show', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir"><i class="mdi mdi-eye font-size-18"></i></a>
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

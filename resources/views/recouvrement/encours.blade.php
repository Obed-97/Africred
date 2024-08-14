@section('title', 'Encours Global')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">

        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-xl-2" id="web">
                    <a href="{{route('etat_encours_global.index')}}"
                        class="btn btn-primary btn-block  waves-effect waves-light"><i
                            class="ri-pushpin-fill  align-middle mr-2"></i>ENCOURS S.I</a>


                </div>
                <div class="col-xl-2" id="web">
                    <a href="{{route('etat_actualise.create')}}"
                        class="btn btn-danger btn-block  waves-effect waves-light"><i
                            class="ri-pushpin-fill  align-middle mr-2"></i>CR&Eacute;DITS IMPAY&Eacute;S</a>
                </div>
                <div class="col-xl-6" id="web">
                    <form method="POST" action="{{route('encours.filter')}}" class="d-flex mb-4">
                        @csrf
                        <div class="col-xl-4"><input type="date" name="dd" class="form-control"></div>
                        <div class="col-xl-4"><button type="submit" class="btn btn-primary  waves-effect waves-light"><i
                                    class=" ri-search-2-line"></i> Filtrer</div>
                    </form>
                </div>

                <div class="col-xl-2"><a href="{{route('journalier.index')}}"
                        class="btn btn-primary btn-block  waves-effect waves-light"><i
                            class="ri-funds-box-fill  align-middle mr-2"></i>DÛS JOURNALIERS</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">
                                    @if (isset($dd) && $dd != null)
                                    Encours des Clients
                                    @endif
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> au {{ $dd->format('d-m-Y') }}</a></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Clients</th>
                                        <th>Encours global</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encoursClients as $encour)
                                      <tr>
                                        <td>{{ $encour->Client($encour->credit_id) }}</td>
                                        <td>{{ $encour->encoursClient($encour->credit_id, $dd) }}</td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">
                                    @if (isset($dd) && $dd != null)
                                    Encours des marchés
                                    @endif
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> au {{ $dd->format('d-m-Y') }}</a></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Marché</th>
                                        <th>Encours global</th>
                                        {{-- <th>Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($encours as $encour)
                                      <tr>
                                        <td>{{ $encour->Marche['libelle'] }}</td>
                                        <td>{{ $encour->encours($encour->marche_id, $dd) }}</td>
                                        {{-- <td>{{ $encour-> }}</td> --}}
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <!-- start page title -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @endsection

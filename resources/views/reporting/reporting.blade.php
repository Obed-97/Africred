@section('title', 'Rapport d\'activite')

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
                        <h4 class="mb-0 text-success">Rapport d'activite </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">Rapport d'activite</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="row mb-4">
                <div class="col-xl-12" id="web">
                    <form method="get" action="{{route('etat_encaissement.date')}}" class="d-flex mb-4">
                        <div class="col-xl-2"><input type="date" name="date" class="form-control"></div>
                        <div class="col-xl-4"><a href="{{route('etat_encaissement.index')}}"
                            class="btn btn-success btn-block  waves-effect waves-light">VOIR LE RAPPORT A CETTE DATE</a></div>
                </div>
                    </form>
                </div> --}}
            <!-- end page title -->
            <x-reporting-component />
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @endsection

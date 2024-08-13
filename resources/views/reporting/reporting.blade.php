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

            <x-reporting-component

                com1=""
                com2=""
                com3=""
                com4=""
                com5=""
                com6=""
                com7=""
                com8=""
                com9=""
                com10=""
                com11=""
                com12=""
                com13=""
                com14=""
                com15=""
            />

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @endsection

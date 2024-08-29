@section('title', 'Compte')

@extends('master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="col-xl-2"><a href="{{URL::previous()}}"
                                class="btn  btn-primary waves-effect waves-light"><i
                                    class="ri-arrow-go-back-fill"></i></a></div>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                            </ol>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Total sommes recouverts</p>
                                            <h4 class="mb-0">{{

                                                number_format($recouvs->sum('recouvrement_jrs'), 0, ',', ' ')}}



                                            </h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Total sommes Interet</p>
                                            <h4 class="mb-0">{{

                                                number_format($recouvs->sum('interet_jrs'), 0, ',', ' ')}}

                                            </h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Total sommes Epargne</p>
                                            <h4 class="mb-0">{{

                                                number_format($recouvs->sum('epargne_jrs') - $recouvs->sum('retrait'),
                                                0, ',', ' ')

                                                }} </h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class=" ri-bank-card-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Capital</th>
                                        <th>Intérêt</th>
                                        <th>Epargne</th>
                                        <th>Assurance</th>
                                        <th>Frais de déblocage</th>
                                        <th>Frais de carte</th>
                                        <th>Retrait</th>
                                        <th>Date</th>
                                        <th>Date de création</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($recouvs as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format(($item->epargne_jrs - $item->retrait), 0, ',', ' ')}}
                                            CFA</td>
                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($item->getFraisDeblocageCredit($item->credit_id), 0,
                                            ',', ' ')}} CFA</td>
                                        <td>{{number_format($item->getFraisCarteCredit($item->credit_id), 0, ',', '
                                            ')}} CFA</td>
                                        <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->created_at}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

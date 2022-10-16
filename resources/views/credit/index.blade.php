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
                                <h4 class="mb-0">Crédit </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Crédit</li>
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
                                    <h4 class="card-title text-right mb-4"><button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouveau crédit</button></h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('credit.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouveau crédit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label" name>Bénéficiaire</label>
                                                            <select class="form-control " name="client_id">
                                                               @foreach ($clients as $item)
                                                                <option value="{{$item->id}}">{{$item->nom_prenom}} -- {{$item->Marche['libelle']}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de déblocage</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_deblocage"  id="date_deblocage">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de fin</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_fin"  id="date_fin">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group ">
                                                            <label>Intérêt</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="interet"  id="interet">
                                                            </div>
                                                         </div> --}}
                                                        {{-- <div class="form-group ">
                                                            <label>Frais de déblocage</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="frais_deblocage"  id="frais_deblocage">
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group ">
                                                            <label>Frais de carte</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="frais_carte"  id="frais_carte">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group ">
                                                            <label>Montant & Intérêt</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant_interet"  id="montant_interet">
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Bénéficiaire</th>
                                                <th>Montant</th>
                                                <th>Date de déblocage</th>
                                                <th>Date de fin</th>
                                                <th>Intérêt</th>
                                                <th>Frais de déblocage</th>
                                                <th>Frais de carte</th>
                                                <th>Montant & Intérêt</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{$item->montant}} CFA</td>
                                                    <td>{{(new DateTime($item->date_deblocage))->format('d-m-Y')}} </td>
                                                    <td>{{(new DateTime($item->date_fin))->format('d-m-Y')}} </td>
                                                    <td>{{$item->interet}} CFA</td>
                                                    <td>{{$item->frais_deblocage}} CFA</td>
                                                    <td>{{$item->frais_carte}} CFA</td>
                                                    <td>{{$item->montant_interet}} CFA</td>

                                                    <td class="d-flex">
                                                        <a href="" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <form method="POST" action="">
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

            <script>

            </script>


@endsection
